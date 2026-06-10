<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'keywords',
        'description',
        'image',
        'status',
        'sort_order',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function name(): Attribute
    {
        return Attribute::get(fn () => $this->title);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * @return array<int, array{id: int, title: string, depth: int}>
     */
    public static function nestedOptions(?int $excludeId = null): array
    {
        $all = static::orderBy('sort_order')->orderBy('title')->get();
        $excludeIds = $excludeId ? static::descendantIds($excludeId, $all)->push($excludeId)->all() : [];

        return static::buildNestedOptions($all, null, 0, $excludeIds);
    }

    /**
     * @param  \Illuminate\Support\Collection<int, Category>  $all
     * @param  array<int, int>  $excludeIds
     * @return array<int, array{id: int, title: string, depth: int}>
     */
    private static function buildNestedOptions($all, ?int $parentId, int $depth, array $excludeIds): array
    {
        $options = [];

        foreach ($all->where('parent_id', $parentId) as $category) {
            if (in_array($category->id, $excludeIds, true)) {
                continue;
            }

            $options[] = [
                'id' => $category->id,
                'title' => str_repeat('— ', $depth).$category->title,
                'depth' => $depth,
            ];

            $options = array_merge(
                $options,
                static::buildNestedOptions($all, $category->id, $depth + 1, $excludeIds)
            );
        }

        return $options;
    }

    /**
     * @param  \Illuminate\Support\Collection<int, Category>  $all
     * @return \Illuminate\Support\Collection<int, int>
     */
    private static function descendantIds(int $id, $all): \Illuminate\Support\Collection
    {
        $ids = collect();

        foreach ($all->where('parent_id', $id) as $child) {
            $ids->push($child->id);
            $ids = $ids->merge(static::descendantIds($child->id, $all));
        }

        return $ids;
    }
}
