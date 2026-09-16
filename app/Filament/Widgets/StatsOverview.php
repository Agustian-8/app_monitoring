<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Attendance;
use App\Models\Visit;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 1;
    
    // Auto-update setiap 15 detik untuk kesan interaktif & real-time
    protected static ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        $today = Carbon::today();

        $totalKaryawan = User::count();
        $totalOutlet = Outlet::count();
        $hadirHariIni = Attendance::whereDate('created_at', $today)->where('status', 'Hadir')->count();
        $kunjunganHariIni = Visit::whereDate('created_at', $today)->count();

        // Hitung persentase untuk insight yang lebih informatif
        $persentaseHadir = $totalKaryawan > 0 ? number_format(($hadirHariIni / $totalKaryawan) * 100, 1) : 0;
        $persentaseVisit = $totalOutlet > 0 ? number_format(($kunjunganHariIni / $totalOutlet) * 100, 1) : 0;

        return [
            Stat::make('Total Karyawan', $totalKaryawan . ' Orang')
                ->description('Seluruh pegawai terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([7, 10, 13, 15, 14, 17]),

            Stat::make('Total Outlet', $totalOutlet . ' Toko')
                ->description('Target lokasi operasional')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('info')
                ->chart([2, 3, 5, 4, 5, 5]),

            Stat::make('Hadir Hari Ini', $hadirHariIni . ' Pegawai')
                ->description($persentaseHadir . '% tingkat kehadiran')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([5, 8, 10, 12, $hadirHariIni]),

            Stat::make('Kunjungan Hari Ini', $kunjunganHariIni . ' Toko')
                ->description($persentaseVisit . '% dari total target outlet')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('warning')
                ->chart([1, 4, 3, 6, $kunjunganHariIni]),
        ];
    }
}