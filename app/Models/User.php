<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'password',
        'role',
        'tipe_karyawan',   // 👈 BARU
        'department',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ======================================================
    // HELPER METHODS
    // ======================================================

    /**
     * Cek apakah user adalah admin/HRD.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah sales/lapangan.
     */
    public function isSales(): bool
    {
        return $this->role === 'sales';
    }

    /**
     * Cek apakah user adalah karyawan kantor.
     */
    public function isKantor(): bool
    {
        return $this->tipe_karyawan === 'kantor';
    }

    /**
     * Cek apakah user adalah karyawan lapangan.
     */
    public function isLapangan(): bool
    {
        return $this->tipe_karyawan === 'lapangan';
    }

    /**
     * Cek apakah user perlu mengakses fitur kunjungan.
     */
    public function butuhKunjungan(): bool
    {
        return $this->isLapangan();
    }

    /**
     * Label tipe karyawan untuk tampilan.
     */
    public function getTipeKaryawanLabelAttribute(): string
    {
        return match ($this->tipe_karyawan) {
            'kantor'   => 'Karyawan Kantor',
            'lapangan' => 'Sales / Lapangan',
            default    => '-',
        };
    }

    // ======================================================
    // RELATIONS
    // ======================================================

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}