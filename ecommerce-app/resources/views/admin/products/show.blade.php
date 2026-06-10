@extends('admin.layouts.app')

@section('title', $product->title)

@section('content')
@include('admin.partials.page-header', ['title' => $product->title, 'breadcrumb' => 'Product / Show'])

<div class="mb-4 flex gap-2">
    <a href="{{ route('admin.products.index') }}" class="rounded border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">← Back</a>
    <a href="{{ route('admin.products.edit', $product->id) }}" class="rounded bg-admin-primary px-4 py-2 text-sm font-semibold text-white hover:bg-blue-600">Edit</a>
    <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="rounded border border-green-600 px-4 py-2 text-sm font-semibold text-green-600 hover:bg-green-50">View on Store</a>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-4 lg:col-span-1">
        <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="mb-2 text-xs font-semibold uppercase text-slate-500">Main Image</p>
            <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full rounded-lg border object-cover">
        </div>

        @if ($product->images->isNotEmpty())
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="mb-2 text-xs font-semibold uppercase text-slate-500">Image Gallery</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($product->images as $img)
                        <img src="{{ $img->image }}" alt="" class="h-20 w-full rounded border object-cover">
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="space-y-6 lg:col-span-2">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <dl class="grid gap-4 sm:grid-cols-2 text-sm">
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">ID</dt>
                    <dd>{{ $product->id }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Category</dt>
                    <dd>
                        <a href="{{ route('admin.categories.show', $product->category_id) }}" class="text-admin-primary hover:underline">{{ $product->category?->title }}</a>
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Price</dt>
                    <dd class="font-semibold">{{ $product->formattedPrice() }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Stock</dt>
                    <dd>{{ $product->stock }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Brand</dt>
                    <dd>{{ $product->brand }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Status</dt>
                    <dd>
                        <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $product->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase text-slate-500">Keywords</dt>
                    <dd>{{ $product->keywords ?? '—' }}</dd>
                </div>
            </dl>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="mb-2 font-semibold text-slate-800">Description</h3>
            <div class="prose prose-sm max-w-none text-slate-600">{!! $product->description ?: '<p>—</p>' !!}</div>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="mb-2 font-semibold text-slate-800">Detail</h3>
            <div class="prose prose-sm max-w-none text-slate-600">{!! $product->detail ?: '<p>—</p>' !!}</div>
        </div>
    </div>
</div>
@endsection
