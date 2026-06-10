@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
@include('admin.partials.page-header', ['title' => 'Products', 'breadcrumb' => 'Products'])

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Product List</h3>
        <div class="flex gap-1">
            <button type="button" class="rounded p-1 text-slate-400 hover:bg-slate-100"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg></button>
            <button type="button" class="rounded p-1 text-slate-400 hover:bg-slate-100"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
    </div>
    <div class="p-4">
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <button type="button" class="rounded bg-admin-primary px-4 py-2 text-sm font-semibold text-white hover:bg-blue-600">+ Add Product</button>
            <input type="search" placeholder="Search products..." class="rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-y border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Product</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Stock</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($products as $product)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 text-slate-500">{{ $product->id }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $product->image }}" alt="" class="h-10 w-10 rounded object-cover">
                                    <span class="font-medium text-slate-800">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $product->category?->name }}</td>
                            <td class="px-4 py-3 font-semibold">{{ $product->formattedPrice() }}</td>
                            <td class="px-4 py-3">{{ $product->stock }}</td>
                            <td class="px-4 py-3">
                                @if ($product->stock > 0)
                                    <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-700">In Stock</span>
                                @else
                                    <span class="rounded-full bg-red-100 px-2 py-0.5 text-xs font-semibold text-red-700">Out of Stock</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <button type="button" class="rounded bg-admin-primary px-2 py-1 text-xs text-white">Edit</button>
                                    <button type="button" class="rounded bg-admin-danger px-2 py-1 text-xs text-white">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $products->links() }}</div>
    </div>
    <div class="border-t border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-500">
        Showing {{ $products->count() }} of {{ $products->total() }} products
    </div>
</div>
@endsection
