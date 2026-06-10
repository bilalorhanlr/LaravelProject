@extends('layouts.shop')

@section('title', $title ?? 'Shop')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-8 lg:flex-row">
        @include('partials.shop.category-sidebar')

        <div class="min-w-0 flex-1">
            <div class="mb-8">
                <h1 class="shop-section-title">{{ $title ?? 'Shop' }}</h1>
                <p class="mt-2 text-sm text-shop-muted">{{ $products->total() }} products found</p>
            </div>

            @if ($products->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-200 py-16 text-center">
                    <p class="text-shop-muted">No products found.</p>
                    <a href="{{ route('shop') }}" class="shop-btn mt-4 inline-flex">Browse All</a>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
