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

    @if ($errors->any())
        <div class="mt-4 rounded-2xl border border-red-200 bg-red-50 px-5 py-3 text-sm text-red-700">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-10 grid gap-8 lg:grid-cols-2">
        <form action="{{ route('checkout.store') }}" method="POST" class="space-y-5 rounded-2xl border border-slate-100 bg-white p-6 shadow-card">
            @csrf
            <h2 class="text-lg font-bold text-shop-dark">Shipping Details</h2>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="name" class="mb-1 block text-xs font-semibold uppercase text-shop-muted">First Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
                </div>
                <div>
                    <label for="surname" class="mb-1 block text-xs font-semibold uppercase text-shop-muted">Last Name</label>
                    <input type="text" id="surname" name="surname" value="{{ old('surname', $user->surname) }}" required
                        class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
                </div>
            </div>
            <div>
                <label for="email" class="mb-1 block text-xs font-semibold uppercase text-shop-muted">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
            </div>
            <div>
                <label for="phone" class="mb-1 block text-xs font-semibold uppercase text-shop-muted">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                    class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
            </div>
            <div>
                <label for="address" class="mb-1 block text-xs font-semibold uppercase text-shop-muted">Address</label>
                <textarea id="address" name="address" rows="3" required
                    class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">{{ old('address') }}</textarea>
            </div>
            <div>
                <label for="note" class="mb-1 block text-xs font-semibold uppercase text-shop-muted">Order Note (optional)</label>
                <textarea id="note" name="note" rows="2"
                    class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">{{ old('note') }}</textarea>
            </div>
            <button type="submit" class="shop-btn w-full">Place Order</button>
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
                <div class="flex justify-between">
                    <span class="text-shop-muted">Shipping</span>
                    <span class="font-semibold {{ $shippingCost > 0 ? '' : 'text-emerald-600' }}">
                        {{ $shippingCost > 0 ? '$'.number_format($shippingCost, 2) : 'Free' }}
                    </span>
                </div>
                <div class="flex justify-between text-base font-bold"><span>Total</span><span class="text-shop-orange">${{ number_format($grandTotal, 2) }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
