<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFaq extends Model
{
    protected $table = 'home_faqs';

    protected $fillable = [
        'question',
        'answer',
        'is_active',
        'is_verified',
        'sort_order',
    ];
}
