@extends('layouts.shop')

@section('title', $product->name)

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    {{-- Breadcrumb --}}
    <nav class="mb-8 flex flex-wrap items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        @if ($product->category)
            <a href="{{ route('categories.show', $product->category) }}" class="hover:text-shop-orange">{{ $product->category->name }}</a>
            <span>/</span>
        @endif
        <span class="font-medium text-shop-dark">{{ $product->name }}</span>
    </nav>

    <div class="grid gap-10 lg:grid-cols-2" x-data="{ mainImage: '{{ $product->image }}', selectedSize: '{{ $product->sizes[0] ?? 'M' }}', selectedColor: '{{ $product->colors[0] ?? '#3B82F6' }}', qty: 1 }">
        {{-- Image Gallery --}}
        <div>
            <div class="overflow-hidden rounded-3xl border border-slate-100 bg-shop-surface shadow-card">
                <img :src="mainImage" src="{{ $product->image }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
            </div>
            @if ($product->images->isNotEmpty())
                <div class="mt-3 grid grid-cols-5 gap-2">
                    <button type="button" @click="mainImage = '{{ $product->image }}'" class="overflow-hidden rounded-lg border-2 border-transparent hover:border-shop-orange focus:border-shop-orange">
                        <img src="{{ $product->image }}" alt="" class="aspect-square w-full object-cover">
                    </button>
                    @foreach ($product->images as $galleryImage)
                        <button type="button" @click="mainImage = '{{ $galleryImage->image }}'" class="overflow-hidden rounded-lg border-2 border-transparent hover:border-shop-orange focus:border-shop-orange">
                            <img src="{{ $galleryImage->image }}" alt="" class="aspect-square w-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Details --}}
        <div>
            <div class="flex flex-wrap gap-2">
                @if ($product->is_new)
                    <span class="rounded-lg bg-shop-dark px-3 py-1 text-xs font-bold uppercase text-white">New</span>
                @endif
                @if ($product->discount_percent)
                    <span class="rounded-lg bg-shop-orange px-3 py-1 text-xs font-bold text-white">-{{ $product->discount_percent }}%</span>
                @endif
            </div>

            <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-shop-dark md:text-4xl">{{ $product->name }}</h1>

            <div class="mt-4 flex flex-wrap items-center gap-4">
                <div class="flex items-baseline gap-3">
                    <span class="text-3xl font-bold text-shop-dark">{{ $product->formattedPrice() }}</span>
                    @if ($product->isOnSale())
                        <span class="text-xl text-shop-orange line-through">{{ $product->formattedOriginalPrice() }}</span>
                    @endif
                </div>
                <x-star-rating :rating="$product->rating" size="lg" />
                <a href="#" class="text-sm text-shop-muted hover:text-shop-orange">{{ $product->review_count }} Review(s) / Add Review</a>
            </div>

            <div class="mt-6 flex flex-wrap gap-6 text-sm">
                <p><span class="font-semibold text-shop-dark">Availability:</span> <span class="{{ $product->stock > 0 ? 'text-emerald-600' : 'text-red-500' }}">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span></p>
                <p><span class="font-semibold text-shop-dark">Brand:</span> {{ $product->brand }}</p>
            </div>

            @if ($product->description)
                <div class="prose prose-sm mt-6 max-w-none text-shop-muted">{!! $product->description !!}</div>
            @endif
            @if ($product->detail)
                <div class="prose prose-sm mt-4 max-w-none text-shop-muted">{!! $product->detail !!}</div>
            @endif

            @if ($product->sizes)
                <div class="mt-8">
                    <p class="mb-3 text-xs font-bold uppercase tracking-widest text-shop-dark">Size</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($product->sizes as $size)
                            <button
                                type="button"
                                @click="selectedSize = '{{ $size }}'"
                                :class="selectedSize === '{{ $size }}' ? 'border-shop-orange bg-shop-orange/10 text-shop-orange' : 'border-slate-200 text-shop-muted hover:border-shop-orange'"
                                class="rounded-xl border-2 px-4 py-2 text-sm font-semibold transition"
                            >{{ $size }}</button>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($product->colors)
                <div class="mt-6">
                    <p class="mb-3 text-xs font-bold uppercase tracking-widest text-shop-dark">Color</p>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($product->colors as $color)
                            <button
                                type="button"
                                @click="selectedColor = '{{ $color }}'"
                                :class="selectedColor === '{{ $color }}' ? 'ring-2 ring-shop-orange ring-offset-2' : ''"
                                class="h-9 w-9 rounded-xl border border-slate-200 transition"
                                style="background-color: {{ $color }}"
                                title="Color option"
                            ></button>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('cart.store') }}" method="POST" class="mt-8">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="size" x-model="selectedSize">
                <input type="hidden" name="color" x-model="selectedColor">

                <div class="flex flex-wrap items-end gap-4">
                    <div>
                        <p class="mb-2 text-xs font-bold uppercase tracking-widest text-shop-dark">Qty</p>
                        <div class="flex items-center overflow-hidden rounded-xl border border-slate-200">
                            <button @click="qty = Math.max(1, qty - 1)" type="button" class="px-4 py-3 hover:bg-shop-surface">−</button>
                            <input x-model="qty" name="quantity" type="number" min="1" max="99" class="w-14 border-0 text-center text-sm font-semibold focus:ring-0">
                            <button @click="qty++" type="button" class="px-4 py-3 hover:bg-shop-surface">+</button>
                        </div>
                    </div>
                    <div class="flex flex-1 flex-wrap gap-3">
                        <button type="submit" class="shop-btn flex-1 sm:flex-none">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            Add to Cart
                        </button>
                        <a href="{{ route('pages.wishlist') }}" class="shop-btn-outline p-3" title="Wishlist">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </a>
                        <a href="{{ route('pages.compare') }}" class="shop-btn-outline p-3" title="Compare">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($relatedProducts->isNotEmpty())
        <section class="mt-16">
            <h2 class="shop-section-title mb-8">Related Products</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
