@extends('layouts.shop')

@section('title', 'My Orders')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <nav class="mb-6 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <span class="font-medium text-shop-orange">My Orders</span>
    </nav>

    <h1 class="shop-section-title">My Orders</h1>

    <div class="mt-8 grid gap-8 lg:grid-cols-4">
        <div class="lg:col-span-1">
            @include('partials.shop.user-sidebar')
        </div>

        <div class="lg:col-span-3">
            <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-100 bg-shop-surface/50 text-left text-xs uppercase text-shop-muted">
                            <tr>
                                <th class="px-4 py-3">Order #</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-shop-dark">#{{ $order->id }}</td>
                                    <td class="px-4 py-3">${{ number_format($order->total ?? 0, 2) }}</td>
                                    <td class="px-4 py-3 capitalize">{{ $order->status ?? 'pending' }}</td>
                                    <td class="px-4 py-3 text-shop-muted">{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-center text-shop-muted">No orders yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-slate-100 px-4 py-3">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
