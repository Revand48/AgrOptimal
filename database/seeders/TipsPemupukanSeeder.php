<?php

namespace Database\Seeders;

use App\Models\TipsPemupukan;
use Illuminate\Database\Seeder;

class TipsPemupukanSeeder extends Seeder
{
    public function run()
    {
        TipsPemupukan::create([
            'step_number' => 1,
            'title' => 'Pemupukan Dasar',
            'description' => 'Berikan nutrisi awal saat tanam untuk start pertumbuhan yang baik.',
            'content_padi' => '<p>Gunakan Pupuk Kandang 2 ton/ha dan Urea+SP36 saat tanam. Sebar merata.</p>',
            'content_jagung' => '<p>Berikan NPK dan Urea di lubang tanam atau ditugal samping benih (jarak 5cm).</p>',
            'content_kedelai' => '<p>Berikan pupuk dasar NPK rendah N (karena kedelai mengikat N sendiri). Fokus P dan K.</p>',
            'content_singkong' => '<p>Pupuk kandang sangat penting. Berikan saat pembuatan guludan.</p>',
            'content_ubi' => '<p>Gunakan pupuk kandang matang dan KCL tinggi untuk pembentukan umbi.</p>',
        ]);

        TipsPemupukan::create([
            'step_number' => 2,
            'title' => 'Pemupukan Susulan',
            'description' => 'Tambahkan nutrisi pada fase vegetatif dan generatif.',
            'content_padi' => '<p>Susulan 1 (14 HST): Urea. Susulan 2 (30 HST): Urea+Phonska. Jaga air tetap macak-macak.</p>',
            'content_jagung' => '<p>Umur 21 HST dan 45 HST. Berikan Urea lagi untuk memacu pertumbuhan batang dan daun.</p>',
            'content_kedelai' => '<p>Saat berbunga (30 HST), bisa ditambah pupuk daun gandasil B untuk pengisian polong.</p>',
            'content_singkong' => '<p>Umur 3 bulan, berikan KCL atau NPK untuk memacu pembesaran umbi.</p>',
            'content_ubi' => '<p>Umur 45 hari, berikan ZA dan KCL. Jangan terlalu banyak Urea agar tidak hanya daun yang lebat.</p>',
        ]);
    }
}
