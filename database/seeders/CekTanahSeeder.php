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
                'step_number' => 1,
                'title' => 'Amati Warna Tanah',
                'slug' => 'amati-warna-tanah',
                'description' => 'Warna tanah memberikan petunjuk awal tentang kandungan bahan organik dan kesuburannya.',
                'content_padi' => '<p>Tanah sawah yang baik berwarna hitam atau kelabu tua. Hindari tanah yang berwarna merah bata cerah karena indikasi kurang bahan organik dan terlalu asam.</p>',
                'content_jagung' => '<p>Jagung menyukai tanah berwarna gelap (humus tinggi). Tanah kuning/pucat perlu penambahan pupuk kandang sebelum tanam.</p>',
                'content_kedelai' => '<p>Tanah gembur berwarna coklat tua sangat ideal. Hindari tanah yang terlalu liat dan berwarna pucat.</p>',
                'content_singkong' => '<p>Toleran di tanah merah/kuning asalkan gembur. Namun hasil terbaik di tanah coklat kehitaman.</p>',
                'content_ubi' => '<p>Tanah berpasir atau lempung berpasir berwarna gelap paling baik untuk pembentukan umbi yang mulus.</p>',
            ],
            [
                'step_number' => 2,
                'title' => 'Uji Tekstur (Metode Remas)',
                'slug' => 'uji-tekstur',
                'description' => 'Tekstur tanah menentukan kemampuan menahan air dan perkembangan akar.',
                'content_padi' => '<p>Ambil segenggam tanah basah. Padi butuh tanah lempung berliat yang bisa menahan air (tidak mudah hancur saat dibentuk bola).</p>',
                'content_jagung' => '<p>Tanah lempung berpasir adalah yang terbaik. Tidak menggenang air tapi masih lembab saat diremas.</p>',
                'content_kedelai' => '<p>Hindari tanah yang sangat lengket (liat berat) karena akar kedelai sulit menembus. Tanah lempung gembur paling pas.</p>',
                'content_singkong' => '<p>Tanah remah dan gembur sangat penting agar umbi bisa membesar. Tanah padat/liat membuat umbi kecil dan bengkok.</p>',
                'content_ubi' => '<p>Sangat butuh tanah remah. Jika tanah terlalu keras saat kering, umbi akan sulit berkembang.</p>',
            ],
            [
                'step_number' => 3,
                'title' => 'Cek Kehidupan Biologis',
                'slug' => 'cek-biologis',
                'description' => 'Keberadaan makhluk hidup kecil menandakan tanah sehat dan bebas racun.',
                'content_padi' => '<p>Gali lumpur sawah. Adanya cacing air atau keong kecil menandakan ekosistem sawah masih baik dan tidak keracunan pestisida.</p>',
                'content_jagung' => '<p>Cari cacing tanah di kedalaman 10-20 cm. Semakin banyak cacing, semakin subur dan gembur tanah untuk jagung.</p>',
                'content_kedelai' => '<p>Perhatikan bintil akar pada tanaman liar sejenis kacang-kacangan di sekitar. Jika ada bintil merah muda, bakteri Rhizobium alami sudah ada.</p>',
                'content_singkong' => '<p>Tanah yang sehat untuk singkong biasanya ditumbuhi rumput liar yang subur. Jika rumput kerdil, tanah mungkin miskin hara.</p>',
                'content_ubi' => '<p>Pastikan tidak ada hama uret (larva kumbang) saat menggali, karena uret musuh utama umbi jalar.</p>',
            ],
            [
                'step_number' => 4,
                'title' => 'Uji Keasaman (Pakai Kunyit)',
                'slug' => 'uji-ph-kunyit',
                'description' => 'Metode tradisional untuk mengetahui apakah tanah asam atau netral.',
                'content_padi' => '<p>Masukkan potongan kunyit ke tanah basah. Jika warna kunyit pudar, tanah asam (perlu kapur). Padi toleran asam tapi hasil turun jika pH < 4.</p>',
                'content_jagung' => '<p>Jagung butuh pH netral (6-7). Jika kunyit jadi kuning pucat, segera berikan dolomit 2 minggu sebelum tanam.</p>',
                'content_kedelai' => '<p>Kedelai gagal tumbuh di tanah asam. Pastikan warna kunyit tetap cerah atau pekat saat diuji.</p>',
                'content_singkong' => '<p>Singkong cukup tahan tanah asam. Namun jika kunyit berubah sangat pucat, produktivitas tetap akan terganggu.</p>',
                'content_ubi' => '<p>Ideal di pH 5.5 - 6.5. Tanah yang terlalu kapur (basa) justru bikin kulit umbi kudisan (scab).</p>',
            ],
        ];

        foreach ($steps as $step) {
            \App\Models\CekTanah::updateOrCreate(['slug' => $step['slug']], $step);
        }
    }
}
