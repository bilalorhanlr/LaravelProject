@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
@include('admin.partials.page-header', [
    'title' => 'Dashboard',
    'breadcrumb' => 'Overview',
    'description' => 'Store performance and recent activity at a glance.',
])

{{-- Stat cards --}}
<div class="mb-8 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
    @foreach ([
        ['label' => 'Products', 'value' => $stats['products'], 'icon' => 'cube-outline', 'color' => 'from-blue-500 to-blue-600', 'link' => route('admin.products.index')],
        ['label' => 'Orders', 'value' => $stats['orders'], 'icon' => 'bag-handle-outline', 'color' => 'from-admin-primary to-admin-primary-dark', 'link' => route('admin.orders.index'), 'badge' => $stats['pending_orders'].' pending'],
        ['label' => 'Customers', 'value' => $stats['customers'], 'icon' => 'people-outline', 'color' => 'from-violet-500 to-violet-600', 'link' => route('admin.users.index')],
        ['label' => 'Revenue', 'value' => '$'.number_format($stats['revenue'], 2), 'icon' => 'wallet-outline', 'color' => 'from-emerald-500 to-emerald-600', 'link' => route('admin.orders.index', ['status' => 'approved'])],
    ] as $stat)
        <a href="{{ $stat['link'] }}" class="admin-stat-card group block">
            <div class="flex items-start justify-between">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br {{ $stat['color'] }} text-white shadow-lg">
                    <ion-icon name="{{ $stat['icon'] }}" class="text-2xl"></ion-icon>
                </div>
                <ion-icon name="arrow-forward-outline" class="text-lg text-slate-300 transition group-hover:text-admin-primary"></ion-icon>
            </div>
            <p class="mt-4 text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $stat['label'] }}</p>
            <p class="mt-1 text-2xl font-bold text-slate-900">{{ $stat['value'] }}</p>
            @if (! empty($stat['badge']))
                <span class="admin-badge-warning mt-2">{{ $stat['badge'] }}</span>
            @endif
        </a>
    @endforeach
</div>

<div class="grid gap-6 xl:grid-cols-3">
    {{-- Recent orders --}}
    <div class="admin-card xl:col-span-2">
        <div class="admin-card-header">
            <div>
                <h3 class="font-semibold text-slate-800">Recent Orders</h3>
                <p class="text-xs text-slate-500">Latest customer orders</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-admin-primary hover:underline">View all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td class="font-semibold text-slate-800">#{{ $order->id }}</td>
                            <td>
                                <p class="font-medium text-slate-700">{{ $order->customerName() }}</p>
                                <p class="text-xs text-slate-500">{{ $order->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="font-semibold text-slate-800">${{ number_format($order->total, 2) }}</td>
                            <td><x-order-status-badge :order="$order" /></td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-xs font-semibold text-admin-primary hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-500">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick links --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="font-semibold text-slate-800">Quick Actions</h3>
        </div>
        <div class="admin-card-body space-y-2 !pt-0">
            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 rounded-xl border border-slate-100 p-3 transition hover:border-admin-primary/30 hover:bg-orange-50/50">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100 text-admin-primary">
                    <ion-icon name="add-circle-outline" class="text-xl"></ion-icon>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-800">Add Product</p>
                    <p class="text-xs text-slate-500">Create a new listing</p>
                </div>
            </a>
            <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-3 rounded-xl border border-slate-100 p-3 transition hover:border-admin-primary/30 hover:bg-orange-50/50">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                    <ion-icon name="folder-open-outline" class="text-xl"></ion-icon>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-800">Add Category</p>
                    <p class="text-xs text-slate-500">Organize your catalog</p>
                </div>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="flex items-center gap-3 rounded-xl border border-slate-100 p-3 transition hover:border-admin-primary/30 hover:bg-orange-50/50">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                    <ion-icon name="time-outline" class="text-xl"></ion-icon>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-800">Pending Orders</p>
                    <p class="text-xs text-slate-500">{{ $stats['pending_orders'] }} awaiting review</p>
                </div>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 rounded-xl border border-slate-100 p-3 transition hover:border-admin-primary/30 hover:bg-orange-50/50">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                    <ion-icon name="settings-outline" class="text-xl"></ion-icon>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-800">Site Settings</p>
                    <p class="text-xs text-slate-500">General, contact, SMTP</p>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="mt-6 grid gap-6 lg:grid-cols-2">
    {{-- Messages --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3 class="font-semibold text-slate-800">Contact Messages</h3>
                @if ($unreadMessages > 0)
                    <span class="admin-badge-warning mt-1">{{ $unreadMessages }} unread</span>
                @endif
            </div>
            <a href="{{ route('admin.messages.index') }}" class="text-sm font-semibold text-admin-primary hover:underline">View all</a>
        </div>
        <ul class="divide-y divide-slate-50">
            @forelse ($recentMessages as $msg)
                <li class="flex items-center justify-between gap-3 px-5 py-4 transition hover:bg-slate-50/70">
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-semibold text-slate-800">{{ $msg->name }}</p>
                        <p class="truncate text-xs text-slate-500">{{ Str::limit($msg->message, 60) }}</p>
                    </div>
                    <div class="flex shrink-0 items-center gap-2">
                        <span class="{{ $msg->status === 'unread' ? 'admin-badge-warning' : 'admin-badge-success' }}">{{ $msg->status }}</span>
                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="text-xs font-semibold text-admin-primary hover:underline">Open</a>
                    </div>
                </li>
            @empty
                <li class="px-5 py-10 text-center text-sm text-slate-500">No messages yet.</li>
            @endforelse
        </ul>
    </div>

    {{-- Top products --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="font-semibold text-slate-800">Latest Products</h3>
            <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-admin-primary hover:underline">View all</a>
        </div>
        <ul class="divide-y divide-slate-50">
            @foreach ($topProducts as $product)
                <li class="flex items-center gap-4 px-5 py-4 transition hover:bg-slate-50/70">
                    <img src="{{ $product->image }}" alt="" class="h-12 w-12 rounded-xl border border-slate-100 object-cover">
                    <div class="min-w-0 flex-1">
                        <p class="truncate font-semibold text-slate-800">{{ $product->name }}</p>
                        <p class="text-xs text-slate-500">Stock: {{ $product->stock }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-admin-primary">{{ $product->formattedPrice() }}</p>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-xs text-slate-500 hover:text-admin-primary">Edit</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
