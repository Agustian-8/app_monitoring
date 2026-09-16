<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Visit;
use App\Models\Outlet;
use Carbon\Carbon;

class VisitChart extends ChartWidget
{
    protected static ?string $heading = 'Pencapaian Target Kunjungan';
    protected static ?string $maxHeight = '275px';
    protected static ?int $sort = 3;
    protected static ?string $pollingInterval = '30s';
    
    protected int | string | array $columnSpan = [
        'sm' => 1,
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $totalOutlet = Outlet::count();
        $totalVisitHariIni = Visit::whereDate('created_at', Carbon::today())->count();
        $sisaTarget = max(0, $totalOutlet - $totalVisitHariIni);

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kunjungan',
                    'data' => [$totalVisitHariIni, $sisaTarget],
                    'backgroundColor' => [
                        '#3b82f6', // Biru cerah (Tercapai)
                        '#e2e8f0', // Abu-abu muda (Belum tercapai) -> Memberikan kontras progres yang baik
                    ],
                    'borderRadius' => 8, // Membuat ujung batang melengkung (rounded)
                    'barPercentage' => 0.4, // Membuat bar lebih ramping dan elegan
                ],
            ],
            'labels' => ['Sudah Dikunjungi', 'Belum Dikunjungi'],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; 
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false, // Disembunyikan karena label bawah sudah jelas (clean ui)
                ],
                'tooltip' => [
                    'enabled' => true,
                    'intersect' => false,
                    'mode' => 'index',
                ],
            ],
            'scales' => [
                'x' => [
                    'grid' => [
                        'display' => false, // Hilangkan garis vertikal yang membuat kotor tampilan
                    ],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => '#f1f5f9', // Buat garis horizontal sangat samar
                    ],
                    'ticks' => [
                        'stepSize' => 1, // Pastikan angka selalu bilangan bulat (1, 2, 3...)
                    ],
                ],
            ],
        ];
    }
}