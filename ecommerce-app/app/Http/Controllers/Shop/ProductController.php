<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category')->latest();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->string('q').'%');
        }

        if ($request->filled('category')) {
            $category = Category::where('slug', $request->string('category'))->first();
            if ($category) {
                $categoryIds = $category->children()->pluck('id')->push($category->id);
                $query->whereIn('category_id', $categoryIds);
            }
        }

        return view('shop.products.index', [
            'products' => $query->paginate(12)->withQueryString(),
            'title' => 'Shop',
        ]);
    }

    public function sales(): View
    {
        return view('shop.products.index', [
            'products' => Product::with('category')
                ->whereNotNull('original_price')
                ->latest()
                ->paginate(12),
            'title' => 'Sales',
        ]);
    }

    public function show(Product $product): View
    {
        $product->load('category.parent');

        return view('shop.products.show', [
            'product' => $product,
            'relatedProducts' => Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->take(4)
                ->get(),
        ]);
    }
}
