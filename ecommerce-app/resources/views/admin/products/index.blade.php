@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
@include('admin.partials.page-header', ['title' => 'Products', 'breadcrumb' => 'List'])

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Product List</h3>
        <a href="{{ route('admin.products.create') }}" class="rounded bg-admin-primary px-4 py-2 text-sm font-semibold text-white hover:bg-blue-600">+ Add Product</a>
    </div>

    <div class="overflow-x-auto p-4">
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
                @forelse ($products as $product)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $product->id }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $product->image }}" alt="" class="h-10 w-10 rounded object-cover">
                                <span class="font-medium text-slate-800">{{ $product->title }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $product->category?->title }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $product->formattedPrice() }}</td>
                        <td class="px-4 py-3">{{ $product->stock }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $product->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="rounded bg-admin-primary px-2 py-1 text-xs text-white">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded bg-admin-danger px-2 py-1 text-xs text-white">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-slate-500">No products yet. <a href="{{ route('admin.products.create') }}" class="text-admin-primary hover:underline">Add one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</div>
@endsection
