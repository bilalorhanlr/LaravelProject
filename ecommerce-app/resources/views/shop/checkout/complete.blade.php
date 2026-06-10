@extends('layouts.shop')

@section('title', 'Order Complete')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
    <nav class="mb-6 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <span class="font-medium text-shop-dark">Order Complete</span>
    </nav>

    <div class="rounded-3xl border border-slate-100 bg-white p-8 text-center shadow-card sm:p-12">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h1 class="mt-6 text-2xl font-bold text-shop-dark">Thank You for Your Order!</h1>
        <p class="mt-2 text-shop-muted">Your order <strong class="text-shop-dark">#{{ $order->id }}</strong> has been received and is awaiting approval.</p>

        <div class="mt-6 flex justify-center">
            <x-order-status-badge :order="$order" />
        </div>

        @if (session('success'))
            <p class="mt-4 text-sm text-emerald-600">{{ session('success') }}</p>
        @endif
    </div>

    <div class="mt-8 rounded-2xl border border-slate-100 bg-white p-6 shadow-card">
        <h2 class="text-lg font-bold text-shop-dark">Order Summary</h2>
        <dl class="mt-4 grid gap-3 text-sm sm:grid-cols-2">
            <div>
                <dt class="text-shop-muted">Order Number</dt>
                <dd class="font-semibold text-shop-dark">#{{ $order->id }}</dd>
            </div>
            <div>
                <dt class="text-shop-muted">Date</dt>
                <dd class="font-semibold text-shop-dark">{{ $order->created_at->format('M d, Y H:i') }}</dd>
            </div>
            <div>
                <dt class="text-shop-muted">Total</dt>
                <dd class="font-semibold text-shop-orange">${{ number_format($order->total, 2) }}</dd>
            </div>
            <div>
                <dt class="text-shop-muted">Status</dt>
                <dd class="mt-1"><x-order-status-badge :order="$order" /></dd>
            </div>
        </dl>

        <div class="mt-6 divide-y divide-slate-100 border-t border-slate-100 pt-4">
            @foreach ($order->orderProducts as $line)
                <div class="flex items-center gap-4 py-3">
                    @if ($line->product?->image)
                        <img src="{{ $line->product->image }}" alt="{{ $line->product->name }}" class="h-14 w-14 rounded-lg object-cover">
                    @endif
                    <div class="min-w-0 flex-1 text-left">
                        <p class="font-medium text-shop-dark">{{ $line->product?->name ?? 'Product' }}</p>
                        <p class="text-xs text-shop-muted">
                            Qty: {{ $line->amount }}
                            @if ($line->size) · {{ $line->size }} @endif
                        </p>
                    </div>
                    <p class="text-sm font-semibold">${{ number_format($line->total, 2) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8 flex flex-wrap justify-center gap-3">
        <a href="{{ route('user.orders.show', $order) }}" class="shop-btn">View My Order</a>
        <a href="{{ route('user.orders') }}" class="shop-btn-outline">All Orders</a>
        <a href="{{ route('shop') }}" class="shop-btn-outline">Continue Shopping</a>
    </div>
</div>
@endsection
