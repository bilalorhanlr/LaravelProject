@extends('layouts.shop')

@section('title', 'Home')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-8 lg:flex-row">
        @include('partials.shop.category-sidebar')

        <div class="min-w-0 flex-1 space-y-10">
            {{-- Hero Slider --}}
            <div x-data="{ slide: 0, slides: 3 }" class="relative overflow-hidden rounded-3xl bg-shop-dark shadow-card">
                <div class="relative aspect-[16/7] min-h-[280px] sm:min-h-[360px]">
                    <template x-for="i in slides" :key="i">
                        <div
                            x-show="slide === i - 1"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 scale-105"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute inset-0"
                        >
                            <img
                                :src="[
                                    'https://images.unsplash.com/photo-1492707892479-7bc8c5c4cb43?w=1200&h=500&fit=crop',
                                    'https://images.unsplash.com/photo-1548036328-c9fa89d6e08d?w=1200&h=500&fit=crop',
                                    'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=1200&h=500&fit=crop'
                                ][i-1]"
                                alt="Banner"
                                class="h-full w-full object-cover opacity-60"
                            >
                            <div class="absolute inset-0 bg-gradient-to-r from-shop-dark via-shop-dark/70 to-transparent"></div>
                            <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-14">
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-shop-orange" x-text="['Summer Collection', 'Bags Sale', 'New Arrivals'][i-1]"></p>
                                <h2 class="mt-2 max-w-md text-3xl font-extrabold text-white md:text-5xl" x-text="['Up to 40% Off Fashion', 'Up to 50% Discount', 'Premium Watches'][i-1]"></h2>
                                <a href="{{ route('shop') }}" class="shop-btn mt-6 w-fit">Shop Now</a>
                            </div>
                        </div>
                    </template>
                </div>
                <button @click="slide = slide === 0 ? slides - 1 : slide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 rounded-full bg-white/20 p-2 text-white backdrop-blur hover:bg-white/30" type="button">‹</button>
                <button @click="slide = slide === slides - 1 ? 0 : slide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 rounded-full bg-white/20 p-2 text-white backdrop-blur hover:bg-white/30" type="button">›</button>
                <div class="absolute bottom-4 right-6 flex gap-2">
                    <template x-for="i in slides" :key="'dot-'+i">
                        <button @click="slide = i - 1" class="h-2 rounded-full transition-all" :class="slide === i - 1 ? 'w-8 bg-shop-orange' : 'w-2 bg-white/50'" type="button"></button>
                    </template>
                </div>
            </div>

            {{-- Promo banners --}}
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ([
                    ['title' => 'Women', 'subtitle' => 'New Season', 'image' => 'https://images.unsplash.com/photo-1483985988350-763728e1935b?w=400&h=300&fit=crop', 'link' => route('categories.show', 'womens-clothing')],
                    ['title' => 'Electronics', 'subtitle' => 'Best Deals', 'image' => 'https://images.unsplash.com/photo-1468495244123-6c6c332eeece?w=400&h=300&fit=crop', 'link' => route('categories.show', 'consumer-electronics')],
                    ['title' => 'Accessories', 'subtitle' => 'Trending Now', 'image' => 'https://images.unsplash.com/photo-1523779105320-d1cd346ff292?w=400&h=300&fit=crop', 'link' => route('categories.show', 'jewelry-watches')],
                ] as $banner)
                    <a href="{{ $banner['link'] }}" class="group relative overflow-hidden rounded-2xl shadow-card">
                        <img src="{{ $banner['image'] }}" alt="{{ $banner['title'] }}" class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-shop-dark/80 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="text-xs font-semibold uppercase tracking-wider text-shop-orange">{{ $banner['subtitle'] }}</p>
                            <p class="text-lg font-bold">{{ $banner['title'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Featured --}}
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

    {{-- Latest products --}}
    <section class="mt-14">
        <div class="mb-8 flex items-end justify-between">
            <h2 class="shop-section-title">Latest Products</h2>
            <a href="{{ route('shop') }}" class="text-sm font-semibold text-shop-orange hover:underline">View All →</a>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($latestProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>
</div>
@endsection
