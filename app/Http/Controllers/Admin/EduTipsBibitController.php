<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipsBibit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EduTipsBibitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tips = \App\Models\TipsBibit::orderBy('step_number')->paginate(10);
        return view('dashboard.edukasi_budidaya.tips_bibit.index', compact('tips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.edukasi_budidaya.tips_bibit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'content_padi' => 'nullable|string',
            'content_jagung' => 'nullable|string',
            'content_kedelai' => 'nullable|string',
            'content_singkong' => 'nullable|string',
            'content_ubi' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('tips-bibit', 'public');
        }

        \App\Models\TipsBibit::create($validated);

        return redirect()->route('admin.edukasi.tips_bibit.index')->with('success', 'Tips Bibit berhasil ditambahkan');
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
        $tip = \App\Models\TipsBibit::findOrFail($id);
        return view('dashboard.edukasi_budidaya.tips_bibit.edit', compact('tip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tip = \App\Models\TipsBibit::findOrFail($id);

        $validated = $request->validate([
            'step_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'content_padi' => 'nullable|string',
            'content_jagung' => 'nullable|string',
            'content_kedelai' => 'nullable|string',
            'content_singkong' => 'nullable|string',
            'content_ubi' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($tip->image) {
                Storage::disk('public')->delete($tip->image);
            }
            $validated['image'] = $request->file('image')->store('tips-bibit', 'public');
        }

        $tip->update($validated);

        return redirect()->route('admin.edukasi.tips_bibit.index')->with('success', 'Tips Bibit berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tip = \App\Models\TipsBibit::findOrFail($id);
        if ($tip->image) {
            Storage::disk('public')->delete($tip->image);
        }
        $tip->delete();

        return redirect()->route('admin.edukasi.tips_bibit.index')->with('success', 'Tips Bibit berhasil dihapus');
    }
}
