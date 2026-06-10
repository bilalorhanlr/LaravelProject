@extends('layouts.shop')

@section('title', 'Checkout')

@section('content')
<div class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
    <nav class="mb-6 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <a href="{{ route('cart.index') }}" class="hover:text-shop-orange">Cart</a>
        <span>/</span>
        <span class="font-medium text-shop-dark">Checkout</span>
    </nav>

    <h1 class="shop-section-title">Checkout</h1>

    <div class="mt-10 grid gap-8 lg:grid-cols-2">
        <form class="space-y-5 rounded-2xl border border-slate-100 bg-white p-6 shadow-card">
            <h2 class="text-lg font-bold text-shop-dark">Shipping Details</h2>
            <div class="grid gap-4 sm:grid-cols-2">
                <input type="text" placeholder="First Name" class="rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
                <input type="text" placeholder="Last Name" class="rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
            </div>
            <input type="email" placeholder="Email" class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
            <input type="text" placeholder="Address" class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
            <input type="text" placeholder="City" class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
            <button type="button" class="shop-btn w-full">Place Order</button>
        </form>

        <div class="rounded-2xl border border-slate-100 bg-shop-surface p-6 shadow-card">
            <h2 class="text-lg font-bold text-shop-dark">Your Order</h2>
            <div class="mt-6 space-y-4">
                @foreach ($items as $item)
                    <div class="flex items-center gap-4">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-14 w-14 rounded-lg object-cover">
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-shop-dark">{{ $item['name'] }}</p>
                            <p class="text-xs text-shop-muted">Qty: {{ $item['quantity'] }} · {{ $item['size'] }}</p>
                        </div>
                        <p class="text-sm font-semibold">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 space-y-3 border-t border-slate-200 pt-4 text-sm">
                <div class="flex justify-between"><span class="text-shop-muted">Subtotal</span><span class="font-semibold">${{ number_format($subtotal, 2) }}</span></div>
                <div class="flex justify-between"><span class="text-shop-muted">Shipping</span><span class="font-semibold text-emerald-600">{{ $subtotal >= 50 ? 'Free' : '$5.00' }}</span></div>
                <div class="flex justify-between text-base font-bold"><span>Total</span><span class="text-shop-orange">${{ number_format($subtotal >= 50 ? $subtotal : $subtotal + 5, 2) }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
