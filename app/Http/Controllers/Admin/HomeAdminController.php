<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeData;
use App\Models\HomeFaq;
use App\Models\HomePengaduan;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | DASHBOARD HOME STATISTIK
    |----------------------------------------------------------------------
    */
    public function index()
    {
        $homeData = HomeData::where('is_active', true)->first();
        return view('dashboard.home.statistik.index', compact('homeData'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'total_pupuk' => 'required|numeric',
            'jenis_pupuk' => 'required|numeric',
            'petani_terdampak' => 'required|numeric',
            'rating' => 'required|numeric',
        ]);

        $homeData = HomeData::where('is_active', true)->first();

        if ($homeData) {
            $homeData->update($request->all());
        } else {
            $homeData = HomeData::create(array_merge(
                $request->all(),
                ['is_active' => true]
            ));
        }

        $homeData->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Statistik berhasil diperbarui!',
            'data' => [
                'total_pupuk' => $homeData->total_pupuk,
                'jenis_pupuk' => $homeData->jenis_pupuk,
                'petani_terdampak' => $homeData->petani_terdampak,
                'rating' => $homeData->rating,
                'updated_at' => $homeData->updated_at->translatedFormat('d F Y, H:i'),
            ],
        ]);
    }

    /*
    |----------------------------------------------------------------------
    | DASHBOARD HOME FAQ
    |----------------------------------------------------------------------
    */
    public function faqIndex()
    {
        $faqs = HomeFaq::orderBy('sort_order')->get();
        return view('dashboard.home.faq.index', compact('faqs'));
    }

    public function faqCreate()
    {
        return view('dashboard.home.faq.create');
    }

    public function faqStore(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'required|integer',
        ]);

        HomeFaq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order,
            'is_active' => $request->boolean('is_active'),
            'is_verified' => $request->boolean('is_verified'),
        ]);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil ditambahkan');
    }

    public function faqEdit(HomeFaq $faq)
    {
        return view('dashboard.home.faq.edit', compact('faq'));
    }

    public function faqUpdate(Request $request, HomeFaq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'required|integer',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order,
            'is_active' => $request->boolean('is_active'),
            'is_verified' => $request->boolean('is_verified'),
        ]);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil diperbarui');
    }

    public function faqDestroy(HomeFaq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ berhasil dihapus');
    }

    /*
    |----------------------------------------------------------------------
    | REALTIME TOGGLE (FETCH / ALPINE)
    |----------------------------------------------------------------------
    */
    public function faqToggleAktif(HomeFaq $faq)
    {
        $faq->update([
            'is_active' => !$faq->is_active
        ]);

        return response()->json(['success' => true]);
    }

    public function faqToggleVerifikasi(HomeFaq $faq)
    {
        $faq->update([
            'is_verified' => !$faq->is_verified
        ]);

        return response()->json(['success' => true]);
    }

    /*
    |----------------------------------------------------------------------
    | DASHBOARD PENGADUAN ADMIN
    |----------------------------------------------------------------------
    */
    public function pengaduanIndex(Request $request)
    {
        $query = HomePengaduan::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduan = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('dashboard.home.pengaduan.index', compact('pengaduan'));
    }

    public function pengaduanShow(HomePengaduan $pengaduan)
    {
        // otomatis tandai dibaca
        if ($pengaduan->status === 'baru') {
            $pengaduan->update([
                'status' => 'dibaca'
            ]);
        }

        return view('dashboard.home.pengaduan.show', compact('pengaduan'));
    }

    public function pengaduanDestroy(HomePengaduan $pengaduan): \Illuminate\Http\RedirectResponse
    {
        $pengaduan->delete();
        return back()->with('success', 'Pengaduan berhasil dihapus');
    }
}
