@extends('admin.layouts.app')

@section('title', 'Customers')

@section('content')
@include('admin.partials.page-header', ['title' => 'Customers', 'breadcrumb' => 'Customers'])

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Customer List</h3>
        <input type="search" placeholder="Search customers..." class="rounded border-slate-300 text-sm">
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Joined</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($customers as $customer)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $customer->id }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-admin-primary text-xs font-bold text-white">
                                    {{ strtoupper(substr($customer->name, 0, 2)) }}
                                </div>
                                <span class="font-medium text-slate-800">{{ $customer->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $customer->email }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $customer->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                            <button type="button" class="rounded bg-admin-primary px-2 py-1 text-xs text-white">View</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">No customers yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="border-t border-slate-200 px-4 py-3">{{ $customers->links() }}</div>
</div>
@endsection
