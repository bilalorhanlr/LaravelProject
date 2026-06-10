<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'keywords',
        'description',
        'detail',
        'price',
        'original_price',
        'image',
        'quantity',
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
        'status',
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

    protected function name(): Attribute
    {
        return Attribute::get(fn () => $this->title);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
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

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function publishedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('status', 'active')->latest();
    }

    public function syncReviewStats(): void
    {
        $stats = $this->comments()->published();

        $count = (clone $stats)->count();
        $average = $count > 0 ? round((clone $stats)->avg('rate'), 1) : 0;

        $this->update([
            'review_count' => $count,
            'rating' => $average,
        ]);
    }

    public function formattedRating(): string
    {
        return number_format((float) $this->rating, 1);
    }
}
