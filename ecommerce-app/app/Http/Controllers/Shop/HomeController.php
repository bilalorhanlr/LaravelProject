<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $rootCategories = Category::roots()
            ->active()
            ->with(['children' => fn ($q) => $q->active()->orderBy('sort_order')->orderBy('title')])
            ->withCount('products')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $latestProducts = Product::with('category')->active()->latest()->take(8)->get();

        $featuredProducts = Product::with('category')
            ->active()
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = $latestProducts->take(4);
        }

        $dealProducts = Product::with('category')
            ->active()
            ->where('is_deal', true)
            ->latest()
            ->take(4)
            ->get();

        if ($dealProducts->isEmpty()) {
            $dealProducts = Product::with('category')
                ->active()
                ->whereNotNull('original_price')
                ->latest()
                ->take(4)
                ->get();
        }

        $homeProducts = Product::with('category')
            ->active()
            ->latest()
            ->take(12)
            ->get();

        return view('shop.home', [
            'sliderSlides' => config('shop.slider'),
            'rootCategories' => $rootCategories,
            'featuredProducts' => $featuredProducts,
            'latestProducts' => $latestProducts,
            'dealProducts' => $dealProducts,
            'homeProducts' => $homeProducts,
        ]);
    }
}
