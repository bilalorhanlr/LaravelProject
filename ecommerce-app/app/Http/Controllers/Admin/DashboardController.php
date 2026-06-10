<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::whereNull('parent_id')->count(),
                'orders' => 128,
                'customers' => User::count(),
                'revenue' => 18230.00,
                'visitors' => 820,
            ],
            'topProducts' => Product::latest()->take(4)->get(),
        ]);
    }
}
