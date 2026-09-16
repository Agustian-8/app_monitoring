<?php

namespace Database\Seeders;

use App\Models\AttendanceRule;
use Illuminate\Database\Seeder;

class AttendanceRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            // ============ HADIR ============
            [
                'kode' => 'H',
                'label' => 'Hadir',
                'penjelasan' => 'Masuk kerja tepat waktu sesuai jadwal.',
                'kategori' => 'hadir',
                'denda' => 0,
                'tetap_dapat_upah' => true,
                'tetap_dapat_tunjangan' => true,
                'urutan' => 1,
            ],

            // ============ TERLAMBAT (DENDA) ============
            [
                'kode' => 'TL1',
                'label' => 'Terlambat 1 s/d 10 Menit',
                'penjelasan' => 'Karyawan kena DENDA sebesar Rp 5.000 dan membayarkan ke kasir.',
                'kategori' => 'terlambat',
                'denda' => 5000,
                'urutan' => 2,
            ],
            [
                'kode' => 'TL2',
                'label' => 'Terlambat 11 s/d 20 Menit',
                'penjelasan' => 'Karyawan kena DENDA sebesar Rp 15.000 dan membayarkan ke kasir.',
                'kategori' => 'terlambat',
                'denda' => 15000,
                'urutan' => 3,
            ],
            [
                'kode' => 'TL3',
                'label' => 'Terlambat >20 Menit',
                'penjelasan' => 'Karyawan kena DENDA sebesar Rp 20.000 dan membayarkan ke kasir.',
                'kategori' => 'terlambat',
                'denda' => 20000,
                'urutan' => 4,
            ],

            // ============ ABSEN ============
            [
                'kode' => 'S',
                'label' => 'Sakit',
                'penjelasan' => 'Tidak masuk 1 hari kerja dengan bukti surat istirahat Dokter.',
                'kategori' => 'absen',
                'urutan' => 5,
            ],
            [
                'kode' => 'GA',
                'label' => 'Gagal Absen / Lupa Absen',
                'penjelasan' => 'Karyawan kena DENDA sebesar Rp 20.000 dan membayarkan ke kasir.',
                'kategori' => 'khusus',
                'denda' => 20000,
                'urutan' => 6,
            ],
            [
                'kode' => 'MK',
                'label' => 'Mangkir',
                'penjelasan' => 'Tidak masuk 1 hari kerja tanpa pemberitahuan, MEMOTONG upah dan keseluruhan tunjangan.',
                'kategori' => 'absen',
                'potong_upah' => true,
                'potong_tunjangan' => true,
                'urutan' => 7,
            ],

            // ============ IZIN ============
            [
                'kode' => 'DLK',
                'label' => 'Dinas Luar Kota',
                'penjelasan' => 'Menjalankan pekerjaan di luar kota.',
                'kategori' => 'izin',
                'tetap_dapat_upah' => true,
                'tetap_dapat_tunjangan' => true,
                'urutan' => 8,
            ],
            [
                'kode' => 'IZ1/2',
                'label' => 'Izin Pribadi 1/2 hari kerja',
                'penjelasan' => 'Absensi Hadir / Pulang melebihi 2 jam kerja, TETAP MENDAPATKAN upah dan MEMOTONG tunjangan yang dibayarkan harian.',
                'kategori' => 'izin',
                'tetap_dapat_upah' => true,
                'potong_tunjangan' => true,
                'urutan' => 9,
            ],
            [
                'kode' => 'IZ1',
                'label' => 'Izin Pribadi 1 hari kerja',
                'penjelasan' => 'Tidak Masuk 1 hari kerja, MEMOTONG upah dan keseluruhan tunjangan.',
                'kategori' => 'izin',
                'potong_upah' => true,
                'potong_tunjangan' => true,
                'urutan' => 10,
            ],

            // ============ CUTI ============
            [
                'kode' => 'CT1/2',
                'label' => 'Cuti 1/2 hari kerja',
                'penjelasan' => 'Tidak masuk 1/2 hari kerja dengan memotong Hak Cuti Tahunan, TETAP MENDAPATKAN upah dan tunjangan lainnya penuh.',
                'kategori' => 'cuti',
                'potong_hak_cuti' => true,
                'tetap_dapat_upah' => true,
                'tetap_dapat_tunjangan' => true,
                'urutan' => 11,
            ],
            [
                'kode' => 'CT1',
                'label' => 'Cuti 1 hari kerja',
                'penjelasan' => 'Tidak masuk 1 hari kerja dengan memotong Hak Cuti Tahunan, TETAP MENDAPATKAN upah dan MEMOTONG tunjangan yang dibayarkan harian.',
                'kategori' => 'cuti',
                'potong_hak_cuti' => true,
                'tetap_dapat_upah' => true,
                'potong_tunjangan' => true,
                'urutan' => 12,
            ],
            [
                'kode' => 'CTK',
                'label' => 'Cuti Khusus',
                'penjelasan' => 'Izin yang disetujui berdasarkan undang-undang.',
                'kategori' => 'cuti',
                'tetap_dapat_upah' => true,
                'tetap_dapat_tunjangan' => true,
                'urutan' => 13,
            ],
        ];

        foreach ($rules as $rule) {
            AttendanceRule::updateOrCreate(
                ['kode' => $rule['kode']],
                $rule
            );
        }
    }
}