<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    protected $fillable = [
        'desa_id',
        'pupuk_id',
        'jumlah_sak',
        'is_publish',
    ];

    // Relasi ke Desa
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    // Relasi ke Pupuk
    public function pupuk()
    {
        return $this->belongsTo(Pupuk::class);
    }
}
