@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
@include('admin.partials.page-header', [
    'title' => 'Category List',
    'breadcrumb' => 'Categories',
    'description' => 'Manage product categories and hierarchy.',
])

<div class="mb-5 flex flex-wrap gap-2">
    <a href="{{ route('admin.categories.create') }}" class="admin-btn">
        <ion-icon name="add-outline"></ion-icon> Add Category
    </a>
    <a href="{{ route('admin.categories.tree') }}" class="admin-btn-outline">
        <ion-icon name="git-network-outline"></ion-icon> Category Tree
    </a>
</div>

<div class="admin-card">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Keywords</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td class="text-slate-500">#{{ $category->id }}</td>
                        <td>
                            <p class="font-semibold text-slate-800">
                                @if ($category->parent)
                                    <span class="text-xs font-normal text-slate-400">{{ $category->parent->title }} ›</span>
                                @endif
                                {{ $category->title }}
                            </p>
                        </td>
                        <td class="max-w-[140px] truncate text-slate-600">{{ $category->keywords ?? '—' }}</td>
                        <td class="max-w-[180px] truncate text-slate-600">{{ Str::limit(strip_tags($category->description ?? ''), 60) ?: '—' }}</td>
                        <td>
                            @if ($category->image)
                                <img src="{{ $category->image }}" alt="" class="h-12 w-10 rounded-lg border border-slate-100 object-cover">
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="{{ $category->status === 'active' ? 'admin-badge-success' : 'admin-badge-danger' }}">
                                {{ $category->status === 'active' ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex flex-wrap justify-end gap-1.5">
                                <a href="{{ route('admin.categories.show', $category->id) }}" class="admin-btn-ghost">Show</a>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="admin-btn-success !px-3">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
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
                            No categories yet.
                            <a href="{{ route('admin.categories.create') }}" class="font-semibold text-admin-primary hover:underline">Add one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="admin-card-footer">{{ $categories->links() }}</div>
</div>
@endsection
