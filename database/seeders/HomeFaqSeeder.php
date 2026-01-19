<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeFaq;

class HomeFaqSeeder extends Seeder
{
    public function run(): void
    {
        HomeFaq::insert([
            [
                'question' => 'Apa yang dirasakan petani dalam waktu dekat setelah menggunakan Agroptimal?',
                'answer' => 'Dalam 14 hari pertama, petani akan merasakan ketenangan pikiran karena kondisi lahan dapat dipantau secara real-time, sehingga keputusan dapat diambil lebih cepat dan tepat.',
                'is_active' => true,
                'is_verified' => true,
                'sort_order' => 1,
            ],
            [
                'question' => 'Apakah nanti akan ada fitur pengajuan tender untuk memperluas monitoring?',
                'answer' => 'Ya. Agroptimal sedang mengembangkan fitur pengajuan tender yang memungkinkan pemilik lahan besar atau korporasi membuka pengadaan sistem monitoring secara transparan.',
                'is_active' => true,
                'is_verified' => true,
                'sort_order' => 2,
            ],
            [
                'question' => 'Bagaimana sensor tetap akurat meski di bawah kondisi cuaca ekstrem?',
                'answer' => 'Sensor Agroptimal menggunakan perangkat berstandar industri dengan perlindungan cuaca ekstrem, sehingga tetap stabil dan akurat meskipun terkena hujan deras atau panas tinggi.',
                'is_active' => true,
                'is_verified' => true,
                'sort_order' => 3,
            ],
            [
                'question' => 'Apakah data Agroptimal dapat diintegrasikan dengan sistem penyiraman otomatis?',
                'answer' => 'Bisa. Data dari sensor dapat diintegrasikan dengan sistem penyiraman otomatis sehingga air hanya digunakan saat kondisi tanah membutuhkan.',
                'is_active' => true,
                'is_verified' => true,
                'sort_order' => 4,
            ],
            [
                'question' => 'Bagaimana Agroptimal membantu meningkatkan hasil panen dalam jangka panjang?',
                'answer' => 'Dengan pemantauan berkelanjutan dan data historis, Agroptimal membantu petani memahami pola lahan sehingga kualitas dan konsistensi hasil panen dapat meningkat.',
                'is_active' => true,
                'is_verified' => true,
                'sort_order' => 5,
            ],
        ]);
    }
}

