<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString; // Tambahkan ini untuk membaca tag HTML

class CustomLogin extends BaseLogin
{
    // Mengubah Judul dengan warna biru dan ukuran yang pas
    public function getHeading(): string|Htmlable
    {
        return new HtmlString('<span style="color: #2563eb; font-weight: 700;">PT. Pakita Jaya</span>');
    }

    // Mengubah Teks Sub-Judul di bawahnya
    public function getSubheading(): string|Htmlable|null
    {
        return 'Silakan masukkan akun Anda';
    }
}