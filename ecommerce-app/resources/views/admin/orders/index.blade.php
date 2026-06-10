@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
@include('admin.partials.page-header', ['title' => 'Orders', 'breadcrumb' => 'Orders'])

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Recent Orders</h3>
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
                @foreach ($orders as $order)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 font-medium text-admin-primary">{{ $order['id'] }}</td>
                        <td class="px-4 py-3">{{ $order['customer'] }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $order['date'] }}</td>
                        <td class="px-4 py-3 font-semibold">${{ number_format($order['total'], 2) }}</td>
                        <td class="px-4 py-3">
                            @php
                                $colors = [
                                    'Completed' => 'bg-green-100 text-green-700',
                                    'Processing' => 'bg-blue-100 text-blue-700',
                                    'Shipped' => 'bg-indigo-100 text-indigo-700',
                                    'Pending' => 'bg-yellow-100 text-yellow-700',
                                    'Cancelled' => 'bg-red-100 text-red-700',
                                ];
                            @endphp
                            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $colors[$order['status']] ?? 'bg-slate-100' }}">
                                {{ $order['status'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <button type="button" class="rounded bg-admin-primary px-2 py-1 text-xs text-white">View</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="border-t border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-500">Footer</div>
</div>
@endsection
