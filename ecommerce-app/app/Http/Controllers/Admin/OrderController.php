<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with('user')->latest();

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $id): View
    {
        $order = Order::with(['user', 'orderProducts.product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function accept(int $id, OrderService $orderService): RedirectResponse
    {
        $order = Order::findOrFail($id);

        try {
            $orderService->approve($order);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        }

        return back()->with('success', 'Order #'.$order->id.' has been approved.');
    }

    public function reject(int $id, OrderService $orderService): RedirectResponse
    {
        $order = Order::findOrFail($id);

        try {
            $orderService->reject($order);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        }

        return back()->with('success', 'Order #'.$order->id.' has been rejected.');
    }
}
