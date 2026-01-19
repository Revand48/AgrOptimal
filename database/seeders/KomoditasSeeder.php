<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KomoditasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crops = [
            [
                'nama' => 'Padi',
                'slug' => 'padi',
                'duration_days' => 110,
                'yield_per_ha' => 6.0,
                'price_per_kg' => 6000,
                'risks' => ['Wereng', 'Tikus', 'Burung', 'Potensi Rebah', 'Kekeringan'],
                'description' => 'Tanaman pangan utama. Membutuhkan irigasi cukup.',
            ],
            [
                'nama' => 'Jagung',
                'slug' => 'jagung',
                'duration_days' => 95,
                'yield_per_ha' => 7.0,
                'price_per_kg' => 4500,
                'risks' => ['Ulat Grayak', 'Bulai', 'Penggerek Batang'],
                'description' => 'Tanaman palawija populer. Rawan serangan ulat grayak.',
            ],
            [
                'nama' => 'Kedelai',
                'slug' => 'kedelai',
                'duration_days' => 85,
                'yield_per_ha' => 2.5,
                'price_per_kg' => 9000,
                'risks' => ['Ulat Polong', 'Kutu Kebul', 'Busuk Akar'],
                'description' => 'Tanaman legum kaya protein.',
            ],
            [
                'nama' => 'Singkong',
                'slug' => 'singkong',
                'duration_days' => 240,
                'yield_per_ha' => 25.0,
                'price_per_kg' => 1500,
                'risks' => ['Tungau Merah', 'Busuk Umbi'],
                'description' => 'Tanaman umbi jangka panjang. Relatif tahan kering.',
            ],
            [
                'nama' => 'Ubi Jalar',
                'slug' => 'ubi-jalar',
                'duration_days' => 120,
                'yield_per_ha' => 15.0,
                'price_per_kg' => 3000,
                'risks' => ['Lanas', 'Penggerek Umbi', 'Busuk Umbi'],
                'description' => 'Tanaman umbi cepat panen.',
            ],
        ];

        foreach ($crops as $crop) {
            \App\Models\Komoditas::updateOrCreate(
                ['slug' => $crop['slug']],
                $crop
            );
        }
    }
}
