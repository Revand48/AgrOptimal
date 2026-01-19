<?php

namespace App\Http\Controllers;

use App\Models\Pupuk;
use App\Models\Simulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SimulasiController extends Controller
{
    public function index()
    {
        $simulasis = Simulasi::latest()->take(5)->get(); // Show recent history
        $pupuks = Pupuk::where('is_active', true)->pluck('nama', 'id'); // For dropdown
        
        // Fetch from DB
        // Format needed: 'Padi' => ['harvest_days' => 110, 'yield_per_ha' => 6]
        $komoditas = \App\Models\Komoditas::where('is_active', true)->get();
        $tanamanList = $komoditas->mapWithKeys(function ($item) {
             return [$item->nama => [
                 'harvest_days' => $item->duration_days, 
                 'yield_per_ha' => $item->yield_per_ha
             ]];
        })->toArray();

        return view('users.simulasi', compact('simulasis', 'pupuks', 'tanamanList'));
    }

    /**
     * KALKULASI LOKAL (EXPERT SYSTEM)
     * Memberikan analisis instan berdasarkan aturan agronomi dasar tanpa menunggu AI.
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'luas_lahan' => 'required|numeric|min:0.01',
            'jenis_tanaman' => 'required|string',
            'musim_tanam' => 'required|string',
            'jenis_pupuk' => 'required|string',
        ]);

        $item = \App\Models\Komoditas::where('nama', $request->jenis_tanaman)->first();
        
        if (!$item) {
            return response()->json(['status' => 'error', 'message' => 'Tanaman tidak ditemukan.'], 404);
        }

        $t = $request->jenis_tanaman;
        $m = $request->musim_tanam;
        $l = $request->luas_lahan;

        // 1. Hitung Estimasi Dasar
        $base_yield = $item->yield_per_ha;
        $harvest_days = $item->duration_days;
        $total_yield = $base_yield * $l;

        // 2. Logika Risiko (Rule-Based Risk Assessment)
        $score = 100; // Mulai dari sempurna
        $risks = $item->risks ?? [];
        $alerts = [];
        $recommendation = "Optimal";

        // Logic Musim (Tetap Hardcoded karena logic agronomis spesifik)
        // Bisa dikembangkan lagi nanti
         if ($m == 'Musim Hujan') {
            if (in_array($t, ['Kedelai', 'Ubi Jalar', 'Bawang Merah', 'Cabai Merah'])) {
                $score -= 20; 
                $risks[] = "Risiko Tanah Terlalu Lembab (Busuk Umbi/Akar)";
                $alerts[] = ['type' => 'warning', 'msg' => "WASPADA: $t butuh drainase yang sangat baik di musim hujan agar tidak busuk."];
            } elseif ($t == 'Padi') {
                $score -= 5; 
                $risks[] = "Potensi Rebah jika angin kencang";
            }
        } else { // Kemarau
            if ($t == 'Padi') {
                $score -= 20;
                $risks[] = "Risiko Kekeringan & Pengairan Boros";
                $alerts[] = ['type' => 'warning', 'msg' => "Pastikan irigasi teknis tersedia. Padi butuh banyak air di fase vegetatif."];
            } elseif ($t == 'Singkong') {
                 $score -= 10;
                 $risks[] = "Pertumbuhan awal lambat jika kekurangan air";
            }
        }

        // Rule LUAS LAHAN (Economy of Scale)
        if ($l < 0.2) {
            $risks[] = "Biaya operasional per meter mungkin tinggi (Skala Kecil)";
        }

        // Tentukan Status SKOR
        if ($score >= 80) {
            $status_label = "Sangat Potensial";
            $status_color = "green";
        } elseif ($score >= 50) {
            $status_label = "Cukup Berisiko";
            $status_color = "yellow";
            $recommendation = "Perlu Perlakuan Khusus & Fungisida Ekstra";
        } else {
            $status_label = "Bahaya / Tidak Disarankan";
            $status_color = "red";
            $recommendation = "Pertimbangkan Ganti Komoditas atau Varietas Tahan Hujan";
        }

        // Estimasi Harga
        $est_price = $item->price_per_kg;
        $gross_profit = $total_yield * 1000 * $est_price; // Ton -> Kg -> Rupiah

        return response()->json([
            'status' => 'success',
            'data' => [
                'tonase' => number_format($total_yield, 1),
                'waktu_panen' => $harvest_days.' Hari',
                'target_panen' => now()->addDays($harvest_days)->translatedFormat('d F Y'),
                'skor' => $score,
                'status_label' => $status_label,
                'status_color' => $status_color,
                'risks' => $risks, // Array string
                'alerts' => $alerts, // Array object {type, msg}
                'estimasi_nilai' => 'Rp '.number_format($gross_profit, 0, ',', '.'),
                'rekomendasi_singkat' => $recommendation,
                'hama_utama' => is_array($risks) ? implode(', ', array_slice($risks, 0, 3)) : $risks // Ambil 3 risiko utama,
            ],
        ]);
    }

    public function analyze(Request $request)
    {
        $request->validate([
            'luas_lahan' => 'required|numeric',
            'jenis_tanaman' => 'required|string',
            'musim_tanam' => 'required|string',
            'jenis_pupuk' => 'required|string',
        ]);

        $apiKey = env('GEMINI_API_KEY');

        // Mock Response if no API Key (Safety Fallback)
        if (! $apiKey) {
            return response()->json([
                'status' => 'success',
                'mock' => true,
                'data' => [
                    'analysis' => 'Simulasi berhasil (Mode Offline). Dengan luas lahan '.$request->luas_lahan.' Ha untuk tanaman '.$request->jenis_tanaman.', estimasi panen adalah sekitar '.($request->luas_lahan * 6).' Ton. Pastikan pengairan cukup.',
                    'schedule' => [
                        ['minggu' => 'Minggu 1', 'kegiatan' => 'Persiapan lahan dan pemupukan dasar menggunakan '.$request->jenis_pupuk.'.'],
                        ['minggu' => 'Minggu 2', 'kegiatan' => 'Penanaman bibit dan penyiraman rutin.'],
                        ['minggu' => 'Minggu 4', 'kegiatan' => 'Pemupukan susulan pertama dan penyiangan gulma.'],
                        ['minggu' => 'Minggu 8', 'kegiatan' => 'Pengecekan hama dan penyakit.'],
                        ['minggu' => 'Minggu 12', 'kegiatan' => 'Persiapan panen.'],
                    ],
                ],
            ]);
        }

        $prompt = "Anda adalah Profesor Agronomi dengan spesialisasi Pertanian Presisi & Mitigasi Risiko di Indonesia.
        Tugas: Berikan 'SECOND OPINION' mendalam untuk rencana ini (User sudah mendapat hitungan dasar, butuh analisis kritis):

        DATA INPUT:
        - Lahan: {$request->luas_lahan} Ha
        - Tanaman: {$request->jenis_tanaman}
        - Musim: {$request->musim_tanam}
        - Pupuk Utama: {$request->jenis_pupuk}

        INSTRUKSI OUTPUT (JSON Valid):
        1. 'analysis': Evaluasi KRITIS & JUJUR (min 3 paragraf). Jangan hanya memuji. Jika musim/tanaman salah, KATAKAN SALAH dan jelaskan kenapa (cth: fisiologi tanaman vs kelembapan).
        2. 'risks': Identifikasi 3 'Silent Killer' (risiko tersembunyi) yang sering diremehkan petani untuk komoditas ini di musim ini.
        3. 'solutions': Protokol penanganan spesifik (SOP). Sebutkan bahan aktif pestisida/fungisida jika perlu (contoh: propineb, mankozeb) atau teknik teknis (bedengan tinggi, drainase).
        4. 'schedule': Jadwal aksi sangat detail per fase (Vegetatif awal, Vegetatif akhir, Generatif, Pengisian).

        Format JSON:
        {
            \"analysis\": \"...\",
            \"risks\": \"...\",
            \"solutions\": \"...\",
            \"schedule\": [ {\"minggu\": \"...\", \"kegiatan\": \"...\"} ]
        }";

        try {
            // Menggunakan Endpoint V1beta untuk gemini-1.5-flash
            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    ['parts' => [['text' => $prompt]]],
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $rawText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
                $cleanJson = str_replace(['```json', '```'], '', $rawText);
                $result = json_decode($cleanJson, true);

                if (! $result) {
                    throw new \Exception('Format respons AI tidak valid JSON.');
                }
            } else {
                // FALLBACK JIKA ERROR / KUOTA HABIS (Agar user tetap bisa demo)
                // Deteksi jika error 429 (Rate Limit) atau 404 (Model Not Found)
                $isQuotaError = $response->status() == 429;
                $isModelError = $response->status() == 404;

                // Gunakan mock data cerdas berdasarkan input
                $errorMsg = $response->body();
                $result = [
                    'analysis' => ($isQuotaError ? '[Mode Offline - Kuota Habis] ' : '[Mode Offline - Gagal Menghubungi AI (Status: '.$response->status().')] ').
                                  "Berdasarkan data lahan seluas {$request->luas_lahan} Ha dengan tanaman {$request->jenis_tanaman}, estimasi potensi panen optimal adalah sekitar ".($request->luas_lahan * ($request->jenis_tanaman == 'Padi' ? 6 : 4)).' - '.($request->luas_lahan * 8).' Ton. Disarankan menjaga kelembapan tanah di fase awal. \n\n(Debug Info: '.substr($errorMsg, 0, 100).'...)',
                    'schedule' => [
                        ['minggu' => 'Minggu 1', 'kegiatan' => 'Persiapan lahan, pengolahan tanah, dan pemupukan dasar dengan '.$request->jenis_pupuk.'.'],
                        ['minggu' => 'Minggu 2-3', 'kegiatan' => 'Penanaman bibit dan pemantuan hama awal.'],
                        ['minggu' => 'Minggu 4-6', 'kegiatan' => 'Pemupukan susulan pertama dan pembersihan gulma.'],
                        ['minggu' => 'Minggu 8-10', 'kegiatan' => 'Pemupukan susulan kedua (jika perlu) dan kontrol irigasi.'],
                        ['minggu' => 'Panen', 'kegiatan' => 'Pemanenan saat bulir/buah sudah matang fisiologis.'],
                    ],
                ];

                // Jika ingin memberitahu user ini adalah data fallback, kita bisa kirim status success tapi data mock
                // Atau biarkan terlihat seperti sukses agar user senang (sesuai request "jadikan seperti simulasi asli")
            }

            return response()->json([
                'status' => 'success',
                'data' => $result,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem: '.$e->getMessage(),
            ], 500);
        }
    }
}
