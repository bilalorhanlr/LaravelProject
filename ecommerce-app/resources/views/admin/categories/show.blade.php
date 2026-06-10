@extends('admin.layouts.app')

@section('title', $category->title)

@section('content')
@include('admin.partials.page-header', ['title' => $category->title, 'breadcrumb' => 'Category / Show'])

<div class="mb-4 flex gap-2">
    <a href="{{ route('admin.categories.index') }}" class="rounded border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">← Back</a>
    <a href="{{ route('admin.categories.edit', $category->id) }}" class="rounded bg-admin-primary px-4 py-2 text-sm font-semibold text-white hover:bg-blue-600">Edit</a>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm lg:col-span-1">
        @if ($category->image)
            <img src="{{ $category->image }}" alt="{{ $category->title }}" class="mb-4 w-full rounded-lg border object-cover">
        @endif
        <dl class="space-y-3 text-sm">
            <div>
                <dt class="text-xs font-semibold uppercase text-slate-500">ID</dt>
                <dd class="text-slate-800">{{ $category->id }}</dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase text-slate-500">Parent</dt>
                <dd class="text-slate-800">{{ $category->parent?->title ?? 'Main Category' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase text-slate-500">Slug</dt>
                <dd class="text-slate-800">{{ $category->slug }}</dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase text-slate-500">Keywords</dt>
                <dd class="text-slate-800">{{ $category->keywords ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase text-slate-500">Status</dt>
                <dd>
                    <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $category->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ $category->status === 'active' ? 'True' : 'False' }}
                    </span>
                </dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase text-slate-500">Products</dt>
                <dd class="text-slate-800">{{ $category->products_count }}</dd>
            </div>
        </dl>
    </div>

    <div class="space-y-6 lg:col-span-2">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="mb-3 font-semibold text-slate-800">Description</h3>
            <div class="prose prose-sm max-w-none text-slate-600">{!! $category->description ?: '<p>—</p>' !!}</div>
        </div>

        @if ($category->children->isNotEmpty())
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-3 font-semibold text-slate-800">Sub Categories</h3>
                <ul class="divide-y divide-slate-100">
                    @foreach ($category->children as $child)
                        <li class="flex items-center justify-between py-2">
                            <span>{{ $child->title }}</span>
                            <a href="{{ route('admin.categories.show', $child->id) }}" class="text-xs text-admin-primary hover:underline">View</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($category->products->isNotEmpty())
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="mb-3 font-semibold text-slate-800">Products in this Category</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b text-left text-xs uppercase text-slate-500">
                            <tr>
                                <th class="py-2">Title</th>
                                <th class="py-2">Price</th>
                                <th class="py-2">Stock</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($category->products as $product)
                                <tr>
                                    <td class="py-2">{{ $product->title }}</td>
                                    <td class="py-2">{{ $product->formattedPrice() }}</td>
                                    <td class="py-2">{{ $product->stock }}</td>
                                    <td class="py-2 text-right">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="text-xs text-green-600 hover:underline">Show</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
