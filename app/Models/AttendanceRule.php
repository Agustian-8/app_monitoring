<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'label',
        'penjelasan',
        'kategori',
        'denda',
        'potong_upah',
        'potong_tunjangan',
        'potong_hak_cuti',
        'tetap_dapat_upah',
        'tetap_dapat_tunjangan',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'denda'                  => 'integer',
        'potong_upah'            => 'boolean',
        'potong_tunjangan'       => 'boolean',
        'potong_hak_cuti'        => 'boolean',
        'tetap_dapat_upah'       => 'boolean',
        'tetap_dapat_tunjangan'  => 'boolean',
        'is_active'              => 'boolean',
        'urutan'                 => 'integer',
    ];

    /**
     * Ambil rule berdasarkan kode
     */
    public static function getByKode(string $kode): ?self
    {
        return self::where('kode', $kode)->first();
    }

    /**
     * Ambil denda per kode
     */
    public static function getDenda(string $kode): int
    {
        return self::where('kode', $kode)->value('denda') ?? 0;
    }

    /**
     * Format denda ke Rupiah
     */
    public function getDendaRupiahAttribute(): string
    {
        if ($this->denda <= 0) {
            return '-';
        }
        return 'Rp ' . number_format($this->denda, 0, ',', '.');
    }

    /**
     * Ringkasan dampak (untuk kolom penjelasan otomatis)
     */
    public function getDampakAttribute(): string
    {
        $dampak = [];

        if ($this->denda > 0) {
            $dampak[] = 'Denda ' . $this->getDendaRupiahAttribute();
        }
        if ($this->potong_upah) {
            $dampak[] = 'Potong upah';
        }
        if ($this->potong_tunjangan) {
            $dampak[] = 'Potong tunjangan harian';
        }
        if ($this->potong_hak_cuti) {
            $dampak[] = 'Potong hak cuti';
        }
        if ($this->tetap_dapat_upah) {
            $dampak[] = 'Tetap dapat upah';
        }
        if ($this->tetap_dapat_tunjangan) {
            $dampak[] = 'Tetap dapat tunjangan';
        }

        return count($dampak) > 0 ? implode(', ', $dampak) : 'Tidak ada sanksi';
    }
}