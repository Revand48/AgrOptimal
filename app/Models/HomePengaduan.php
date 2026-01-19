<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePengaduan extends Model
{
    protected $fillable = [
        'kategori',
        'nama',
        'no_whatsapp',
        'pesan',
        'lampiran',
        'status',
    ];
}
