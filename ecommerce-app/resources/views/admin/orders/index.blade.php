@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
@include('admin.partials.page-header', ['title' => 'Orders', 'breadcrumb' => 'Orders'])

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
    <a href="{{ route('admin.orders.index') }}" class="rounded-full px-3 py-1 text-xs font-semibold {{ !request('status') ? 'bg-admin-primary text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">All</a>
    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="rounded-full px-3 py-1 text-xs font-semibold {{ request('status') === 'pending' ? 'bg-amber-500 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">Pending</a>
    <a href="{{ route('admin.orders.index', ['status' => 'approved']) }}" class="rounded-full px-3 py-1 text-xs font-semibold {{ request('status') === 'approved' ? 'bg-green-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">Approved</a>
    <a href="{{ route('admin.orders.index', ['status' => 'rejected']) }}" class="rounded-full px-3 py-1 text-xs font-semibold {{ request('status') === 'rejected' ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">Rejected</a>
</div>

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Manage Orders</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">Order ID</th>
                    <th class="px-4 py-3">Customer</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($orders as $order)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 font-medium text-admin-primary">#{{ $order->id }}</td>
                        <td class="px-4 py-3">
                            <div>{{ $order->customerName() }}</div>
                            <div class="text-xs text-slate-500">{{ $order->email }}</div>
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-4 py-3 font-semibold">${{ number_format($order->total, 2) }}</td>
                        <td class="px-4 py-3">
                            <x-order-status-badge :order="$order" />
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="rounded bg-admin-primary px-2 py-1 text-xs text-white hover:bg-admin-primary-dark">View</a>
                                @if ($order->status === \App\Models\Order::STATUS_PENDING)
                                    <form action="{{ route('admin.orders.accept', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="rounded bg-green-600 px-2 py-1 text-xs text-white hover:bg-green-700" onclick="return confirm('Approve this order?')">Accept</button>
                                    </form>
                                    <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="rounded bg-red-600 px-2 py-1 text-xs text-white hover:bg-red-700" onclick="return confirm('Reject this order? Stock will be restored.')">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-slate-500">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="border-t border-slate-200 px-4 py-3">{{ $orders->links() }}</div>
</div>
@endsection
