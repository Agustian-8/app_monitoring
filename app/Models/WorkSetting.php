<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WorkSetting extends Model
{
    protected $fillable = [
        'day_of_week',
        'day_name',
        'jam_masuk',
        'jam_pulang',
        'toleransi_telat',
        'is_active',
    ];

    protected $casts = [
        'is_active'        => 'boolean',
        'toleransi_telat'  => 'integer',
    ];

    public static function today(): ?self
    {
        return self::where('day_of_week', Carbon::now()->dayOfWeek)->first();
    }

    public static function isWorkday(): bool
    {
        $today = self::today();
        return $today && $today->is_active && $today->jam_masuk;
    }

    /**
     * 👈 BARU: Cek apakah sekarang sudah lewat jam masuk (belum termasuk toleransi).
     * Dipakai untuk generate kode TL.
     */
    public static function hitungMenitTelat(Carbon $waktuAbsen): int
    {
        $today = self::today();
        if (!$today || !$today->jam_masuk) {
            return 0;
        }

        $jamMasukKerja = Carbon::createFromFormat(
            'Y-m-d H:i',
            $waktuAbsen->toDateString() . ' ' . substr($today->jam_masuk, 0, 5)
        );

        if ($waktuAbsen->lessThanOrEqualTo($jamMasukKerja)) {
            return 0; // belum telat / tepat waktu
        }

        return (int) abs($jamMasukKerja->diffInMinutes($waktuAbsen));
    }
}