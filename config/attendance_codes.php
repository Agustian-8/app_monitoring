<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Daftar Kode Absensi
    |--------------------------------------------------------------------------
    |
    | 'kode' => [
    |     'label'       => Nama lengkap
    |     'kategori'    => 'hadir' | 'absen' | 'izin' | 'cuti' | 'terlambat' | 'khusus'
    |     'warna'       => Warna badge Filament (success, warning, danger, info, gray, primary)
    |     'icon'        => Heroicon name (opsional)
    |     'auto'        => true kalau dihitung otomatis oleh sistem (TL1/TL2/TL3)
    |     'bisa_setengah_hari' => true kalau bisa 1/2 hari
    |     'butuh_lokasi' => true kalau harus absen di kantor (H, TL1, TL2, TL3)
    |     'butuh_foto'   => true kalau butuh selfie
    |     'butuh_surat'  => true kalau butuh upload bukti
    | ]
    |
    */

    'H' => [
        'label'       => 'Hadir',
        'kategori'    => 'hadir',
        'warna'       => 'success',
        'icon'        => 'heroicon-o-check-circle',
        'auto'        => false,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => true,
        'butuh_foto'   => true,
        'butuh_surat'  => false,
    ],

    'TL1' => [
        'label'       => 'Terlambat 1-10 Menit',
        'kategori'    => 'terlambat',
        'warna'       => 'warning',
        'icon'        => 'heroicon-o-clock',
        'auto'        => true,   // ← dihitung otomatis
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => true,
        'butuh_foto'   => true,
        'butuh_surat'  => false,
    ],

    'TL2' => [
        'label'       => 'Terlambat 11-20 Menit',
        'kategori'    => 'terlambat',
        'warna'       => 'warning',
        'icon'        => 'heroicon-o-clock',
        'auto'        => true,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => true,
        'butuh_foto'   => true,
        'butuh_surat'  => false,
    ],

    'TL3' => [
        'label'       => 'Terlambat >20 Menit',
        'kategori'    => 'terlambat',
        'warna'       => 'danger',
        'icon'        => 'heroicon-o-exclamation-triangle',
        'auto'        => true,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => true,
        'butuh_foto'   => true,
        'butuh_surat'  => false,
    ],

    'S' => [
        'label'       => 'Sakit',
        'kategori'    => 'absen',
        'warna'       => 'danger',
        'icon'        => 'heroicon-o-heart',
        'auto'        => false,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => false,
        'butuh_foto'   => false,
        'butuh_surat'  => true,  // ← WAJIB surat dokter
    ],

    'DLK' => [
        'label'       => 'Dinas Luar Kota',
        'kategori'    => 'izin',
        'warna'       => 'info',
        'icon'        => 'heroicon-o-truck',
        'auto'        => false,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => false,
        'butuh_foto'   => false,
        'butuh_surat'  => true,
    ],

    'CT1/2' => [
        'label'       => 'Cuti 1/2 Hari Kerja',
        'kategori'    => 'cuti',
        'warna'       => 'primary',
        'icon'        => 'heroicon-o-calendar-days',
        'auto'        => false,
        'bisa_setengah_hari' => true,
        'butuh_lokasi' => false,
        'butuh_foto'   => false,
        'butuh_surat'  => false,
    ],

    'CT1' => [
        'label'       => 'Cuti 1 Hari Kerja',
        'kategori'    => 'cuti',
        'warna'       => 'primary',
        'icon'        => 'heroicon-o-calendar-days',
        'auto'        => false,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => false,
        'butuh_foto'   => false,
        'butuh_surat'  => false,
    ],

    'IZ1/2' => [
        'label'       => 'Izin Pribadi 1/2 Hari Kerja',
        'kategori'    => 'izin',
        'warna'       => 'warning',
        'icon'        => 'heroicon-o-document-text',
        'auto'        => false,
        'bisa_setengah_hari' => true,
        'butuh_lokasi' => false,
        'butuh_foto'   => false,
        'butuh_surat'  => false,
    ],

    'IZ1' => [
        'label'       => 'Izin Pribadi 1 Hari Kerja',
        'kategori'    => 'izin',
        'warna'       => 'warning',
        'icon'        => 'heroicon-o-document-text',
        'auto'        => false,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => false,
        'butuh_foto'   => false,
        'butuh_surat'  => false,
    ],

    'GA' => [
        'label'       => 'Gagal Absen / Lupa Absen',
        'kategori'    => 'khusus',
        'warna'       => 'gray',
        'icon'        => 'heroicon-o-question-mark-circle',
        'auto'        => false,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => false,
        'butuh_foto'   => false,
        'butuh_surat'  => false,
    ],

    'MK' => [
        'label'       => 'Mangkir',
        'kategori'    => 'absen',
        'warna'       => 'danger',
        'icon'        => 'heroicon-o-x-circle',
        'auto'        => false,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => false,
        'butuh_foto'   => false,
        'butuh_surat'  => false,
    ],

    'CTK' => [
        'label'       => 'Cuti Khusus',
        'kategori'    => 'cuti',
        'warna'       => 'primary',
        'icon'        => 'heroicon-o-star',
        'auto'        => false,
        'bisa_setengah_hari' => false,
        'butuh_lokasi' => false,
        'butuh_foto'   => false,
        'butuh_surat'  => true,
    ],
];