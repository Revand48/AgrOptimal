<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CekTanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $steps = [
            [
                'title' => 'Amati Warna Tanah',
                'slug' => 'amati-warna-tanah',
                'content' => 'Tanah yang subur biasanya berwarna lebih gelap (hitam atau coklat tua) karena kaya akan bahan organik. Tanah yang pucat atau kekuningan mungkin kurang subur.',
                'step_number' => 1,
            ],
            [
                'title' => 'Periksa Tekstur Tanah',
                'slug' => 'periksa-tekstur-tanah',
                'content' => 'Ambil segenggam tanah basah. Jika tanah bisa dibentuk menjadi bola dan tidak mudah hancur, berarti teksturnya baik (lempung). Jika kasar dan berpasir, kemampuan menahan airnya rendah.',
                'step_number' => 2,
            ],
            [
                'title' => 'Cek Kehidupan Mikroorganisme',
                'slug' => 'cek-kehidupan-mikroorganisme',
                'content' => 'Gali tanah sekitar 10-20 cm. Adanya cacing tanah, serangga kecil, atau akar tanaman yang sehat menandakan tanah tersebut subur dan beraerasi baik.',
                'step_number' => 3,
            ],
            [
                'title' => 'Uji Drainase Sederhana',
                'slug' => 'uji-drainase-sederhana',
                'content' => 'Buat lubang kecil dan isi dengan air. Jika air meresap habis dalam waktu moderat (15-30 menit), drainase baik. Jika menggenang terlalu lama atau hilang sangat cepat, mungkin perlu perbaikan.',
                'step_number' => 4,
            ],
        ];

        foreach ($steps as $step) {
            \App\Models\CekTanah::firstOrCreate(['slug' => $step['slug']], $step);
        }
    }
}
