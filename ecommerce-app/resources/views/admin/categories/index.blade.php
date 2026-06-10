@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
@include('admin.partials.page-header', ['title' => 'Categories', 'breadcrumb' => 'Categories'])

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Category Management</h3>
        <button type="button" class="rounded bg-admin-primary px-3 py-1.5 text-sm font-semibold text-white">+ Add Category</button>
    </div>
    <div class="p-4">
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($categories as $category)
                <div class="rounded-lg border border-slate-200 p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <h4 class="font-semibold text-slate-800">{{ $category->name }}</h4>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-xs text-slate-600">{{ $category->children->count() }} sub</span>
                    </div>
                    <ul class="mt-3 space-y-1">
                        @foreach ($category->children as $child)
                            <li class="flex items-center justify-between text-sm text-slate-600">
                                <span>○ {{ $child->name }}</span>
                                <div class="flex gap-1">
                                    <button type="button" class="text-admin-primary text-xs">Edit</button>
                                    <button type="button" class="text-admin-danger text-xs">Del</button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-3 flex gap-2 border-t border-slate-100 pt-3">
                        <button type="button" class="rounded bg-admin-primary px-2 py-1 text-xs text-white">Edit</button>
                        <button type="button" class="rounded border border-slate-300 px-2 py-1 text-xs text-slate-600">View Products</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="border-t border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-500">Footer</div>
</div>
@endsection
