<?php

namespace App\Http\Controllers\Admin;

use App\Models\CekTanah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CekTanahAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cekTanahs = CekTanah::orderBy('step_number')->get();
        return view('dashboard.edukasi_budidaya.cek_tanah.index', compact('cekTanahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.edukasi_budidaya.cek_tanah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content_padi' => 'nullable|string',
            'content_jagung' => 'nullable|string',
            'content_kedelai' => 'nullable|string',
            'content_singkong' => 'nullable|string',
            'content_ubi' => 'nullable|string',
            // 'content' => 'required', // Removed generic content validation, using specific ones now or description
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'step_number' => 'required|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cek_tanah', 'public');
        }

        CekTanah::create($data);

        return redirect()->route('admin.edukasi.cek_tanah.index')->with('success', 'Langkah Cek Tanah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CekTanah $cekTanah)
    {
        return view('dashboard.edukasi_budidaya.cek_tanah.show', compact('cekTanah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cekTanah = CekTanah::findOrFail($id);
        return view('dashboard.edukasi_budidaya.cek_tanah.edit', compact('cekTanah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cekTanah = CekTanah::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content_padi' => 'nullable|string',
            'content_jagung' => 'nullable|string',
            'content_kedelai' => 'nullable|string',
            'content_singkong' => 'nullable|string',
            'content_ubi' => 'nullable|string',
            // 'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'step_number' => 'required|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($cekTanah->image) {
                Storage::disk('public')->delete($cekTanah->image);
            }
            $data['image'] = $request->file('image')->store('cek_tanah', 'public');
        }

        $cekTanah->update($data);

        return redirect()->route('admin.edukasi.cek_tanah.index')->with('success', 'Langkah Cek Tanah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cekTanah = CekTanah::findOrFail($id);
        if ($cekTanah->image) {
            Storage::disk('public')->delete($cekTanah->image);
        }
        $cekTanah->delete();

        return redirect()->route('admin.edukasi.cek_tanah.index')->with('success', 'Langkah Cek Tanah berhasil dihapus.');
    }
}

