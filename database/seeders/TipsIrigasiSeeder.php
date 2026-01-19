<?php

namespace Database\Seeders;

use App\Models\TipsIrigasi;
use Illuminate\Database\Seeder;

class TipsIrigasiSeeder extends Seeder
{
    public function run()
    {
        TipsIrigasi::create([
            'step_number' => 1,
            'title' => 'Manajemen Air Fase Vegetatif',
            'description' => 'Fase awal pertumbuhan membutuhkan kelembapan tanah yang stabil untuk perkembangan akar.',
            'content_padi' => '<p>Pertahankan ketinggian air 2-3 cm (macak-macak) selama 14 hari setelah tanam untuk merangsang anakan.</p>',
            'content_jagung' => '<p>Siram pagi/sore hari. Tanah harus lembab tapi tidak menggenang agar akar tidak busuk.</p>',
            'content_kedelai' => '<p>Butuh air cukup saat awal tanam. Pastikan drainase lancar, kedelai tidak suka genangan.</p>',
            'content_singkong' => '<p>Penyiraman hanya diperlukan jika tanah sangat kering di 2 bulan pertama.</p>',
            'content_ubi' => '<p>Jaga kelembapan tanah di minggu 1-4 untuk pembentukan akar yang kuat.</p>',
        ]);

        TipsIrigasi::create([
            'step_number' => 2,
            'title' => 'Pengairan Fase Pembungaan & Pembuahan',
            'description' => 'Kekurangan air di fase ini dapat menyebabkan bunga rontok dan hasil panen menurun drastis.',
            'content_padi' => '<p>Genangi sawah 5-7 cm saat bunting hingga pembungaan. Jangan sampai kekeringan!</p>',
            'content_jagung' => '<p>Fase kritis! Pastikan air cukup saat keluar bunga jantan/betina (45-55 HST).</p>',
            'content_kedelai' => '<p>Fase pengisian polong butuh banyak air. Lakukan pengairan leb jika tidak ada hujan.</p>',
            'content_singkong' => '<p>Tahan kekeringan, tapi hasil umbi lebih besar jika ada hujan/siram sesekali.</p>',
            'content_ubi' => '<p>Kurangi air jelang panen agar umbi manis dan tidak mudah busuk.</p>',
        ]);
    }
}
