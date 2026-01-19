<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('home_data')->insert([
            'total_pupuk'      => 11500,
            'jenis_pupuk'      => 13,
            'petani_terdampak' => 109,
            'rating'           => 4.9,
            'is_active'        => true,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    }
}
