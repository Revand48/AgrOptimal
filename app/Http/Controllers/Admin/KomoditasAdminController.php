<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KomoditasAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komoditas = \App\Models\Komoditas::latest()->paginate(10);
        return view('dashboard.komoditas.index', compact('komoditas'));
    }

    public function create()
    {
        return view('dashboard.komoditas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'yield_per_ha' => 'required|numeric|min:0',
            'price_per_kg' => 'required|numeric|min:0',
            'description' => 'required|string',
            'risks' => 'nullable|string', // Comma separated
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['nama']);
        
        // Convert comma separated risks to array
        if ($request->has('risks')) {
            $risksArray = array_map('trim', explode(',', $request->risks));
            $validated['risks'] = $risksArray;
        }

        \App\Models\Komoditas::create($validated);

        return redirect()->route('admin.komoditas.index')
            ->with('success', 'Komoditas berhasil ditambahkan');
    }

    public function edit(\App\Models\Komoditas $komoditas) // Route model binding
    {
        return view('dashboard.komoditas.edit', compact('komoditas'));
    }

    public function update(Request $request, \App\Models\Komoditas $komoditas)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'yield_per_ha' => 'required|numeric|min:0',
            'price_per_kg' => 'required|numeric|min:0',
            'description' => 'required|string',
            'risks' => 'nullable|string',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['nama']);

        if ($request->has('risks')) {
             $risksArray = array_map('trim', explode(',', $request->risks));
             $validated['risks'] = $risksArray;
        }

        $komoditas->update($validated);

        return redirect()->route('admin.komoditas.index')
            ->with('success', 'Komoditas berhasil diperbarui');
    }

    public function destroy(\App\Models\Komoditas $komoditas)
    {
        $komoditas->delete();
        return redirect()->route('admin.komoditas.index')
            ->with('success', 'Komoditas berhasil dihapus');
    }
}
