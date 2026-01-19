<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeData extends Model
{
    protected $fillable = [
        'total_pupuk',
        'jenis_pupuk',
        'petani_terdampak',
        'rating',
        'is_active'
    ];
}
