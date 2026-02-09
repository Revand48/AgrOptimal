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
            'title' => 'Pemupukan Dasar (0 HST)',
            'description' => 'Fondasi nutrisi saat tanam untuk start pertumbuhan yang kuat.',
            'content_padi' => '<p>Aplikasikan sebelum tanam atau 0-7 HST. Gunakan Urea, SP-36, dan KCL. Fokus pada Fosfor (SP-36) untuk perakaran kuat.</p>',
            'content_jagung' => '<p>Berikan seluruh dosis SP-36 dan sebagian Urea + KCL di lubang tugal jarak 5cm dari benih. Tutup tanah.</p>',
            'content_kedelai' => '<p>Berikan NPK Phonska saat tanam. Kedelai tidak butuh banyak Urea karena bisa ikat N sendiri. Pastikan P dan K cukup.</p>',
            'content_singkong' => '<p>Saat tanam stek, berikan pupuk kandang + sedikit Urea/NPK di sekitar stek untuk memacu tunas.</p>',
            'content_ubi' => '<p>Pupuk dasar NPK diberikan 1/3 dosis saat tanam. Selebihnya pupuk kandang matang.</p>',
        ]);

        TipsPemupukan::create([
            'step_number' => 2,
            'title' => 'Pemupukan Susulan I (Fase Vegetatif)',
            'description' => 'Memacu pertumbuhan daun, batang, dan anakan.',
            'content_padi' => '<p>Umur 14 HST. Berikan Urea untuk memacu anakan. Pastikan air macak-macak agar pupuk terserap dan tidak hanyut.</p>',
            'content_jagung' => '<p>Umur 21-30 HST. Berikan Urea dosis tinggi untuk pertumbuhan batang dan daun lebar. Timbun pupuk agar tidak menguap.</p>',
            'content_kedelai' => '<p>Umur 15-20 HST. Jika daun tampak kuning, berikan sedikit Urea. Semprot Pupuk Daun kandungan N tinggi.</p>',
            'content_singkong' => '<p>Umur 1 bulan. Gali parit kecil keliling tanaman, tebar Urea+KCL, lalu tutup kembali (pembumbunan).</p>',
            'content_ubi' => '<p>Umur 3-4 minggu. Berikan Urea dan KCL. Lakukan pembumbunan (menaikkan tanah) untuk menutup pupuk.</p>',
        ]);

        TipsPemupukan::create([
            'step_number' => 3,
            'title' => 'Pemupukan Susulan II (Generatif Awal)',
            'description' => 'Persiapan pembentukan bunga, buah, atau umbi.',
            'content_padi' => '<p>Umur 30-40 HST (Bunting). Kurangi Urea, tambah KCL/NPK. KCL memperkuat batang agar tidak rebah dan bulir isi penuh.</p>',
            'content_jagung' => '<p>Umur 45-50 HST. Berikan Urea terakhir + KCL. Penting untuk pembentukan tongkol yang besar dan penuh.</p>',
            'content_kedelai' => '<p>Saat mulai berbunga (35 HST). Berikan pupuk KCL atau semprot Gandasil B/MKP untuk mencegah bunga rontok.</p>',
            'content_singkong' => '<p>Umur 3-4 bulan. Fokus KCL tinggi untuk pembesaran umbi. Kurangi N agar tidak rimbun daun saja.</p>',
            'content_ubi' => '<p>Umur 6-8 minggu. Berikan KCL dosis tinggi dan ZA. Ini fase krusial pembentukan umbi.</p>',
        ]);

        TipsPemupukan::create([
            'step_number' => 4,
            'title' => 'Nutrisi Tambahan & Mikro',
            'description' => 'Penyempurnaan hasil panen dengan unsur mikro dan perlakuan khusus.',
            'content_padi' => '<p>Saat keluar malai (60 HST), semprot pupuk daun Kalium (MKP) dan fungisida pencegah jamur. Bulir akan bening dan bernas.</p>',
            'content_jagung' => '<p>Jika daun ungu, tandanya kurang Fosfor/Magnesium. Semprot pupuk mikro. Jaga air saat pengisian biji.</p>',
            'content_kedelai' => '<p>Saat pengisian polong, semprot insektisida nabati pengusir kepik. Pastikan Kalsium cukup agar polong tidak pecah.</p>',
            'content_singkong' => '<p>Tidak perlu pupuk kimia lagi setelah 5 bulan. Jaga kebersihan gulma agar nutrisi tanah fokus ke umbi.</p>',
            'content_ubi' => '<p>Balikkan batang (jika varietas menjalar liar) agar tidak tumbuh akar di ruas batang yang mengurangi besar umbi utama.</p>',
        ]);
    }
}
