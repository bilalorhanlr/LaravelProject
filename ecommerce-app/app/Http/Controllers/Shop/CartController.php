<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function index(): View
    {
        return view('shop.cart.index', [
            'items' => $this->cart->items(),
            'subtotal' => $this->cart->subtotal(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
            'size' => ['nullable', 'string', 'max:50'],
            'color' => ['nullable', 'string', 'max:50'],
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $this->cart->add(
            $product,
            $validated['quantity'] ?? 1,
            $validated['size'] ?? null,
            $validated['color'] ?? null,
        );

        return back()->with('cart_success', "{$product->name} added to cart.");
    }

    public function update(Request $request, string $key): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        $this->cart->update($key, $validated['quantity']);

        return redirect()->route('cart.index')->with('cart_success', 'Cart updated.');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->cart->remove($key);

        return redirect()->route('cart.index')->with('cart_success', 'Item removed from cart.');
    }

    public function clear(): RedirectResponse
    {
        $this->cart->clear();

        return redirect()->route('cart.index')->with('cart_success', 'Cart cleared.');
    }
}
