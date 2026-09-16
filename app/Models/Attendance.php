<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipe_absen',
        'status',
        'kode_absen',       // 👈 BARU
        'photo_path',
        'latitude',
        'longitude',
        'notes',
        'menit_telat',
        'menit_lembur',
        'keterangan_telat',
    ];

    protected $casts = [
        'latitude'     => 'float',
        'longitude'    => 'float',
        'menit_telat'  => 'integer',
        'menit_lembur' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ======================================================
    // HELPER METHODS
    // ======================================================

    /**
     * Ambil semua konfigurasi kode absensi.
     */
    public static function getKodeList(): array
    {
        return config('attendance_codes', []);
    }

    /**
     * Ambil info 1 kode absensi.
     * Contoh: Attendance::getKodeInfo('H') → ['label' => 'Hadir', ...]
     */
    public static function getKodeInfo(?string $kode): ?array
    {
        if (!$kode) return null;
        return config("attendance_codes.{$kode}");
    }

    /**
     * Ambil label kode absensi.
     */
    public static function getKodeLabel(?string $kode): string
    {
        return self::getKodeInfo($kode)['label'] ?? '-';
    }

    /**
     * Ambil warna badge kode absensi (untuk Filament).
     */
    public static function getKodeColor(?string $kode): string
    {
        return self::getKodeInfo($kode)['warna'] ?? 'gray';
    }

    /**
     * Ambil icon kode absensi.
     */
    public static function getKodeIcon(?string $kode): ?string
    {
        return self::getKodeInfo($kode)['icon'] ?? null;
    }

    /**
     * Cek apakah kode auto-generated (TL1, TL2, TL3).
     */
    public static function isKodeAuto(?string $kode): bool
    {
        return self::getKodeInfo($kode)['auto'] ?? false;
    }

    /**
     * Generate kode TL berdasarkan jumlah menit telat.
     */
    public static function generateKodeTelat(int $menitTelat): string
    {
        if ($menitTelat <= 0) {
            return 'H';
        }
        if ($menitTelat <= 10) {
            return 'TL1';
        }
        if ($menitTelat <= 20) {
            return 'TL2';
        }
        return 'TL3';
    }
}