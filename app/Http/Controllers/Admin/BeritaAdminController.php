<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->search) {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $beritas = $query->latest()->paginate(10)->withQueryString();

        $kategoriList = ['Teknologi', 'Pupuk', 'Hama', 'Pasar'];

        return view('dashboard.berita.index', compact('beritas', 'kategoriList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $konten = $request->konten;

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kategori' => $request->kategori,
            'foto' => $request->file('foto')->store('berita', 'public'),
            'konten' => $konten,
            'ringkasan' => Str::limit(strip_tags($konten), 150),
            'status' => $request->status,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $berita = Berita::findOrFail($id);

        return view('dashboard.berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $berita = Berita::findOrFail($id);

        return view('dashboard.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);
        $konten = $request->konten;

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kategori' => $request->kategori,
            'konten' => $konten,
            'ringkasan' => Str::limit(strip_tags($konten), 150),
            'status' => $request->status,
        ];

        if ($request->hasFile('foto')) {
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = $request->file('foto')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
