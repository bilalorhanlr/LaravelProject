@extends('admin.layouts.app')

@section('title', 'Product List')

@section('content')
@include('admin.partials.page-header', ['title' => 'Product List', 'breadcrumb' => 'Home / Product List'])

<div class="mb-4">
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 rounded bg-admin-primary px-4 py-2 text-sm font-semibold text-white hover:bg-blue-600">
        <ion-icon name="add-outline"></ion-icon> Add Product
    </a>
</div>

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">Id</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Keywords</th>
                    <th class="px-4 py-3">Image</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Edit</th>
                    <th class="px-4 py-3">Delete</th>
                    <th class="px-4 py-3">Show</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($products as $product)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $product->id }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $product->title }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $product->category?->title }}</td>
                        <td class="max-w-[120px] truncate px-4 py-3 text-slate-500">{{ $product->keywords ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <img src="{{ $product->image }}" alt="" class="h-12 w-10 rounded border object-cover">
                        </td>
                        <td class="px-4 py-3 font-semibold">{{ $product->formattedPrice() }}</td>
                        <td class="px-4 py-3">{{ $product->stock }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-semibold {{ $product->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->status === 'active' ? 'True' : 'False' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-block rounded bg-admin-primary px-3 py-1 text-xs font-semibold text-white hover:bg-blue-600">Edit</a>
                        </td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded bg-admin-danger px-3 py-1 text-xs font-semibold text-white hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.products.show', $product->id) }}" class="inline-block rounded bg-green-600 px-3 py-1 text-xs font-semibold text-white hover:bg-green-700">Show</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="px-4 py-10 text-center text-slate-500">No products yet. <a href="{{ route('admin.products.create') }}" class="text-admin-primary hover:underline">Add one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="border-t border-slate-200 px-4 py-3">{{ $products->links() }}</div>
</div>
@endsection
