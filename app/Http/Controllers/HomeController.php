<?php

namespace App\Http\Controllers;

use App\Models\HomeFaq;
use App\Models\HomeData;
use App\Models\HomePengaduan;
use App\Mail\PengaduanMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ======================
        // FAQ HOME
        // ======================
        $homeFaqs = HomeFaq::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn($faq) => [
                'id' => $faq->id,
                'q' => $faq->question,
                'a' => $faq->answer,
                'verified' => $faq->is_verified,
            ]);

        // ======================
        // STATISTIK HOME
        // ======================
        $homeData = HomeData::where('is_active', true)->first();

        return view('users.beranda', compact('homeFaqs', 'homeData'));
    }

    /**
     * ======================
     * SIMPAN PENGADUAN USER
     * ======================
     */
    public function kirimPengaduan(Request $request)
    {
        $validated = $request->validate([
            'kategori'     => 'required|string',
            'nama'         => 'required|string|max:100',
            'no_whatsapp'  => 'required|string|max:20',
            'pesan'        => 'required|string',
            'lampiran'     => 'nullable|image|max:2048',
        ]);

        try {
            // Upload lampiran (jika ada)
            if ($request->hasFile('lampiran')) {
                $validated['lampiran'] = $request->file('lampiran')
                    ->store('pengaduan', 'public');
            }

            // Simpan ke database
            $pengaduan = new HomePengaduan();
            $pengaduan->kategori = $validated['kategori'];
            $pengaduan->nama = $validated['nama'];
            $pengaduan->no_whatsapp = $validated['no_whatsapp'];
            $pengaduan->pesan = $validated['pesan'];
            $pengaduan->lampiran = $validated['lampiran'] ?? null;
            $pengaduan->save();

            // Variabel untuk pesan sukses
            $message = 'Pengaduan berhasil dikirim. Tim AgrOptimal akan segera menghubungi Anda.';
            $emailStatus = 'success';

            try {
                // DEBUG: Cek konfigurasi sebelum kirim
                Log::info('Mencoba kirim email pengaduan ID: ' . $pengaduan->id);

                // Kirim email ke admin
                Mail::to(config('mail.from.address'))->send(new PengaduanMail($pengaduan));
                
            } catch (\Exception $e) {
                // Jika email gagal, log errornya tapi jangan batalkan penyimpanan database
                Log::error('Gagal mengirim email pengaduan (ID: ' . $pengaduan->id . '): ' . $e->getMessage());
                
                // Ubah pesan sukses untuk memberi tahu user
                $message = 'Pengaduan berhasil disimpan, namun notifikasi email sistem sedang terkendala. Tim kami akan mengecek database secara berkala.';
                // Kita tetap return success karena data sudah masuk database
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            // Ini only catch error saat upload file atau save database
            Log::error('Error fatal simpan pengaduan: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim laporan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeFaq $homeFaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeFaq $homeFaq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeFaq $homeFaq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeFaq $homeFaq)
    {
        //
    }
}
