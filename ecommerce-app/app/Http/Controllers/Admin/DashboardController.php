<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $approvedOrders = Order::where('status', Order::STATUS_APPROVED);

        return view('admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::whereNull('parent_id')->count(),
                'orders' => Order::count(),
                'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
                'customers' => User::count(),
                'revenue' => (float) $approvedOrders->sum('total'),
            ],
            'topProducts' => Product::latest()->take(5)->get(),
            'recentOrders' => Order::with('user')->latest()->take(5)->get(),
            'recentMessages' => Message::latest()->take(5)->get(),
            'unreadMessages' => Message::where('status', 'unread')->count(),
        ]);
    }
}
