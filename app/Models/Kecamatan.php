<?php

// app/Models/Kecamatan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = ['nama', 'is_active'];

    // 1 kecamatan punya banyak desa
    public function desas()
    {
        return $this->hasMany(Desa::class);
    }
}

?>