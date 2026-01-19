<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Publikasi;
use App\Models\Pupuk;
use Illuminate\Http\Request;

class PublikasiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publikasis = Publikasi::with(['desa.kecamatan', 'pupuk'])->latest()->get();

        return view('dashboard.data_pupuk.publikasi.index', compact('publikasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desas = Desa::all();
        $pupuks = Pupuk::all();
        $kecamatans = Kecamatan::all();

        return view('dashboard.data_pupuk.publikasi.create', compact('desas', 'pupuks', 'kecamatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'desa_id' => 'required|exists:desas,id',
            'pupuk_id' => 'required|exists:pupuks,id',
            'jumlah_sak' => 'required|integer|min:1',
            'is_publish' => 'boolean',
        ]);

        Publikasi::create($validated);

        return redirect('/dashboard/data_pupuk/publikasi')->with('success', 'Data publikasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publikasi $publikasi)
    {
        $desas = Desa::all();
        $pupuks = Pupuk::all();

        return view('dashboard.data_pupuk.publikasi.edit', compact('publikasi', 'desas', 'pupuks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publikasi $publikasi)
    {
        $validated = $request->validate([
            'desa_id' => 'required|exists:desas,id',
            'pupuk_id' => 'required|exists:pupuks,id',
            'jumlah_sak' => 'required|integer|min:1',
            'is_publish' => 'boolean',
        ]);

        $publikasi->update($validated);

        return redirect('/dashboard/data_pupuk/publikasi')->with('success', 'Data publikasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publikasi $publikasi)
    {
        $publikasi->delete();

        return redirect()->back()->with('success', 'Data publikasi berhasil dihapus.');
    }
}
