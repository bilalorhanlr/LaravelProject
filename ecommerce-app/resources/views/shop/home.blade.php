@extends('layouts.shop')

@section('title', 'Home')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-8 lg:flex-row">
        @include('partials.shop.category-sidebar')

        <div class="min-w-0 flex-1 space-y-10">
            {{-- Dynamic Slider (config/shop.php + public/images/slider) --}}
            @include('partials.shop.home-slider', ['sliderSlides' => $sliderSlides])

            {{-- Top category promo banners (from DB) --}}
            @if ($rootCategories->isNotEmpty())
                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach ($rootCategories->take(3) as $category)
                        @php
                            $bannerImage = $category->image
                                ?? config("shop.category_images.{$category->slug}")
                                ?? asset('images/slider/slide-'.($loop->iteration).'.jpg');
                        @endphp
                        <a href="{{ route('categories.show', $category) }}" class="group relative overflow-hidden rounded-2xl shadow-card">
                            <img src="{{ $bannerImage }}" alt="{{ $category->title }}" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-shop-dark/80 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <p class="text-xs font-semibold uppercase tracking-wider text-shop-orange">Shop Now</p>
                                <p class="text-lg font-bold">{{ $category->title }}</p>
                                @if ($category->children->isNotEmpty())
                                    <p class="mt-1 text-xs text-white/70">{{ $category->children->pluck('title')->take(3)->join(' · ') }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Category & SubCategory grid --}}
    @include('partials.shop.category-subcategory-grid', ['rootCategories' => $rootCategories])

    {{-- Featured Products --}}
    @if ($featuredProducts->isNotEmpty())
        <section class="mt-14">
            <div class="mb-8 flex items-end justify-between">
                <h2 class="shop-section-title">Featured Products</h2>
                <a href="{{ route('shop') }}" class="text-sm font-semibold text-shop-orange hover:underline">View All →</a>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- Deals of the day --}}
    @if ($dealProducts->isNotEmpty())
        <section class="mt-14 rounded-3xl bg-gradient-to-br from-shop-orange/10 via-white to-shop-surface p-8">
            <div class="mb-8 flex items-end justify-between">
                <h2 class="shop-section-title">Deals of the Day</h2>
                <a href="{{ route('sales') }}" class="shop-btn text-xs">Shop Sales</a>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($dealProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- All Products on Home Page --}}
    <section class="mt-14">
        <div class="mb-8 flex items-end justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-shop-orange">Our Store</p>
                <h2 class="shop-section-title mt-1">Products</h2>
            </div>
            <a href="{{ route('shop') }}" class="text-sm font-semibold text-shop-orange hover:underline">View All →</a>
        </div>

        @if ($homeProducts->isNotEmpty())
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($homeProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-slate-200 bg-shop-surface/50 px-6 py-16 text-center">
                <p class="text-shop-muted">No products yet. Add products from the admin panel.</p>
                <a href="{{ route('shop') }}" class="mt-4 inline-block text-sm font-semibold text-shop-orange hover:underline">Browse shop →</a>
            </div>
        @endif
    </section>

    {{-- Latest arrivals --}}
    @if ($latestProducts->count() > 4)
        <section class="mt-14">
            <div class="mb-8 flex items-end justify-between">
                <h2 class="shop-section-title">Latest Arrivals</h2>
                <a href="{{ route('shop') }}" class="text-sm font-semibold text-shop-orange hover:underline">View All →</a>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($latestProducts->take(4) as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
