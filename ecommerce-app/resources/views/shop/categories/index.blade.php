@extends('layouts.shop')

@section('title', 'All Categories')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <nav class="mb-6 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <span class="font-medium text-shop-dark">Categories</span>
    </nav>

    <h1 class="shop-section-title">Shop by Category</h1>
    <p class="mt-2 text-shop-muted">Browse our full collection organized by category.</p>

    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($categories as $category)
            <a href="{{ route('categories.show', $category) }}" class="group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card transition hover:-translate-y-1 hover:shadow-card-hover">
                <div class="bg-gradient-to-br from-shop-orange/10 to-shop-surface p-6">
                    <h2 class="text-xl font-bold text-shop-dark group-hover:text-shop-orange">{{ $category->name }}</h2>
                    <p class="mt-1 text-sm text-shop-muted">{{ $category->children->count() }} subcategories</p>
                </div>
                <ul class="divide-y divide-slate-50 p-4">
                    @foreach ($category->children->take(4) as $child)
                        <li>
                            <span class="block py-2 text-sm text-shop-muted transition group-hover:text-shop-dark">{{ $child->name }}</span>
                        </li>
                    @endforeach
                    @if ($category->children->count() > 4)
                        <li class="pt-2 text-xs font-semibold text-shop-orange">+{{ $category->children->count() - 4 }} more</li>
                    @endif
                </ul>
                <div class="border-t border-slate-50 px-4 py-3 text-sm font-semibold text-shop-orange">Shop Now →</div>
            </a>
        @endforeach
    </div>
</div>
@endsection
