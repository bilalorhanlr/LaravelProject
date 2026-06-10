<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('shop.home', [
            'featuredProducts' => Product::with('category')->where('is_featured', true)->latest()->take(4)->get(),
            'latestProducts' => Product::with('category')->latest()->take(8)->get(),
            'dealProducts' => Product::with('category')->where('is_deal', true)->latest()->take(4)->get(),
        ]);
    }
}
