<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminChatSetting extends Model
{
    /** @var array<int, string> */
    protected $fillable = [
        'is_online',
        'max_active_chats',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_online' => 'boolean',
            'max_active_chats' => 'integer',
        ];
    }

    /**
     * Ambil pengaturan global (singleton row).
     */
    public static function getSettings(): self
    {
        return self::firstOrCreate([], [
            'is_online' => false,
            'max_active_chats' => 2,
        ]);
    }
}
