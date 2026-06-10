<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('shop.categories.index', [
            'categories' => Category::whereNull('parent_id')
                ->with(['children', 'products'])
                ->withCount('products')
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function show(Category $category): View
    {
        $categoryIds = $category->children()->pluck('id')->push($category->id);

        return view('shop.categories.show', [
            'category' => $category->load(['children', 'parent']),
            'products' => Product::with('category')
                ->whereIn('category_id', $categoryIds)
                ->latest()
                ->paginate(12),
        ]);
    }
}
