<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;

class PupukController extends Controller
{
    public function index()
    {
        // 1. Ambil data Kecamatan beserta Desanya untuk dropdown filter
        $kecamatan = \App\Models\Kecamatan::with(['desas' => function ($query) {
            $query->where('is_active', true);
        }])->where('is_active', true)->get();

        // 2. Ambil data Publikasi yang sudah dipublish
        $publikasis = \App\Models\Publikasi::with(['desa.kecamatan', 'pupuk'])
            ->where('is_publish', true)
            ->get();

        // 3. Format data agar sesuai DENGAN PERSIS struktur 'data' di AlpineJS
        $formattedData = $publikasis->map(function ($item) {
            // LOGIC STATUS KHUSUS
            // Logic ini bisa disesuaikan dengan aturan bisnis user.
            $status = 'Aman';
            if ($item->jumlah_sak <= 10) {
                $status = 'Kritis';
            } elseif ($item->jumlah_sak <= 30) {
                $status = 'Menipis';
            }

            return [
                'jenis' => $item->pupuk->nama,
                'kategori' => $item->pupuk->kategori,
                'sak' => $item->jumlah_sak,
                'kg_per_sak' => $item->pupuk->kg_per_sak,
                'lokasi' => 'Gudang ' . $item->desa->nama,
                'status' => $status,
                // Extra fields untuk filtering
                'kecamatan' => $item->desa->kecamatan->nama,
                'desa' => $item->desa->nama,
            ];
        });

        // 4. Jenis Pupuk unik untuk filter dropdown
        $jenisPupuk = \App\Models\Pupuk::select('nama')->distinct()->pluck('nama');

        return view('users.datapupuk', [
            'listKecamatan' => $kecamatan,
            'dataPupuk' => $formattedData,
            'listJenisPupuk' => $jenisPupuk,
        ]);
    }
}
