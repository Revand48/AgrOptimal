<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class WilayahAdminController extends Controller
{
    /* ===================== INDEX ===================== */
    public function index()
    {
        return view('dashboard.data_pupuk.wilayah.index', [
            'kecamatans' => Kecamatan::with('desas')->orderBy('nama')->get(),
            'desas' => Desa::with('kecamatan')->orderBy('nama')->get(),
        ]);
    }

    /* ===================== CREATE ===================== */
    public function createKecamatan()
    {
        return view('dashboard.data_pupuk.wilayah.create_kecamatan');
    }

    public function createDesa()
    {
        return view('dashboard.data_pupuk.wilayah.create_desa', [
            'kecamatans' => Kecamatan::orderBy('nama')->get()
        ]);
    }

    /* ===================== STORE ===================== */
    public function storeKecamatan(Request $request)
    {
        $request->validate(['nama' => 'required|unique:kecamatans,nama']);
        Kecamatan::create($request->only('nama'));
        return redirect()->route('admin.wilayah.index')->with('success', 'Kecamatan ditambahkan');
    }

    public function storeDesa(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kecamatan_id' => 'required|exists:kecamatans,id'
        ]);

        Desa::create($request->only('nama', 'kecamatan_id'));
        return redirect()->route('admin.wilayah.index')->with('success', 'Desa ditambahkan');
    }

    /* ===================== EDIT ===================== */
    public function editKecamatan(Kecamatan $kecamatan)
    {
        return view('dashboard.data_pupuk.wilayah.edit_kecamatan', compact('kecamatan'));
    }

    public function editDesa(Desa $desa)
    {
        return view('dashboard.data_pupuk.wilayah.edit_desa', [
            'desa' => $desa,
            'kecamatans' => Kecamatan::orderBy('nama')->get()
        ]);
    }

    /* ===================== UPDATE ===================== */
    public function updateKecamatan(Request $request, Kecamatan $kecamatan)
    {
        $request->validate(['nama' => 'required|unique:kecamatans,nama,' . $kecamatan->id]);
        $kecamatan->update($request->only('nama'));
        return redirect()->route('admin.wilayah.index')->with('success', 'Kecamatan diperbarui');
    }

    public function updateDesa(Request $request, Desa $desa)
    {
        $request->validate([
            'nama' => 'required',
            'kecamatan_id' => 'required|exists:kecamatans,id'
        ]);

        $desa->update($request->only('nama', 'kecamatan_id'));
        return redirect()->route('admin.wilayah.index')->with('success', 'Desa diperbarui');
    }

    /* ===================== DELETE ===================== */
    public function destroyKecamatan(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        return back()->with('success', 'Kecamatan dihapus');
    }

    public function destroyDesa(Desa $desa)
    {
        $desa->delete();
        return back()->with('success', 'Desa dihapus');
    }
}
