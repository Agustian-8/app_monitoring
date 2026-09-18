<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ======================================================
        // 1. ADMIN / HRD (Manager HRD & Staff HRD)
        // ======================================================
        $adminHrd = [
            [
                'name'       => 'Manager HRD',
                'no_hp'      => '081200000010',
                'email'      => 'manager.hrd@pakita.com',
                'department' => 'HRD Manager',
            ],
            [
                'name'       => 'Staff HRD',
                'no_hp'      => '081200000011',
                'email'      => 'staff.hrd@pakita.com',
                'department' => 'HRD',
            ],
        ];

        foreach ($adminHrd as $a) {
            User::updateOrCreate(
                ['email' => $a['email']],
                [
                    'name'          => $a['name'],
                    'no_hp'         => $a['no_hp'],
                    'password'      => Hash::make('password'),
                    'role'          => 'admin',
                    'tipe_karyawan' => 'kantor',
                    'department'    => $a['department'],
                ]
            );
        }

        // ======================================================
        // 2. KARYAWAN KANTOR (Non-Sales)
        // ======================================================
        $kantor = [
            ['name' => 'Rina',  'no_hp' => '081200000201', 'dept' => 'Keuangan'],
            ['name' => 'Budi',  'no_hp' => '081200000202', 'dept' => 'Gudang'],
        ];

        foreach ($kantor as $k) {
            User::updateOrCreate(
                ['email' => strtolower($k['name']) . '@pakita.com'],
                [
                    'name'          => $k['name'],
                    'no_hp'         => $k['no_hp'],
                    'password'      => Hash::make('password'),
                    'role'          => 'karyawan',
                    'tipe_karyawan' => 'kantor',
                    'department'    => $k['dept'],
                ]
            );
        }

        // ======================================================
        // 3. SALES / LAPANGAN (Tim TAS)
        // ======================================================
        $sales = [
            ['name' => 'Andi',  'no_hp' => '081200000101'],
            ['name' => 'Siti',  'no_hp' => '081200000102'],
            ['name' => 'Aldi',  'no_hp' => '081200000103'],
            ['name' => 'Ika',   'no_hp' => '081200000104'],
            ['name' => 'Yani',  'no_hp' => '081200000105'],
            ['name' => 'Nisa',  'no_hp' => '081200000106'],
            ['name' => 'Joko',  'no_hp' => '081200000107'],
            ['name' => 'Arif',  'no_hp' => '081200000108'],
            ['name' => 'Yance', 'no_hp' => '081200000109'],
            ['name' => 'Mika',  'no_hp' => '081200000110'],
            ['name' => 'Ani',   'no_hp' => '081200000111'],
            ['name' => 'Salim', 'no_hp' => '081200000112'],
        ];

        foreach ($sales as $s) {
            User::updateOrCreate(
                ['email' => strtolower($s['name']) . '@pakita.com'],
                [
                    'name'          => $s['name'],
                    'no_hp'         => $s['no_hp'],
                    'password'      => Hash::make('password'),
                    'role'          => 'karyawan',
                    'tipe_karyawan' => 'lapangan',
                    'department'    => 'TAS',
                ]
            );
        }
    }
}