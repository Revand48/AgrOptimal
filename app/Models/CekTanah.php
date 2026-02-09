<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CekTanah extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content', // Keep for backward compatibility if needed, or remove if fully replaced. Plan says add new ones.
        'content_padi',
        'content_jagung',
        'content_kedelai',
        'content_singkong',
        'content_ubi',
        'image',
        'step_number',
    ];
}
