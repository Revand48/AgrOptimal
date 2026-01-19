<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatans = [
            'Balongbendo',
            'Buduran',
            'Candi',
            'Gedangan',
            'Jabon',
            'Krembung',
            'Krian',
            'Porong',
            'Prambon',
            'Sedati',
            'Sidoarjo',
            'Sukodono',
            'Taman',
            'Tanggulangin',
            'Tarik',
            'Tulangan',
            'Waru',
            'Wonoayu',
        ];

        foreach ($kecamatans as $kecamatan) {
            Kecamatan::firstOrCreate(['nama' => $kecamatan]);
        }
    }
}
