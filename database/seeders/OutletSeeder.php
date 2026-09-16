<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outlet;

class OutletSeeder extends Seeder
{
    public function run(): void
    {
        $outlets = [
            [
                'name'         => 'Toko Maju Jaya',
                'address'      => 'Jl. Ahmad Yani, Pontianak',
                'phone_number' => '081200000001',
                'latitude'     => -0.025994,
                'longitude'    => 109.340556,
                'radius_meters' => 50,
            ],
            [
                'name'         => 'Toko Abadi Makmur',
                'address'      => 'Jl. Gajah Mada, Pontianak',
                'phone_number' => '081200000002',
                'latitude'     => -0.030215,
                'longitude'    => 109.335678,
                'radius_meters' => 50,
            ],
            [
                'name'         => 'Minimarket Sentosa',
                'address'      => 'Jl. Tanjung Pura, Pontianak',
                'phone_number' => '081200000003',
                'latitude'     => -0.021234,
                'longitude'    => 109.328765,
                'radius_meters' => 50,
            ],
            [
                'name'         => 'Grosir Berkah',
                'address'      => 'Jl. Pahlawan, Pontianak',
                'phone_number' => '081200000004',
                'latitude'     => -0.018567,
                'longitude'    => 109.342100,
                'radius_meters' => 100, // outlet besar → radius lebih luas
            ],
            [
                'name'         => 'Warung Kopi Aming',
                'address'      => 'Jl. H. Abbas, Pontianak',
                'phone_number' => '081200000005',
                'latitude'     => -0.034567,
                'longitude'    => 109.334500,
                'radius_meters' => 50,
            ],
        ];

        foreach ($outlets as $outlet) {
            Outlet::updateOrCreate(
                ['name' => $outlet['name']],
                $outlet
            );
        }
    }
}