@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
@include('admin.partials.page-header', [
    'title' => 'Product List',
    'breadcrumb' => 'Products',
    'description' => 'Manage your store inventory and listings.',
])

<div class="mb-5">
    <a href="{{ route('admin.products.create') }}" class="admin-btn">
        <ion-icon name="add-outline"></ion-icon> Add Product
    </a>
</div>

<div class="admin-card">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="text-slate-500">#{{ $product->id }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                <img src="{{ $product->image }}" alt="" class="h-11 w-11 rounded-xl border border-slate-100 object-cover">
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-slate-800">{{ $product->title }}</p>
                                    <p class="truncate text-xs text-slate-500">{{ $product->keywords ?? '—' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="text-slate-600">{{ $product->category?->title ?? '—' }}</td>
                        <td class="font-bold text-admin-primary">{{ $product->formattedPrice() }}</td>
                        <td>
                            <span class="{{ $product->stock > 0 ? 'admin-badge-success' : 'admin-badge-danger' }}">{{ $product->stock }}</span>
                        </td>
                        <td>
                            <span class="{{ $product->status === 'active' ? 'admin-badge-success' : 'admin-badge-muted' }}">
                                {{ $product->status === 'active' ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex flex-wrap justify-end gap-1.5">
                                <a href="{{ route('admin.products.show', $product->id) }}" class="admin-btn-ghost">Show</a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="admin-btn-success !px-3">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-500">
                            No products yet.
                            <a href="{{ route('admin.products.create') }}" class="font-semibold text-admin-primary hover:underline">Add one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="admin-card-footer">{{ $products->links() }}</div>
</div>
@endsection
