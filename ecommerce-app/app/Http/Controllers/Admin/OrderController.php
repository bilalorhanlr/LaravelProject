<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = collect([
            ['id' => '#ORD-1042', 'customer' => 'Ayşe Yılmaz', 'total' => 156.50, 'status' => 'Completed', 'date' => '2026-06-10'],
            ['id' => '#ORD-1041', 'customer' => 'Mehmet Kaya', 'total' => 89.99, 'status' => 'Processing', 'date' => '2026-06-10'],
            ['id' => '#ORD-1040', 'customer' => 'Zeynep Demir', 'total' => 234.00, 'status' => 'Shipped', 'date' => '2026-06-09'],
            ['id' => '#ORD-1039', 'customer' => 'Can Öztürk', 'total' => 45.00, 'status' => 'Pending', 'date' => '2026-06-09'],
            ['id' => '#ORD-1038', 'customer' => 'Elif Arslan', 'total' => 312.75, 'status' => 'Completed', 'date' => '2026-06-08'],
            ['id' => '#ORD-1037', 'customer' => 'Burak Şahin', 'total' => 67.20, 'status' => 'Cancelled', 'date' => '2026-06-08'],
        ]);

        return view('admin.orders.index', compact('orders'));
    }
}
