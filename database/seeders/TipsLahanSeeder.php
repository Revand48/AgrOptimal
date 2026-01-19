<?php

namespace Database\Seeders;

use App\Models\TipsLahan;
use Illuminate\Database\Seeder;

class TipsLahanSeeder extends Seeder
{
    public function run()
    {
        TipsLahan::create([
            'step_number' => 1,
            'title' => 'Pengolahan Tanah Dasar',
            'description' => 'Gemburkan tanah agar akar tanaman dapat tumbuh optimal.',
            'content_padi' => '<p>Bajak tanah sedalam 20-30 cm, lalu genangi air selama 1 minggu untuk membusukkan sisa tanaman.</p>',
            'content_jagung' => '<p>Lakukan pembajakan atau tanpa olah tanah (TOT) jika lahan sudah gembur. Buat drainase yang baik.</p>',
            'content_kedelai' => '<p>Tanah dibajak ringan. Bersihkan gulma. Buat saluran air setiap 3-4 meter bedengan.</p>',
            'content_singkong' => '<p>Buat gundukan/bedengan tinggi agar umbi bisa membesar dengan leluasa.</p>',
            'content_ubi' => '<p>Buat guludan tinggi (30-40 cm) agar umbi tidak terendam air dan mudah dipanen.</p>',
        ]);

        TipsLahan::create([
            'step_number' => 2,
            'title' => 'Pengaturan pH Tanah',
            'description' => 'Tanah asam menghambat penyerapan nutrisi. Lakukan pengapuran jika perlu.',
            'content_padi' => '<p>Cek pH tanah. Jika < 5.5, taburkan kapur dolomit 1 ton/ha saat pengolahan tanah terakhir.</p>',
            'content_jagung' => '<p>Jagung butuh pH 5.5-7.0. Berikan dolomit 2 minggu sebelum tanam jika tanah terlalu asam.</p>',
            'content_kedelai' => '<p>Sangat sensitif terhadap tanah asam. Pastikan pH sekitar 6.0 untuk hasil maksimal.</p>',
            'content_singkong' => '<p>Toleran terhadap pH rendah, tapi hasil terbaik di pH 5.5-6.5. Berikan kapur secukupnya.</p>',
            'content_ubi' => '<p>Cocok di pH 5.5-6.5. Hindari tanah yang terlalu padat dan basah.</p>',
        ]);
    }
}
