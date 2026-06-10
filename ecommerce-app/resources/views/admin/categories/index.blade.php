@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
@include('admin.partials.page-header', ['title' => 'Categories', 'breadcrumb' => 'List'])

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Category List</h3>
        <a href="{{ route('admin.categories.create') }}" class="rounded bg-admin-primary px-3 py-1.5 text-sm font-semibold text-white hover:bg-blue-600">+ Add Category</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Parent</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Products</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($categories as $category)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $category->id }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if ($category->image)
                                    <img src="{{ $category->image }}" alt="" class="h-8 w-8 rounded object-cover">
                                @endif
                                <span class="font-medium text-slate-800">{{ $category->title }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $category->parent?->title ?? '—' }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $category->slug }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $category->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($category->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $category->products_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="rounded bg-admin-primary px-2 py-1 text-xs text-white">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded bg-admin-danger px-2 py-1 text-xs text-white">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-slate-500">No categories yet. <a href="{{ route('admin.categories.create') }}" class="text-admin-primary hover:underline">Add one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="border-t border-slate-200 px-4 py-3">{{ $categories->links() }}</div>
</div>
@endsection
