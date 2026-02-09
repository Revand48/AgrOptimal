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
            'title' => 'Pembersihan & Pembukaan',
            'description' => 'Langkah awal membersihkan lahan dari gulma dan sisa tanaman sebelumnya.',
            'content_padi' => '<p>Bersihkan jerami sisa panen. Jerami bisa dibakar (abu untuk pupuk) atau difermentasi jadi kompos. Perbaiki pematang sawah agar air tidak bocor.</p>',
            'content_jagung' => '<p>Babat habis gulma dan alang-alang. Semprot herbisida jika perlu, tunggu 1 minggu sebelum olah tanah. Bersihkan sisa tongkol jagung lama.</p>',
            'content_kedelai' => '<p>Lahan harus bersih total dari gulma karena kedelai kalah bersaing di awal tumbuh. Kumpulkan sisa tanaman di pinggir, jangan dibakar di tengah petak.</p>',
            'content_singkong' => '<p>Bersihkan semak belukar. Singkong butuh lahan terbuka penuh sinar matahari. Sisa tanaman bisa ditimbun untuk jadi pupuk organik.</p>',
            'content_ubi' => '<p>Pastikan lahan bebas dari sisa akar tanaman keras yang bisa menghambat perkembangan umbi. Gemburkan tanah secara merata.</p>',
        ]);

        TipsLahan::create([
            'step_number' => 2,
            'title' => 'Pengolahan Tanah Dasar',
            'description' => 'Membalik dan menggemburkan tanah agar sirkulasi udara dan air lancar.',
            'content_padi' => '<p>Lakukan pembajakan pertama (singkal) sedalam 20-30 cm. Balik tanah agar bahan organik di atas masuk ke bawah. Genangi air 3-7 hari.</p>',
            'content_jagung' => '<p>Bajak sedalam 20cm. Jika tanah sudah gembur, cukup Olah Tanah Minimum (OTM) hanya di barisan tanam. Buat saluran drainase keliling.</p>',
            'content_kedelai' => '<p>Tanah tidak perlu diolah terlalu dalam, cukup dicangkul ringan atau digaru. Kedelai lebih suka struktur tanah yang mantap tapi gembur.</p>',
            'content_singkong' => '<p>Cangkul tanah sedalam mungkin (30-40cm). Tanah yang dalam dan remah membuat singkong tumbuh lurus dan panjang.</p>',
            'content_ubi' => '<p>Tanah harus dicangkul sampai benar-benar remah. Hancurkan bongkahan tanah yang keras agar kulit umbi mulus.</p>',
        ]);

        TipsLahan::create([
            'step_number' => 3,
            'title' => 'Pembentukan Bedengan',
            'description' => 'Membentuk area tanam yang ideal sesuai kebutuhan air tanaman.',
            'content_padi' => '<p>Ratakan tanah (lumpur) dengan garu. Buat "kubangan" rata sempurna agar tinggi air merata. Perbaiki parit keliling untuk pengaturan air.</p>',
            'content_jagung' => '<p>Buat bedengan lebar 100cm jika daerah sering hujan. Jika kering, tanam rata tanah tapi buat guludan pembumbunan nanti.</p>',
            'content_kedelai' => '<p>Buat bedengan lebar 2-3 meter. Antar bedengan dibuat dainase sedalam 20-30cm agar akar tidak terendam air (kedelai tidak tahan genangan).</p>',
            'content_singkong' => '<p>Wajib dibuat guludan/gundukan. Jarak antar pusat guludan 100cm. Tinggi guludan minimal 20cm.</p>',
            'content_ubi' => '<p>Buat guludan tinggi (30-50 cm). Semakin tinggi guludan, semakin leluasa umbi berkembang dan panen semakin mudah.</p>',
        ]);

        TipsLahan::create([
            'step_number' => 4,
            'title' => 'Pemberian Kapur & Dasar',
            'description' => 'Koreksi pH tanah dan pemberian nutrisi awal sebelum tanam.',
            'content_padi' => '<p>Sebar pupuk kandang 2 ton/ha saat garu terakhir. Jika pH < 5, sebar Dolomit dan diamkan 1 minggu sebelum tanam.</p>',
            'content_jagung' => '<p>Berikan pupuk kandang pada jalur tanam. Campur Dolomit jika tanah asam. Aplikasi 1-2 minggu sebelum tanam.</p>',
            'content_kedelai' => '<p>Tabur pupuk kandang matang. Kedelai butuh Ca dan Mg, jadi Dolomit sangat dianjurkan di tanah masam.</p>',
            'content_singkong' => '<p>Pupuk kandang dicampur saat pembuatan guludan. Singkong butuh banyak hara karena masa tanam panjang.</p>',
            'content_ubi' => '<p>Pupuk kandang ayam/kambing sangat bagus dicampur dalam guludan. Tambahkan SP-36 sebagai pupuk dasar untuk memacu akar.</p>',
        ]);
    }
}
