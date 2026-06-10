@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
@include('admin.partials.page-header', [
    'title' => 'Orders',
    'breadcrumb' => 'Order Management',
    'description' => 'Review, approve or reject customer orders.',
])

<div class="mb-5 flex flex-wrap gap-2">
    @foreach ([
        '' => 'All',
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
    ] as $value => $label)
        <a
            href="{{ route('admin.orders.index', $value ? ['status' => $value] : []) }}"
            class="rounded-full px-4 py-1.5 text-xs font-semibold transition {{ request('status', '') === $value ? 'bg-admin-primary text-white shadow-sm shadow-admin-primary/25' : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-slate-50' }}"
        >{{ $label }}</a>
    @endforeach
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="font-semibold text-slate-800">Manage Orders</h3>
        <p class="text-xs text-slate-500">{{ $orders->total() }} total</p>
    </div>
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td class="font-bold text-admin-primary">#{{ $order->id }}</td>
                        <td>
                            <p class="font-semibold text-slate-800">{{ $order->customerName() }}</p>
                            <p class="text-xs text-slate-500">{{ $order->email }}</p>
                        </td>
                        <td class="text-slate-500">{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td class="font-bold text-slate-800">${{ number_format($order->total, 2) }}</td>
                        <td><x-order-status-badge :order="$order" /></td>
                        <td>
                            <div class="flex flex-wrap justify-end gap-1.5">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="admin-btn !px-3 !py-1.5 !text-xs">View</a>
                                @if ($order->status === \App\Models\Order::STATUS_PENDING)
                                    <form action="{{ route('admin.orders.accept', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="admin-btn-success" onclick="return confirm('Approve this order?')">Accept</button>
                                    </form>
                                    <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="admin-btn-danger" onclick="return confirm('Reject this order? Stock will be restored.')">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-500">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="admin-card-footer">{{ $orders->links() }}</div>
</div>
@endsection
