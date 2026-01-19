<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'duration_days',
        'yield_per_ha',
        'price_per_kg',
        'description',
        'risks',
        'is_active',
    ];

    protected $casts = [
        'risks' => 'array',
        'is_active' => 'boolean',
        'duration_days' => 'integer',
        'yield_per_ha' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
    ];
}
