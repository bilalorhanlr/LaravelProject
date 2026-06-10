@extends('admin.layouts.app')

@section('title', 'Category Tree')

@section('content')
@include('admin.partials.page-header', ['title' => 'Category Menu Tree', 'breadcrumb' => 'Home / Category Tree'])

<div class="mb-4 flex gap-2">
    <a href="{{ route('admin.categories.index') }}" class="rounded border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">← Category List</a>
    <a href="{{ route('admin.categories.create') }}" class="rounded bg-admin-primary px-4 py-2 text-sm font-semibold text-white hover:bg-blue-600">+ Add Category</a>
</div>

<div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
    @if ($roots->isEmpty())
        <p class="text-center text-slate-500">No categories yet.</p>
    @else
        <ul class="space-y-1">
            @foreach ($roots as $root)
                @include('admin.categories._tree-item', ['category' => $root, 'depth' => 0])
            @endforeach
        </ul>
    @endif
</div>
@endsection
