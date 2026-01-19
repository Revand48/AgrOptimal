<?php

namespace Database\Seeders;

use App\Models\TipsBibit;
use Illuminate\Database\Seeder;

class TipsBibitSeeder extends Seeder
{
    public function run()
    {
        TipsBibit::create([
            'step_number' => 1,
            'title' => 'Pilih Bibit Unggul & Sesuai Lahan',
            'description' => 'Bibit menentukan hasil panen sejak awal. Gunakan varietas yang teruji.',
            'content_padi' => '<p>Gunakan benih padi bersertifikat seperti Inpari atau Ciherang. Cocok untuk lahan kecil dan hasil stabil.</p><ul class="list-disc pl-5 mt-2"><li>Daya tumbuh seragam</li><li>Tahan penyakit blas</li><li>Umur panen ±110 hari</li></ul>',
            'content_jagung' => '<p>Pilih jagung hibrida tahan kering untuk tanam terus-menerus.</p><ul class="list-disc pl-5 mt-2"><li>Tongkol seragam</li><li>Tahan bulai</li><li>Cocok lahan tadah hujan</li></ul>',
            'content_kedelai' => '<p>Gunakan varietas kedelai berumur genjah agar panen lebih cepat.</p><ul class="list-disc pl-5 mt-2"><li>Umur panen ±80 hari</li><li>Biji besar & seragam</li></ul>',
            'content_singkong' => '<p>Gunakan stek batang sehat, bukan dari tanaman tua.</p><ul class="list-disc pl-5 mt-2"><li>Batang keras & segar</li><li>Tidak berjamur</li></ul>',
            'content_ubi' => '<p>Pilih stek ubi jalar dari tanaman produktif.</p><ul class="list-disc pl-5 mt-2"><li>Daun hijau segar</li><li>Tidak terserang hama</li></ul>',
        ]);
        
        TipsBibit::create([
            'step_number' => 2,
            'title' => 'Perlakuan Benih Sebelum Tanam',
            'description' => 'Lakukan perendaman atau treatment khusus untuk mematahkan dormansi dan mencegah penyakit.',
            'content_padi' => '<p>Rendam benih dalam air garam (3%) untuk memisahkan benih hampa. Bilas lalu rendam 24 jam.</p>',
            'content_jagung' => '<p>Campurkan benih dengan fungisida (misal: metalaksil) untuk mencegah penyakit bulai sejak dini.</p>',
            'content_kedelai' => '<p>Inokulasi dengan Rhizobium jika ditanam di lahan baru untuk membantu penambatan nitrogen.</p>',
            'content_singkong' => '<p>Rendam stek dalam larutan ZPT (Zat Pengatur Tumbuh) sebentar sebelum tanam.</p>',
            'content_ubi' => '<p>Letakkan stek di tempat teduh selama 1-2 hari sebelum tanam agar layu sedikit dan akar cepat keluar.</p>',
        ]);
    }
}
