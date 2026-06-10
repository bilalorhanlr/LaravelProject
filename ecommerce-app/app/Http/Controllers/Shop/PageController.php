<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function store(): View
    {
        return view('shop.pages.store');
    }

    public function newsletter(): View
    {
        return view('shop.pages.newsletter');
    }

    public function faq(): View
    {
        return view('shop.pages.faq');
    }

    public function about(): View
    {
        return view('shop.pages.about');
    }

    public function shipping(): View
    {
        return view('shop.pages.shipping');
    }

    public function wishlist(): View
    {
        return view('shop.pages.wishlist');
    }

    public function compare(): View
    {
        return view('shop.pages.compare');
    }

    public function checkout(CartService $cart): View|RedirectResponse
    {
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('cart_success', 'Add items to your cart before checkout.');
        }

        return view('shop.pages.checkout', [
            'items' => $cart->items(),
            'subtotal' => $cart->subtotal(),
        ]);
    }
}
