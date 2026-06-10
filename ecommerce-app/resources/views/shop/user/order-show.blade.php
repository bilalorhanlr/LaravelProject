@extends('layouts.shop')

@section('title', 'Order #'.$order->id)

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <nav class="mb-6 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <a href="{{ route('user.orders') }}" class="hover:text-shop-orange">My Orders</a>
        <span>/</span>
        <span class="font-medium text-shop-orange">Order #{{ $order->id }}</span>
    </nav>

    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="shop-section-title">Order #{{ $order->id }}</h1>
        <x-order-status-badge :order="$order" />
    </div>

    <div class="mt-8 grid gap-8 lg:grid-cols-4">
        <div class="lg:col-span-1">
            @include('partials.shop.user-sidebar')
        </div>

        <div class="space-y-6 lg:col-span-3">
            <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-card">
                <h2 class="text-lg font-bold text-shop-dark">Order Information</h2>
                <dl class="mt-4 grid gap-4 text-sm sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase text-shop-muted">Order Date</dt>
                        <dd class="mt-1 font-medium text-shop-dark">{{ $order->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase text-shop-muted">Status</dt>
                        <dd class="mt-1">
                            <x-order-status-badge :order="$order" />
                            @if ($order->status === \App\Models\Order::STATUS_PENDING)
                                <p class="mt-1 text-xs text-shop-muted">Your order is waiting for admin approval.</p>
                            @elseif ($order->status === \App\Models\Order::STATUS_APPROVED)
                                <p class="mt-1 text-xs text-emerald-600">Your order has been approved.</p>
                            @elseif ($order->status === \App\Models\Order::STATUS_REJECTED)
                                <p class="mt-1 text-xs text-red-600">Your order was rejected by the store.</p>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase text-shop-muted">Shipping Name</dt>
                        <dd class="mt-1 font-medium text-shop-dark">{{ $order->customerName() }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase text-shop-muted">Phone</dt>
                        <dd class="mt-1 text-shop-dark">{{ $order->phone }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase text-shop-muted">Email</dt>
                        <dd class="mt-1 text-shop-dark">{{ $order->email }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold uppercase text-shop-muted">Address</dt>
                        <dd class="mt-1 text-shop-dark">{{ $order->address }}</dd>
                    </div>
                    @if ($order->note)
                        <div class="sm:col-span-2">
                            <dt class="text-xs font-semibold uppercase text-shop-muted">Note</dt>
                            <dd class="mt-1 text-shop-dark">{{ $order->note }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card">
                <div class="border-b border-slate-100 px-6 py-4">
                    <h2 class="text-lg font-bold text-shop-dark">Order Items</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-100 bg-shop-surface/50 text-left text-xs uppercase text-shop-muted">
                            <tr>
                                <th class="px-4 py-3">Product</th>
                                <th class="px-4 py-3">Size</th>
                                <th class="px-4 py-3">Price</th>
                                <th class="px-4 py-3">Qty</th>
                                <th class="px-4 py-3">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($order->orderProducts as $line)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            @if ($line->product?->image)
                                                <img src="{{ $line->product->image }}" alt="" class="h-10 w-10 rounded-lg object-cover">
                                            @endif
                                            <span class="font-medium text-shop-dark">{{ $line->product?->name ?? 'Product #'.$line->product_id }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-shop-muted">{{ $line->size ?? '—' }}</td>
                                    <td class="px-4 py-3">${{ number_format($line->price, 2) }}</td>
                                    <td class="px-4 py-3">{{ $line->amount }}</td>
                                    <td class="px-4 py-3 font-semibold">${{ number_format($line->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-t border-slate-100 bg-shop-surface/30 text-sm">
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-right text-shop-muted">Subtotal</td>
                                <td class="px-4 py-3 font-semibold">${{ number_format($order->total - ($order->shipping_cost ?? 0), 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-right text-shop-muted">Shipping</td>
                                <td class="px-4 py-3 font-semibold">
                                    {{ ($order->shipping_cost ?? 0) > 0 ? '$'.number_format($order->shipping_cost, 2) : 'Free' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-right font-bold text-shop-dark">Grand Total</td>
                                <td class="px-4 py-3 font-bold text-shop-orange">${{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <a href="{{ route('user.orders') }}" class="shop-btn-outline inline-flex">← Back to Orders</a>
        </div>
    </div>
</div>
@endsection
