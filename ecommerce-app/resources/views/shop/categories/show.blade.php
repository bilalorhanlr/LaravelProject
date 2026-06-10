@extends('layouts.shop')

@section('title', $category->name)

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-8 lg:flex-row">
        @include('partials.shop.category-sidebar')

        <div class="min-w-0 flex-1">
            <nav class="mb-6 flex flex-wrap items-center gap-2 text-sm text-shop-muted">
                <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
                <span>/</span>
                <a href="{{ route('categories.index') }}" class="hover:text-shop-orange">Categories</a>
                @if ($category->parent)
                    <span>/</span>
                    <a href="{{ route('categories.show', $category->parent) }}" class="hover:text-shop-orange">{{ $category->parent->name }}</a>
                @endif
                <span>/</span>
                <span class="font-medium text-shop-dark">{{ $category->name }}</span>
            </nav>

            <div class="mb-8">
                <h1 class="shop-section-title">{{ $category->name }}</h1>
                @if ($category->children->isNotEmpty())
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($category->children as $child)
                            <a href="{{ route('categories.show', $child) }}" class="rounded-full border border-slate-200 px-4 py-1.5 text-sm font-medium text-shop-muted transition hover:border-shop-orange hover:text-shop-orange">
                                {{ $child->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @forelse ($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-full rounded-2xl border border-dashed border-slate-200 py-16 text-center text-shop-muted">
                        No products in this category yet.
                    </div>
                @endforelse
            </div>

            <div class="mt-10">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection
