<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simulasi;
use Illuminate\Http\Request;

class SimulasiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Simulasi::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lahan', 'like', "%{$search}%")
                    ->orWhere('jenis_tanaman', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $simulasis = $query->latest()->paginate(10);

        return view('dashboard.simulasi.index', compact('simulasis'));
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
        $validated = $request->validate([
            'nama_lahan' => 'required|string|max:255',
            'jenis_tanaman' => 'required|string|max:255',
            'luas_lahan' => 'required|string|max:255',
            'estimasi_panen' => 'required|string|max:255',
            'status' => 'required|string|in:Produktif,Kurang Produktif,Kritis', // Example statuses
        ]);

        Simulasi::create($validated);

        return redirect()->route('admin.simulasi.index')->with('success', 'Data simulasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // return view('dashboard.simulasi.edit', compact('simulasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $simulasi = Simulasi::findOrFail($id);
        $simulasi->delete();

        return redirect()->route('admin.simulasi.index')->with('success', 'Data simulasi berhasil dihapus.');
    }
}
