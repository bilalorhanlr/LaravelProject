<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'rate',
        'product_id',
        'user_id',
        'name',
        'email',
        'ip',
        'status',
    ];

    public function reviewerName(): string
    {
        return $this->name ?? $this->user?->name ?? 'Guest';
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'active');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
