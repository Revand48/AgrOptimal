<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pupuk;
use Illuminate\Http\Request;

class PupukAdminController extends Controller
{
    public function index()
    {
        return view('dashboard.data_pupuk.pupuk.index', [
            'pupuks' => Pupuk::orderBy('nama')->get(),
        ]);
    }

    public function create()
    {
        return view('dashboard.data_pupuk.pupuk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:pupuks,nama',
            'kategori' => 'required',
            'kg_per_sak' => 'required|numeric|min:1',
            'jumlah_sak' => 'required|numeric|min:0',
        ]);

        Pupuk::create($request->only('nama', 'kategori', 'kg_per_sak', 'jumlah_sak'));

        return redirect()->route('admin.pupuk.index')
            ->with('success', 'Pupuk berhasil ditambahkan');
    }

    public function edit(Pupuk $pupuk)
    {
        return view('dashboard.data_pupuk.pupuk.edit', compact('pupuk'));
    }

    public function update(Request $request, Pupuk $pupuk)
    {
        $request->validate([
            'nama' => 'required|unique:pupuks,nama,'.$pupuk->id,
            'kategori' => 'required',
            'kg_per_sak' => 'required|numeric|min:1',
            'jumlah_sak' => 'required|numeric|min:0',
        ]);

        $pupuk->update($request->only('nama', 'kategori', 'kg_per_sak', 'jumlah_sak'));

        return redirect()->route('admin.pupuk.index')
            ->with('success', 'Pupuk berhasil diperbarui');
    }

    public function destroy(Pupuk $pupuk)
    {
        $pupuk->delete();

        return back()->with('success', 'Pupuk berhasil dihapus');
    }
}
