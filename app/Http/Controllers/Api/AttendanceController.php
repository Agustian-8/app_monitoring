<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\WorkSetting;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    private const KANTOR_LAT = -0.015479286054950754;
    private const KANTOR_LON = 109.27173862859146;
    private const KANTOR_RADIUS = 50;

    /**
     * Mapping kode absensi → status lama (backward compat)
     */
    private const KODE_TO_STATUS_LAMA = [
        'H'     => 'Hadir',
        'TL1'   => 'Hadir',
        'TL2'   => 'Hadir',
        'TL3'   => 'Hadir',
        'S'     => 'Sakit',
        'DLK'   => 'DLK',
        'CT1/2' => 'Izin',
        'CT1'   => 'Izin',
        'IZ1/2' => 'Izin',
        'IZ1'   => 'Izin',
        'CTK'   => 'Izin',
        'GA'    => 'Hadir',
        'MK'    => 'Izin',
    ];

    public function store(Request $request)
    {
        // 1. VALIDASI INPUT
        $request->validate([
            'tipe_absen' => 'required|in:Masuk,Pulang',
            'kode_absen' => 'required|string|max:10',
            'notes'      => 'nullable|string|max:255',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'latitude'   => 'nullable|numeric',
            'longitude'  => 'nullable|numeric',
        ]);

        $user  = $request->user();
        $now   = Carbon::now();
        $today = Carbon::today();

        // 2. VALIDASI KODE ABSEN
        $kode = strtoupper($request->kode_absen);
        $kodeInfo = Attendance::getKodeInfo($kode);

        if (!$kodeInfo) {
            return response()->json([
                'success' => false,
                'message' => "Kode absensi '{$kode}' tidak dikenali.",
            ], 400);
        }

        // 3. VALIDASI HARI KERJA (KHUSUS KODE HADIR/TELAT)
        $kodeHadir = ['H', 'TL1', 'TL2', 'TL3'];
        if (in_array($kode, $kodeHadir) && !WorkSetting::isWorkday()) {
            return response()->json([
                'success' => false,
                'message' => 'Hari ini bukan hari kerja. Anda tidak perlu absen.',
            ], 400);
        }

        // 4. CEK ABSEN GANDA
        $alreadyAttended = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->where('tipe_absen', $request->tipe_absen)
            ->exists();

        if ($alreadyAttended) {
            $existing = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', $today)
                ->where('tipe_absen', $request->tipe_absen)
                ->first();

            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan absen ' . $request->tipe_absen
                             . ' hari ini pada ' . $existing->created_at->format('H:i') . '.',
            ], 400);
        }

        // 5. VALIDASI ALUR
        if ($request->tipe_absen === 'Pulang') {
            $sudahMasuk = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', $today)
                ->where('tipe_absen', 'Masuk')
                ->exists();

            if (!$sudahMasuk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda belum melakukan absen masuk hari ini.',
                ], 400);
            }
        }

        // 6. VALIDASI GEOFENCING
        if ($kodeInfo['butuh_lokasi']) {
            if (!$request->latitude || !$request->longitude) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal: Anda harus menekan tombol Kunci Lokasi GPS terlebih dahulu.',
                ], 400);
            }

            $distance = $this->calculateDistance(
                $request->latitude,
                $request->longitude,
                self::KANTOR_LAT,
                self::KANTOR_LON
            );

            if ($distance > self::KANTOR_RADIUS) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal: Anda berada di luar area kantor. Jarak Anda saat ini: '
                                 . round($distance) . ' meter (maksimal ' . self::KANTOR_RADIUS . 'm).',
                    'distance' => round($distance),
                ], 400);
            }
        }

        // 7. VALIDASI FOTO
        if ($kodeInfo['butuh_foto'] && !$request->hasFile('photo')) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal: Kode absensi ini membutuhkan foto selfie.',
            ], 400);
        }

        // 8. VALIDASI SURAT
        if ($kodeInfo['butuh_surat'] && !$request->hasFile('photo')) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal: Kode absensi ini membutuhkan upload bukti/surat.',
            ], 400);
        }

        // ======================================================
        // 9. HITUNG TELAT & LEMBUR (TANPA TOLERANSI)
        // ======================================================
        $menitTelat      = 0;
        $menitLembur     = 0;
        $keteranganTelat = null;

        $workSetting = WorkSetting::today();

        // --- ABSEN MASUK: Deteksi Telat ---
        if ($request->tipe_absen === 'Masuk' && in_array($kode, $kodeHadir)) {
            if ($workSetting && $workSetting->jam_masuk) {
                $jamMasukKerja = Carbon::createFromFormat(
                    'Y-m-d H:i',
                    $now->toDateString() . ' ' . substr($workSetting->jam_masuk, 0, 5)
                );

                // 👈 TANPA TOLERANSI: telat dihitung langsung dari jam masuk
                if ($now->greaterThan($jamMasukKerja)) {
                    $menitTelat = (int) abs($jamMasukKerja->diffInMinutes($now));

                    // Auto-ganti kode H → TL1/TL2/TL3
                    $kode = Attendance::generateKodeTelat($menitTelat);
                    $kodeInfo = Attendance::getKodeInfo($kode);
                    $keteranganTelat = "Telat {$menitTelat} menit ({$kodeInfo['label']})";
                }
            }
        }

        // --- ABSEN PULANG: Deteksi Lembur ---
        if ($request->tipe_absen === 'Pulang') {
            if ($workSetting && $workSetting->jam_pulang) {
                $jamPulangKerja = Carbon::createFromFormat(
                    'Y-m-d H:i',
                    $now->toDateString() . ' ' . substr($workSetting->jam_pulang, 0, 5)
                );

                if ($now->greaterThan($jamPulangKerja)) {
                    $menitLembur = (int) abs($jamPulangKerja->diffInMinutes($now));
                }
            }
        }

        // 10. UPLOAD FOTO
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('attendances', 'public');
        }

        // 11. STATUS LAMA (BACKWARD COMPAT)
        $statusLama = self::KODE_TO_STATUS_LAMA[$kode] ?? 'Hadir';

        // 12. SIMPAN DATA ABSENSI
        $attendance = Attendance::create([
            'user_id'          => $user->id,
            'tipe_absen'       => $request->tipe_absen,
            'status'           => $statusLama,
            'kode_absen'       => $kode,
            'photo_path'       => $photoPath,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'notes'            => $request->notes,
            'menit_telat'      => $menitTelat,
            'menit_lembur'     => $menitLembur,
            'keterangan_telat' => $keteranganTelat,
        ]);

        // 13. PESAN RESPONS
        $message = 'Absen ' . $request->tipe_absen . ' berhasil dicatat!';

        if ($menitTelat > 0) {
            $message .= " ⚠ Anda telat {$menitTelat} menit (kode: {$kode}).";
        }
        if ($menitLembur > 0) {
            $message .= " 💪 Terima kasih! Anda lembur {$menitLembur} menit.";
        }
        if ($kode !== strtoupper($request->kode_absen)) {
            $message .= " Kode absen otomatis disesuaikan dari "
                        . $request->kode_absen . " → {$kode}.";
        }

        return response()->json([
            'success'      => true,
            'message'      => $message,
            'data'         => $attendance,
            'kode_absen'   => $kode,
            'kode_label'   => $kodeInfo['label'] ?? '-',
            'menit_telat'  => $menitTelat,
            'menit_lembur' => $menitLembur,
        ], 201);
    }

    public function todaySchedule()
    {
        $workSetting = WorkSetting::today();

        return response()->json([
            'success' => true,
            'data'    => [
                'hari'       => $workSetting?->day_name ?? '-',
                'jam_masuk'  => $workSetting?->jam_masuk ? substr($workSetting->jam_masuk, 0, 5) : null,
                'jam_pulang' => $workSetting?->jam_pulang ? substr($workSetting->jam_pulang, 0, 5) : null,
                'is_workday' => WorkSetting::isWorkday(),
                'toleransi'  => $workSetting?->toleransi_telat ?? 0,
            ],
        ]);
    }

    public function kodeList()
    {
        $list = [];
        foreach (Attendance::getKodeList() as $kode => $info) {
            $list[] = [
                'kode'       => $kode,
                'label'      => $info['label'],
                'kategori'   => $info['kategori'],
                'warna'      => $info['warna'],
                'icon'       => $info['icon'] ?? null,
                'auto'       => $info['auto'] ?? false,
                'bisa_setengah_hari' => $info['bisa_setengah_hari'] ?? false,
                'butuh_lokasi' => $info['butuh_lokasi'] ?? false,
                'butuh_foto'   => $info['butuh_foto'] ?? false,
                'butuh_surat'  => $info['butuh_surat'] ?? false,
            ];
        }

        return response()->json([
            'success' => true,
            'data'    => $list,
        ]);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2)
           + cos(deg2rad($lat1)) * cos(deg2rad($lat2))
           * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }
}