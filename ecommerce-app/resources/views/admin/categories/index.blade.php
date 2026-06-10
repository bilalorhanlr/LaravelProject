@extends('admin.layouts.app')

@section('title', 'Category List')

@section('content')
@include('admin.partials.page-header', ['title' => 'Category List', 'breadcrumb' => 'Home / Category List'])

<div class="mb-4">
    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 rounded bg-admin-primary px-4 py-2 text-sm font-semibold text-white hover:bg-blue-600">
        <ion-icon name="add-outline"></ion-icon> Add Category
    </a>
    <a href="{{ route('admin.categories.tree') }}" class="ml-2 inline-flex items-center gap-2 rounded border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">
        <ion-icon name="git-network-outline"></ion-icon> Category Tree
    </a>
</div>

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">Id</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Keywords</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3">Image</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Edit</th>
                    <th class="px-4 py-3">Delete</th>
                    <th class="px-4 py-3">Show</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($categories as $category)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $category->id }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">
                            @if ($category->parent)
                                <span class="text-xs text-slate-400">{{ $category->parent->title }} ›</span>
                            @endif
                            {{ $category->title }}
                        </td>
                        <td class="max-w-[140px] truncate px-4 py-3 text-slate-600">{{ $category->keywords ?? '—' }}</td>
                        <td class="max-w-[180px] truncate px-4 py-3 text-slate-600">{{ Str::limit(strip_tags($category->description ?? ''), 60) ?: '—' }}</td>
                        <td class="px-4 py-3">
                            @if ($category->image)
                                <img src="{{ $category->image }}" alt="" class="h-12 w-10 rounded border object-cover">
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-semibold {{ $category->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $category->status === 'active' ? 'True' : 'False' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="inline-block rounded bg-admin-primary px-3 py-1 text-xs font-semibold text-white hover:bg-blue-600">Edit</a>
                        </td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded bg-admin-danger px-3 py-1 text-xs font-semibold text-white hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.categories.show', $category->id) }}" class="inline-block rounded bg-green-600 px-3 py-1 text-xs font-semibold text-white hover:bg-green-700">Show</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-10 text-center text-slate-500">No categories yet. <a href="{{ route('admin.categories.create') }}" class="text-admin-primary hover:underline">Add one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="border-t border-slate-200 px-4 py-3">{{ $categories->links() }}</div>
</div>
@endsection
