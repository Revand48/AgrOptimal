<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePengaduan;
use App\Models\Komoditas;
use App\Models\Pupuk;
use App\Models\Simulasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // 1. Counts
        $countPengaduan = HomePengaduan::count();
        $countKomoditas = Komoditas::where('is_active', true)->count();
        $countPupuk = Pupuk::where('is_active', true)->count();
        $countSimulasi = Simulasi::count();
        $countUser = User::count();

        // 2. Last Update Calculation
        $lastUpdates = [
            HomePengaduan::latest('updated_at')->value('updated_at'),
            Komoditas::latest('updated_at')->value('updated_at'),
            Pupuk::latest('updated_at')->value('updated_at'),
            Simulasi::latest('updated_at')->value('updated_at'),
        ];
        
        // Remove nulls and get the max date
        $lastUpdate = collect($lastUpdates)->filter()->max();
        $lastUpdateString = $lastUpdate ? Carbon::parse($lastUpdate)->translatedFormat('d F Y, H:i') : '-';

        // 3. Chart Data

        // Chart 1: Pengaduan by Kategori
        $pengaduanKategori = HomePengaduan::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->get();

        // Chart 2: Pengaduan by Status
        $pengaduanStatus = HomePengaduan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Chart 3: Komoditas Prices (Top 10)
        $komoditasPrices = Komoditas::where('is_active', true)
            ->select('nama', 'price_per_kg')
            ->orderBy('price_per_kg', 'desc')
            ->limit(10)
            ->get();

        // Chart 4: Pupuk Stock Distribution
        // Calculate total kg (jumlah_sak * kg_per_sak) per pupuk type
        $pupukStocks = Pupuk::where('is_active', true)
            ->get()
            ->map(function ($pupuk) {
                return [
                    'nama' => $pupuk->nama,
                    'total_kg' => $pupuk->jumlah_sak * $pupuk->kg_per_sak
                ];
            });

        return view('dashboard.dashboard', compact(
            'countPengaduan',
            'countKomoditas',
            'countPupuk',
            'countSimulasi',
            'countUser',
            'lastUpdateString',
            'pengaduanKategori',
            'pengaduanStatus',
            'komoditasPrices',
            'pupukStocks'
        ));
    }
}
