<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LiveChat extends Model
{
    /** @var array<int, string> */
    protected $fillable = [
        'session_id',
        'visitor_name',
        'visitor_topic',
        'status',
        'queue_number',
        'started_at',
        'ended_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
            'queue_number' => 'integer',
        ];
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder<self> $query
     */
    public function scopeActive($query): void
    {
        $query->where('status', 'active');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder<self> $query
     */
    public function scopeWaiting($query): void
    {
        $query->where('status', 'waiting');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder<self> $query
     */
    public function scopeDone($query): void
    {
        $query->where('status', 'done');
    }
}
