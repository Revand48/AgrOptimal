<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    /** @var array<int, string> */
    protected $fillable = [
        'live_chat_id',
        'sender',
        'message',
    ];

    public function liveChat(): BelongsTo
    {
        return $this->belongsTo(LiveChat::class);
    }
}
