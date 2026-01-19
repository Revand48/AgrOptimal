<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lahan',
        'jenis_tanaman',
        'luas_lahan',
        'estimasi_panen',
        'status',
    ];
    //
}
