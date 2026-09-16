<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin HRD
        User::updateOrCreate(
            ['email' => 'admin@pakita.com'],
            [
                'name'       => 'HRD Pakita Jaya',
                'no_hp'      => '081200000000',
                'password'   => Hash::make('password'),
                'role'       => 'admin',
                'department' => 'HRD',
            ]
        );

        // 2. Akun Sales (Tim TAS) — dengan no_hp biar bisa login
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
                    'name'       => $s['name'],
                    'no_hp'      => $s['no_hp'],
                    'password'   => Hash::make('password'),
                    'role'       => 'sales',
                    'department' => 'TAS',
                ]
            );
        }
    }
}