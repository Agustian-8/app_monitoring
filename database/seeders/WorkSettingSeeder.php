<?php

namespace Database\Seeders;

use App\Models\WorkSetting;
use Illuminate\Database\Seeder;

class WorkSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['day_of_week' => 0, 'day_name' => 'Minggu', 'jam_masuk' => null,    'jam_pulang' => null,    'is_active' => false],
            ['day_of_week' => 1, 'day_name' => 'Senin',  'jam_masuk' => '08:00', 'jam_pulang' => '17:00', 'is_active' => true],
            ['day_of_week' => 2, 'day_name' => 'Selasa', 'jam_masuk' => '08:00', 'jam_pulang' => '17:00', 'is_active' => true],
            ['day_of_week' => 3, 'day_name' => 'Rabu',   'jam_masuk' => '08:00', 'jam_pulang' => '17:00', 'is_active' => true],
            ['day_of_week' => 4, 'day_name' => 'Kamis',  'jam_masuk' => '08:00', 'jam_pulang' => '17:00', 'is_active' => true],
            ['day_of_week' => 5, 'day_name' => 'Jumat',  'jam_masuk' => '08:00', 'jam_pulang' => '17:00', 'is_active' => true],
            ['day_of_week' => 6, 'day_name' => 'Sabtu',  'jam_masuk' => '08:00', 'jam_pulang' => '13:00', 'is_active' => true],
        ];

        foreach ($settings as $s) {
            WorkSetting::updateOrCreate(
                ['day_of_week' => $s['day_of_week']],
                array_merge($s, ['toleransi_telat' => 0]) // 👈 Toleransi 0 menit
            );
        }
    }
}