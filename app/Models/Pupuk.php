<?php

// app/Models/Pupuk.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pupuk extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'kg_per_sak',
        'jumlah_sak',
        'is_active'
    ];

    // otomatis hitung kg (tanpa simpan ke DB)
    public function getTotalKgAttribute()
    {
        return $this->jumlah_sak * $this->kg_per_sak;
    }
}

