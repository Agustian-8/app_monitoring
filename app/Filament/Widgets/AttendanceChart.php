<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Kehadiran Hari Ini';
    protected static ?string $maxHeight = '275px'; // Sedikit diperbesar agar doughnut tidak terlalu sempit
    protected static ?int $sort = 2;
    protected static ?string $pollingInterval = '30s';
    
    protected int | string | array $columnSpan = [
        'sm' => 1,
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $today = Carbon::today();

        $hadir = Attendance::whereDate('created_at', $today)->where('status', 'Hadir')->count();
        $izin = Attendance::whereDate('created_at', $today)->where('status', 'Izin')->count();
        $sakit = Attendance::whereDate('created_at', $today)->where('status', 'Sakit')->count();
        $dlk = Attendance::whereDate('created_at', $today)->where('status', 'DLK')->count();
        $training = Attendance::whereDate('created_at', $today)->where('status', 'Training')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pegawai',
                    'data' => [$hadir, $izin, $sakit, $dlk, $training],
                    'backgroundColor' => ['#10b981', '#f59e0b', '#ef4444', '#3b82f6', '#8b5cf6'],
                    'borderWidth' => 0, // Hilangkan garis tepi (stroke) putih untuk desain 'flat' elegan
                    'hoverOffset' => 12, // Pop-up animasi lebih besar saat di-hover
                ],
            ],
            'labels' => ['Hadir', 'Izin', 'Sakit', 'DLK', 'Training'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // Doughnut terlihat lebih premium dibandingkan 'pie'
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom', // Rapikan legend ke bagian bawah
                    'labels' => [
                        'usePointStyle' => true, // Mengubah kotak warna menjadi bulat yang lebih estetik
                        'padding' => 20,
                    ],
                ],
            ],
            'cutout' => '75%', // Ketebalan cincin chart
        ];
    }
}