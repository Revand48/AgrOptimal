<?php

namespace App\Http\Controllers;

use App\Models\Simulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SimulasiController extends Controller
{
    public function index()
    {
        $simulasis = Simulasi::latest()->take(5)->get(); // Show recent history

        // Define options for dropdowns
        $options = [
            'musim' => ['Musim Hujan', 'Peralihan', 'Musim Kemarau'],
            'air' => ['Cukup & Stabil', 'Cukup tapi Tidak Stabil', 'Kurang'],
            'pupuk' => ['Organik + NPK Seimbang', 'NPK Sesuai Dosis', 'NPK Kurang / Tidak Seimbang', 'Tanpa Pupuk'],
            'tanah' => ['Subur (Tekstur baik, pH sesuai)', 'Sedang', 'Kurang Subur'],
            'kepadatan' => ['Sesuai Rekomendasi', 'Terlalu Rapat', 'Terlalu Jarang'],
            'varietas' => ['Unggul & Sesuai Wilayah', 'Lokal Biasa', 'Tidak Sesuai Agroklimat'],
            'hama' => ['Terkontrol Baik', 'Ada Gangguan Ringan', 'Parah'],
        ];

        // Fetch from DB for Tanaman options
        $komoditas = \App\Models\Komoditas::where('is_active', true)->get();
        $tanamanList = $komoditas->mapWithKeys(function ($item) {
            return [$item->nama => [
                'harvest_days' => $item->duration_days,
                'yield_per_ha' => $item->yield_per_ha,
            ]];
        })->toArray();

        return view('users.simulasi', compact('simulasis', 'options', 'tanamanList'));
    }

    /**
     * KALKULASI LOKAL (SCIENTIFIC MODEL)
     * Menggunakan Multiplicative Weighted Index (FAO/MDPI Model)
     * Diperluas dengan Logic Expert System untuk Rekomendasi
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'luas_lahan' => 'required|numeric|min:0.01',
            'jenis_tanaman' => 'required|string',
            'musim_tanam' => 'required|string',
            'kondisi_air' => 'required|string',
            'pemupukan' => 'required|string',
            'kondisi_tanah' => 'required|string',
            'kepadatan' => 'required|string',
            'varietas' => 'required|string',
            'hama_penyakit' => 'required|string',
        ]);

        $item = \App\Models\Komoditas::where('nama', $request->jenis_tanaman)->first();

        if (! $item) {
            return response()->json(['status' => 'error', 'message' => 'Tanaman tidak ditemukan.'], 404);
        }

        // --- KATEGORISASI TANAMAN UNTUK LOGIKA DINAMIS ---
        $cropType = 'Palawija'; // Default
        if (str_contains(strtolower($request->jenis_tanaman), 'padi')) {
            $cropType = 'Padi';
        } elseif (in_array($request->jenis_tanaman, ['Bawang Merah', 'Cabai Merah', 'Cabai Rawit', 'Tomat', 'Kentang', 'Wortel'])) {
            $cropType = 'Hortikultura';
        }

        // --- DEFINISI BOBOT DINAMIS (Dynamic Weights) ---
        $weights = [
            'musim' => [
                'Musim Hujan' => match ($cropType) {
                    'Padi' => 1.00,
                    'Hortikultura' => 0.60, // Risiko tinggi gagal panen
                    default => 0.85,
                },
                'Peralihan' => 0.95,
                'Musim Kemarau' => match ($cropType) {
                    'Padi' => 0.70, // Risiko kekeringan (kecuali irigasi teknis)
                    'Hortikultura' => 1.00, // Bagus untuk cabai/bawang (minim hama)
                    default => 0.90,
                },
            ],
            'air' => [
                'Cukup & Stabil' => 1.00,
                'Cukup tapi Tidak Stabil' => match ($cropType) {
                    'Padi' => 0.80,
                    default => 0.90,
                },
                'Kurang' => match ($cropType) {
                    'Padi' => 0.50,
                    'Palawija' => 0.70,
                    default => 0.60,
                },
            ],
            'pupuk' => [
                'Organik + NPK Seimbang' => 1.05,
                'NPK Sesuai Dosis' => 1.00,
                'NPK Kurang / Tidak Seimbang' => 0.85,
                'Tanpa Pupuk' => 0.60,
            ],
            'tanah' => [
                'Subur (Tekstur baik, pH sesuai)' => 1.00,
                'Sedang' => 0.85,
                'Kurang Subur' => 0.70,
            ],
            'kepadatan' => [
                'Sesuai Rekomendasi' => 1.00,
                'Terlalu Rapat' => 0.80,
                'Terlalu Jarang' => 0.85,
            ],
            'varietas' => [
                'Unggul & Sesuai Wilayah' => 1.05,
                'Lokal Biasa' => 0.90,
                'Tidak Sesuai Agroklimat' => 0.70,
            ],
            'hama' => [
                'Terkontrol Baik' => 1.00,
                'Ada Gangguan Ringan' => 0.85,
                'Parah' => 0.50,
            ],
        ];

        // --- AMBIL NILAI KOEFISIEN ---
        $FaktorMusim = $weights['musim'][$request->musim_tanam] ?? 0.80;
        $FaktorAir = $weights['air'][$request->kondisi_air] ?? 0.80;
        $FaktorPupuk = $weights['pupuk'][$request->pemupukan] ?? 0.65;
        $FaktorTanah = $weights['tanah'][$request->kondisi_tanah] ?? 0.70;
        $FaktorKepadatan = $weights['kepadatan'][$request->kepadatan] ?? 0.90;
        $FaktorVarietas = $weights['varietas'][$request->varietas] ?? 0.75;
        $FaktorHama = $weights['hama'][$request->hama_penyakit] ?? 0.60;

        // --- HITUNG YIELD SCORE ---
        $SkorMentah = 100 * $FaktorMusim * $FaktorAir * $FaktorPupuk * $FaktorTanah * $FaktorKepadatan * $FaktorVarietas * $FaktorHama;
        $SkorAkhir = min(100, max(0, $SkorMentah));

        // --- HITUNG PREDIKSI HASIL ---
        $PotensiPerHa = $item->yield_per_ha;
        $HasilPanenReal = $PotensiPerHa * $request->luas_lahan * ($SkorAkhir / 100);

        // --- INTERPRETASI SKOR ---
        if ($SkorAkhir >= 80) {
            $LabelKategori = 'Sangat Layak';
            $WarnaLabel = 'green';
            $PesanKategori = 'Kondisi lahan sangat mendukung produktivitas maksimal.';
        } elseif ($SkorAkhir >= 60) {
            $LabelKategori = 'Cukup Layak';
            $WarnaLabel = 'blue';
            $PesanKategori = 'Potensi hasil cukup baik, namun perlu perbaikan teknis.';
        } elseif ($SkorAkhir >= 40) {
            $LabelKategori = 'Kurang Layak';
            $WarnaLabel = 'yellow';
            $PesanKategori = 'Risiko tinggi penurunan hasil, perlu intervensi serius.';
        } else {
            $LabelKategori = 'Tidak Layak';
            $WarnaLabel = 'red';
            $PesanKategori = 'Kondisi lingkungan sangat tidak mendukung komoditas ini.';
        }

        // --- LOGIKA RESIKO & SOLUSI DETIL (REPLACEMENT FOR AI) ---
        $Risiko = [];
        $Solusi = [];

        // 1. Analisis Musim & Air
        if ($cropType == 'Hortikultura' && $request->musim_tanam == 'Musim Hujan') {
            $Risiko[] = 'Silent Killer: Kelembaban tinggi memicu serangan jamur (Antraknosa/Patek) dan bakteri layu.';
            $Solusi[] = 'Gunakan fungisida berbahan aktif Mankozeb/Propineb secara preventif saat mendung.';
            $Solusi[] = 'Tinggikan bedengan hingga 40-50cm untuk drainase cepat.';
        }
        if ($cropType == 'Padi' && $request->kondisi_air == 'Kurang') {
            $Risiko[] = 'Stres air pada fase bunting akan menyebabkan bulir hampa (gabug).';
            $Solusi[] = 'Terapkan irigasi Intermittent (basah-kering) untuk menghemat air.';
            $Solusi[] = 'Gunakan varietas toleran kekeringan seperti Inpari 42 atau Cakrabuana.';
        }
        if ($request->kondisi_air == 'Kurang' && $request->pemupukan != 'Organik + NPK Seimbang') {
            $Risiko[] = 'Tanaman mudah "terbakar" (plasmolisis) jika dipupuk kimia saat tanah kering.';
            $Solusi[] = 'Wajib siram tanah hingga kapasitas lapang sebelum pemupukan.';
        }

        // 2. Analisis Tanah & Pupuk
        if ($request->kondisi_tanah == 'Kurang Subur') {
            $Risiko[] = 'Tanah miskin hara menghambat penyerapan pupuk, menyebabkan stunting.';
            $Solusi[] = 'Aplikasi pembenah tanah (Asam Humat) 2 kg/Ha bersama pupuk dasar.';
            $Solusi[] = 'Tambahkan pupuk kandang matang minimal 2-5 ton/Ha.';
        }
        if ($request->pemupukan == 'Tanpa Pupuk' || $request->pemupukan == 'NPK Kurang / Tidak Seimbang') {
            $Risiko[] = 'Defisiensi unsur hara makro akan menurunkan bobot buah/bulir secara signifikan.';
            $Solusi[] = 'Jika budget terbatas, prioritaskan Urea/N saat vegetatif dan KCL saat generatif.';
        }
        if (str_contains(strtolower($request->kondisi_tanah), 'ph ekstrim')) { // assuming desc check logic logic conceptually
             $Risiko[] = 'pH tanah yang tidak netral mengunci unsur hara (pupuk tidak terserap).';
             $Solusi[] = 'Cek pH. Jika < 5.5 berikan Dolomit/Kapur Pertanian 2 minggu sebelum tanam.';
        }

        // 3. Analisis Kepadatan & Hama
        if ($request->kepadatan == 'Terlalu Rapat') {
            $Risiko[] = 'Sirkulasi udara buruk menciptakan mikroklimat lembab yang disukai hama.';
            $Risiko[] = 'Kompetisi antar tanaman tinggi, batang cenderung kurus dan mudah rebah.';
            $Solusi[] = 'Kurangi populasi atau gunakan sistem tanam tumpangsari/jajar legowo.';
        }
        if ($request->hama_penyakit == 'Parah') {
            $Risiko[] = 'Risiko gagal panen total jika tidak ada pengendalian eksplosif.';
            $Solusi[] = 'Segera lakukan pengendalian kimiawi sesuai dosis anjuran sebagai opsi terakhir.';
            $Solusi[] = 'Rotasi tanaman dengan famili berbeda untuk memutus siklus hidup hama.';
        }

        // 4. Analisis Varietas
        if ($request->varietas == 'Tidak Sesuai Agroklimat') {
            $Risiko[] = 'Tanaman rentan stres lingkungan (cuaca/hama lokal).';
            $Solusi[] = 'Uji coba skala kecil dulu atau ganti varietas lokal unggulan.';
        }

        // Default jika list kosong
        if (empty($Risiko) && $SkorAkhir >= 80) {
            $Risiko[] = 'Risiko minim. Waspada perubahan cuaca mendadak.';
            $Solusi[] = 'Pertahankan SOP budidaya yang sudah baik.';
            $Solusi[] = 'Lakukan monitoring rutin hama/penyakit setiap minggu.';
        } elseif (empty($Risiko)) {
            $Risiko[] = 'Produktivitas belum optimal karena akumulasi faktor minor.';
            $Solusi[] = 'Evaluasi ulang kepadatan tanam dan dosis pemupukan.';
        }

        // --- GENERATE JADWAL KEGIATAN ---
        $durasi = $item->duration_days;
        $mingguVegetatif = floor($durasi * 0.4 / 7);
        $mingguGeneratif = floor($durasi * 0.4 / 7);
        // Sisa untuk pematangan

        $Schedule = [];
        $Schedule[] = [
            'minggu' => 'Pra Tanam (H-14)',
            'kegiatan' => 'Pembersihan lahan, pengolahan tanah, dan pemberian pupuk dasar (Organik/Kandang).'
        ];
        
        // Fase Vegetatif
        $Schedule[] = [
            'minggu' => 'Minggu 1 - ' . $mingguVegetatif,
            'kegiatan' => 'Fase Vegetatif: Fokus pemupukan Nitrogen (Urea) untuk pertumbuhan daun/akar. Jaga kelembaban tanah.'
        ];

        // Fase Generatif
        $akhirGeneratif = $mingguVegetatif + $mingguGeneratif;
        $kegiatanGeneratif = 'Fase Generatif: Fokus pemupukan Kalium & Fosfat (KCL/SP36) untuk pembentukan bunga/buah.';
        if($cropType == 'Padi') $kegiatanGeneratif .= ' Waspada wereng dan penggerek batang.';
        if($cropType == 'Hortikultura') $kegiatanGeneratif .= ' Waspada lalat buah dan antraknosa.';
        
        $Schedule[] = [
            'minggu' => 'Minggu ' . ($mingguVegetatif + 1) . ' - ' . $akhirGeneratif,
            'kegiatan' => $kegiatanGeneratif
        ];

        // Fase Pematangan
        $Schedule[] = [
            'minggu' => 'Minggu ' . ($akhirGeneratif + 1) . ' - Panen',
            'kegiatan' => 'Fase Pematangan: Kurangi penyiraman (keringkan lahan untuk padi). Siapkan peralatan panen.'
        ];

        // --- ESTIMASI EKONOMI ---
        $HargaPerKg = $item->price_per_kg;
        $PendapatanKotor = $HasilPanenReal * 1000 * $HargaPerKg; // Ton -> Kg -> Rp

        return response()->json([
            'status' => 'success',
            'data' => [
                'tonase' => number_format($HasilPanenReal, 1),
                'waktu_panen' => $item->duration_days.' Hari',
                'target_panen' => now()->addDays($item->duration_days)->translatedFormat('d F Y'),
                'skor' => number_format($SkorAkhir, 1),
                'status_label' => $LabelKategori,
                'status_color' => $WarnaLabel,
                'status_message' => $PesanKategori,
                'estimasi_nilai' => 'Rp '.number_format($PendapatanKotor, 0, ',', '.'),
                
                // New Expanded Data Fields
                'risks' => $Risiko, // Array of strings
                'daftar_rekomendasi' => $Solusi, // Array of strings
                'schedule' => $Schedule, // Array of objects {minggu, kegiatan}
                'hama_utama' => $item->risks ? implode(', ', array_slice($item->risks, 0, 3)) : 'Hama umum tanaman ini',
            ],
        ]);
    }
}
