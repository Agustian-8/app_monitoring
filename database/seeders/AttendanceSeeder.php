<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use App\Models\WorkSetting;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil 5 user sales
        $users = User::where('role', 'sales')->take(5)->get();

        if ($users->count() < 5) {
            $this->command->warn('Butuh minimal 5 user sales. Jalankan UserSeeder dulu.');
            return;
        }

        // Hapus data absensi lama
        Attendance::truncate();

        // ======================================================
        // 2. TANGGAL TARGET — 14 September 2026 (Senin)
        // ======================================================
        $tanggal = Carbon::parse('2026-09-14');
        $dayOfWeek = $tanggal->dayOfWeek;

        $workSetting = WorkSetting::where('day_of_week', $dayOfWeek)->first();

        if (!$workSetting || !$workSetting->jam_masuk) {
            $this->command->warn("Hari {$tanggal->dayName} adalah hari libur. Tidak ada absen.");
            return;
        }

        $jamMasukKerja   = substr($workSetting->jam_masuk, 0, 5);   // "08:00"
        $jamPulangKerja  = substr($workSetting->jam_pulang, 0, 5);  // "17:00"

        $this->command->info("📅 Tanggal: {$tanggal->format('d M Y')} ({$tanggal->dayName})");
        $this->command->info("⏰ Jam kerja: {$jamMasukKerja} – {$jamPulangKerja} (TANPA toleransi)");
        $this->command->newLine();

        // ======================================================
        // 3. HELPER: HITUNG KODE TL DARI JAM ABSEN
        // ======================================================
        $hitungStatus = function ($jamAbsenStr) use ($jamMasukKerja) {
            $jamAbsen = Carbon::createFromFormat('H:i', $jamAbsenStr);
            $jamMasuk = Carbon::createFromFormat('H:i', $jamMasukKerja);

            // TANPA TOLERANSI: kalau absen > jam masuk, langsung telat
            if ($jamAbsen->lessThanOrEqualTo($jamMasuk)) {
                return ['kode' => 'H', 'telat' => 0];
            }

            $menitTelat = (int) $jamMasuk->diffInMinutes($jamAbsen);

            $kode = match (true) {
                $menitTelat <= 10 => 'TL1',
                $menitTelat <= 20 => 'TL2',
                default            => 'TL3',
            };

            return ['kode' => $kode, 'telat' => $menitTelat];
        };

        // ======================================================
        // 4. DATA SAMPLE — 5 KARYAWAN, TANPA TOLERANSI
        // ======================================================
        $samples = [
            // 1. Tepat waktu
            [
                'user_idx'   => 0,
                'jam_masuk'  => '08:00',
                'jam_pulang' => '17:00',
                'notes'      => null,
            ],
            // 2. Telat 1 menit → TL1
            [
                'user_idx'   => 1,
                'jam_masuk'  => '08:01',
                'jam_pulang' => '17:00',
                'notes'      => 'Baru sampai parkiran',
            ],
            // 3. Telat 10 menit → TL1 (batas TL1)
            [
                'user_idx'   => 2,
                'jam_masuk'  => '08:10',
                'jam_pulang' => '17:00',
                'notes'      => 'Antar anak sekolah',
            ],
            // 4. Telat 15 menit → TL2
            [
                'user_idx'   => 3,
                'jam_masuk'  => '08:15',
                'jam_pulang' => '17:00',
                'notes'      => 'Macet di jalan',
            ],
            // 5. Telat 50 menit & lembur 30 menit → TL3
            [
                'user_idx'   => 4,
                'jam_masuk'  => '08:50',
                'jam_pulang' => '17:30',
                'notes'      => 'Ban bocor',
            ],
        ];

        $createdCount = 0;

        foreach ($samples as $s) {
            $user = $users[$s['user_idx']];

            // Hitung kode & telat
            $status = $hitungStatus($s['jam_masuk']);
            $kode   = $status['kode'];
            $telat  = $status['telat'];

            // Hitung lembur
            $jamPulangAbsen    = Carbon::createFromFormat('H:i', $s['jam_pulang']);
            $jamPulangKerjaObj = Carbon::createFromFormat('H:i', $jamPulangKerja);
            $lembur = $jamPulangAbsen->greaterThan($jamPulangKerjaObj)
                ? (int) $jamPulangKerjaObj->diffInMinutes($jamPulangAbsen)
                : 0;

            // Status lama (backward compat)
            $statusLama = match ($kode) {
                'H', 'TL1', 'TL2', 'TL3' => 'Hadir',
                default => 'Hadir',
            };

            $kodeInfo = Attendance::getKodeInfo($kode);
            $keteranganTelat = $telat > 0
                ? "Telat {$telat} menit ({$kodeInfo['label']})"
                : null;

            // ---- ABSEN MASUK ----
            Attendance::create([
                'user_id'          => $user->id,
                'tipe_absen'       => 'Masuk',
                'status'           => $statusLama,
                'kode_absen'       => $kode,
                'photo_path'       => null,
                'latitude'         => -0.015479,
                'longitude'        => 109.271738,
                'notes'            => $s['notes'],
                'menit_telat'      => $telat,
                'menit_lembur'     => 0,
                'keterangan_telat' => $keteranganTelat,
                'created_at'       => $tanggal->copy()->setTimeFromTimeString($s['jam_masuk']),
                'updated_at'       => $tanggal->copy()->setTimeFromTimeString($s['jam_masuk']),
            ]);
            $createdCount++;

            // ---- ABSEN PULANG ----
            if ($s['jam_pulang']) {
                Attendance::create([
                    'user_id'          => $user->id,
                    'tipe_absen'       => 'Pulang',
                    'status'           => $statusLama,
                    'kode_absen'       => 'H',
                    'photo_path'       => null,
                    'latitude'         => -0.015479,
                    'longitude'        => 109.271738,
                    'notes'            => null,
                    'menit_telat'      => 0,
                    'menit_lembur'     => $lembur,
                    'keterangan_telat' => null,
                    'created_at'       => $tanggal->copy()->setTimeFromTimeString($s['jam_pulang']),
                    'updated_at'       => $tanggal->copy()->setTimeFromTimeString($s['jam_pulang']),
                ]);
                $createdCount++;
            }

            $this->command->line("   • {$user->name}: masuk {$s['jam_masuk']} → kode {$kode} (telat {$telat} mnt, lembur {$lembur} mnt)");
        }

        $this->command->newLine();
        $this->command->info("✅ AttendanceSeeder: {$createdCount} record absensi dibuat untuk 5 karyawan.");
    }
}