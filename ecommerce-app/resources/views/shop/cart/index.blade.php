@extends('layouts.shop')

@section('title', 'Shopping Cart')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <nav class="mb-6 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <span class="font-medium text-shop-dark">Shopping Cart</span>
    </nav>

    <h1 class="shop-section-title">Shopping Cart</h1>

    @if ($items->isEmpty())
        <div class="mt-10 rounded-3xl border border-dashed border-slate-200 bg-shop-surface py-20 text-center">
            <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            <p class="mt-4 text-lg font-medium text-shop-muted">Your cart is empty</p>
            <a href="{{ route('shop') }}" class="shop-btn mt-6 inline-flex">Continue Shopping</a>
        </div>
    @else
        <div class="mt-10 grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-4">
                @foreach ($items as $item)
                    <div class="flex flex-col gap-4 rounded-2xl border border-slate-100 bg-white p-4 shadow-card sm:flex-row sm:items-center">
                        <a href="{{ route('products.show', $item['slug']) }}" class="shrink-0 overflow-hidden rounded-xl">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-24 w-24 object-cover sm:h-28 sm:w-28">
                        </a>
                        <div class="min-w-0 flex-1">
                            <a href="{{ route('products.show', $item['slug']) }}" class="font-semibold text-shop-dark hover:text-shop-orange">{{ $item['name'] }}</a>
                            <p class="mt-1 text-sm text-shop-muted">Size: {{ $item['size'] }}</p>
                            <p class="text-sm font-bold text-shop-orange">${{ number_format($item['price'], 2) }}</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <form action="{{ route('cart.update', $item['key']) }}" method="POST" class="flex items-center overflow-hidden rounded-xl border border-slate-200">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99" class="w-16 border-0 py-2 text-center text-sm focus:ring-0">
                                <button type="submit" class="bg-shop-surface px-3 py-2 text-xs font-semibold text-shop-dark hover:bg-shop-orange hover:text-white">Update</button>
                            </form>
                            <form action="{{ route('cart.destroy', $item['key']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl p-2 text-shop-muted transition hover:bg-red-50 hover:text-red-500" title="Remove">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                        <p class="text-right font-bold text-shop-dark sm:w-24">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    </div>
                @endforeach

                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="{{ route('shop') }}" class="shop-btn-outline">Continue Shopping</a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="shop-btn-outline text-red-500 hover:border-red-200 hover:text-red-600">Clear Cart</button>
                    </form>
                </div>
            </div>

            <div class="h-fit rounded-2xl border border-slate-100 bg-shop-surface p-6 shadow-card">
                <h2 class="text-lg font-bold text-shop-dark">Order Summary</h2>
                <div class="mt-6 space-y-3 text-sm">
                    <div class="flex justify-between"><span class="text-shop-muted">Subtotal</span><span class="font-semibold">${{ number_format($subtotal, 2) }}</span></div>
                    <div class="flex justify-between"><span class="text-shop-muted">Shipping</span><span class="font-semibold {{ $subtotal >= 50 ? 'text-emerald-600' : 'text-shop-dark' }}">{{ $subtotal >= 50 ? 'Free' : '$5.00' }}</span></div>
                    <div class="flex justify-between border-t border-slate-200 pt-3 text-base font-bold">
                        <span>Total</span>
                        <span class="text-shop-orange">${{ number_format($subtotal >= 50 ? $subtotal : $subtotal + 5, 2) }}</span>
                    </div>
                </div>
                @if ($subtotal < 50)
                    <p class="mt-3 text-xs text-shop-muted">Add ${{ number_format(50 - $subtotal, 2) }} more for free shipping!</p>
                @endif
                <a href="{{ route('pages.checkout') }}" class="shop-btn mt-6 w-full">Proceed to Checkout</a>
            </div>
        </div>
    @endif
</div>
@endsection
