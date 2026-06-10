<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'original_price',
        'image',
        'rating',
        'review_count',
        'is_new',
        'discount_percent',
        'stock',
        'brand',
        'sizes',
        'colors',
        'is_featured',
        'is_deal',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'original_price' => 'decimal:2',
            'rating' => 'decimal:1',
            'is_new' => 'boolean',
            'is_featured' => 'boolean',
            'is_deal' => 'boolean',
            'sizes' => 'array',
            'colors' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function isOnSale(): bool
    {
        return $this->original_price !== null && $this->original_price > $this->price;
    }

    public function formattedPrice(): string
    {
        return '$'.number_format($this->price, 2);
    }

    public function formattedOriginalPrice(): ?string
    {
        return $this->original_price ? '$'.number_format($this->original_price, 2) : null;
    }
}
