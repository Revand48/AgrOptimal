<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function tipsBibit()
    {
        $tips = \App\Models\TipsBibit::orderBy('step_number', 'asc')->get();
        return view('users.edukasi_budidaya.tipsbibit', compact('tips'));
    }

    public function tipsLahan()
    {
        $tips = \App\Models\TipsLahan::orderBy('step_number', 'asc')->get();
        return view('users.edukasi_budidaya.tipslahan', compact('tips'));
    }

    public function tipsPemupukan()
    {
        $tips = \App\Models\TipsPemupukan::orderBy('step_number', 'asc')->get();
        return view('users.edukasi_budidaya.tipspemupukan', compact('tips'));
    }


    public function tipsIrigasi()
    {
        $tips = \App\Models\TipsIrigasi::orderBy('step_number', 'asc')->get();
        return view('users.edukasi_budidaya.irigasi', compact('tips'));
    }

    public function tipsCekTanah()
    {
        $steps = \App\Models\CekTanah::orderBy('step_number', 'asc')->get();
        return view('users.edukasi_budidaya.pengecekantanah', compact('steps'));
    }
}
