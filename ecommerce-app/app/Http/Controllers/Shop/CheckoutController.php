<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function show(CartService $cart, OrderService $orderService): View|RedirectResponse
    {
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('cart_success', 'Add items to your cart before checkout.');
        }

        $subtotal = $cart->subtotal();
        $shippingCost = $orderService->shippingCost($subtotal);
        $user = auth()->user();

        return view('shop.pages.checkout', [
            'items' => $cart->items(),
            'subtotal' => $subtotal,
            'shippingCost' => $shippingCost,
            'grandTotal' => $subtotal + $shippingCost,
            'user' => $user,
        ]);
    }

    public function store(Request $request, CartService $cart, OrderService $orderService): RedirectResponse
    {
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('cart_success', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
            'phone' => ['required', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = $orderService->placeOrder($validated, auth()->id());

        return redirect()
            ->route('checkout.complete', $order)
            ->with('success', 'Your order has been placed successfully!');
    }

    public function complete(Order $order): View|RedirectResponse
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('orderProducts.product');

        return view('shop.checkout.complete', compact('order'));
    }
}
