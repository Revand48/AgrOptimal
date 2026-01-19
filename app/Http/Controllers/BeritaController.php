<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->kategori && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        // Filter status published/aktif jika ada kolom status
        $query->where('status', 'publish');

        $daftarBerita = $query->latest()->paginate(6)->withQueryString();

        return view('users.berita', compact('daftarBerita'));
    }

    public function show(Berita $berita)
    {
        return view('users.berita_show', compact('berita'));
    }
}
