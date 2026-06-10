@extends('admin.layouts.app')

@section('title', 'Order #'.$order->id)

@section('content')
@include('admin.partials.page-header', ['title' => 'Order #'.$order->id, 'breadcrumb' => 'Orders / Show'])

@if (session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="mb-4 flex flex-wrap gap-2">
    <a href="{{ route('admin.orders.index') }}" class="rounded border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">← Back to Orders</a>
    @if ($order->status === \App\Models\Order::STATUS_PENDING)
        <form action="{{ route('admin.orders.accept', $order->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="rounded bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700" onclick="return confirm('Approve this order?')">Accept Order</button>
        </form>
        <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="rounded bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700" onclick="return confirm('Reject this order? Stock will be restored.')">Cancel Order</button>
        </form>
    @endif
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-1">
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-slate-800">Order Status</h3>
                    <x-order-status-badge :order="$order" />
                </div>
            </div>
            <dl class="space-y-4 p-6 text-sm">
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Order ID</dt>
                    <dd class="mt-1 font-medium text-slate-800">#{{ $order->id }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Date</dt>
                    <dd class="mt-1 text-slate-800">{{ $order->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Total</dt>
                    <dd class="mt-1 text-lg font-bold text-admin-primary">${{ number_format($order->total, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Shipping</dt>
                    <dd class="mt-1 text-slate-800">{{ ($order->shipping_cost ?? 0) > 0 ? '$'.number_format($order->shipping_cost, 2) : 'Free' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">IP Address</dt>
                    <dd class="mt-1 text-slate-800">{{ $order->ip ?? '—' }}</dd>
                </div>
            </dl>
        </div>

        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="font-semibold text-slate-800">Customer</h3>
            </div>
            <dl class="space-y-4 p-6 text-sm">
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Name</dt>
                    <dd class="mt-1 font-medium text-slate-800">{{ $order->customerName() }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Email</dt>
                    <dd class="mt-1"><a href="mailto:{{ $order->email }}" class="text-admin-primary hover:underline">{{ $order->email }}</a></dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Phone</dt>
                    <dd class="mt-1 text-slate-800">{{ $order->phone }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Address</dt>
                    <dd class="mt-1 whitespace-pre-wrap text-slate-800">{{ $order->address }}</dd>
                </div>
                @if ($order->note)
                    <div>
                        <dt class="text-xs font-semibold uppercase text-slate-500">Note</dt>
                        <dd class="mt-1 whitespace-pre-wrap text-slate-800">{{ $order->note }}</dd>
                    </div>
                @endif
                @if ($order->user)
                    <div>
                        <dt class="text-xs font-semibold uppercase text-slate-500">Registered User</dt>
                        <dd class="mt-1 text-slate-800">{{ $order->user->email }}</dd>
                    </div>
                @endif
            </dl>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="font-semibold text-slate-800">Order Items</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Size</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Qty</th>
                            <th class="px-4 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($order->orderProducts as $line)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        @if ($line->product?->image)
                                            <img src="{{ $line->product->image }}" alt="" class="h-10 w-10 rounded object-cover">
                                        @endif
                                        <div>
                                            <p class="font-medium text-slate-800">{{ $line->product?->name ?? 'Product #'.$line->product_id }}</p>
                                            @if ($line->product)
                                                <a href="{{ route('admin.products.show', $line->product->id) }}" class="text-xs text-admin-primary hover:underline">View product</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-slate-500">{{ $line->size ?? '—' }}</td>
                                <td class="px-4 py-3">${{ number_format($line->price, 2) }}</td>
                                <td class="px-4 py-3">{{ $line->amount }}</td>
                                <td class="px-4 py-3 font-semibold">${{ number_format($line->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
