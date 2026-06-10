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
                ->active()
                ->with(['children' => fn ($q) => $q->active()])
                ->withCount('products')
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function show(Category $category): View
    {
        $category->load([
            'parent',
            'children' => fn ($q) => $q->active()->withCount('products')->orderBy('sort_order')->orderBy('title'),
            'parent.children' => fn ($q) => $q->active()->withCount('products')->orderBy('sort_order')->orderBy('title'),
        ]);

        if ($category->parent_id) {
            $productsQuery = Product::active()->where('category_id', $category->id);
        } else {
            $categoryIds = $category->children()->pluck('id')->push($category->id);
            $productsQuery = Product::active()->whereIn('category_id', $categoryIds);
        }

        $products = $productsQuery->with('category')->latest()->paginate(12);

        return view('shop.categories.show', [
            'category' => $category,
            'subcategories' => $category->parent_id
                ? ($category->parent?->children ?? collect())
                : $category->children,
            'products' => $products,
        ]);
    }
}
