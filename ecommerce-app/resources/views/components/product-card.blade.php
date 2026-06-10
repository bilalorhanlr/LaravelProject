@props(['product'])

<article class="group relative flex flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card transition hover:-translate-y-1 hover:shadow-card-hover">
    <div class="relative aspect-square overflow-hidden bg-shop-surface">
        @if ($product->is_new)
            <span class="absolute left-3 top-3 z-10 rounded-lg bg-shop-dark px-2.5 py-1 text-[10px] font-bold uppercase text-white">New</span>
        @endif
        @if ($product->discount_percent)
            <span class="absolute left-3 {{ $product->is_new ? 'top-10' : 'top-3' }} z-10 rounded-lg bg-shop-orange px-2.5 py-1 text-[10px] font-bold text-white">-{{ $product->discount_percent }}%</span>
        @endif

        <a href="{{ route('products.show', $product) }}">
            <img
                src="{{ $product->image }}"
                alt="{{ $product->name }}"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                loading="lazy"
            >
        </a>

        <div class="absolute inset-x-3 bottom-3 flex translate-y-4 gap-2 opacity-0 transition group-hover:translate-y-0 group-hover:opacity-100">
            <form action="{{ route('cart.store') }}" method="POST" class="flex-1" @click.stop>
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="shop-btn w-full py-2.5 text-xs">Add to Cart</button>
            </form>
            <a href="{{ route('pages.wishlist') }}" class="shop-btn-outline p-2.5" title="Wishlist">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </a>
            <a href="{{ route('pages.compare') }}" class="shop-btn-outline p-2.5" title="Compare">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12M8 12h12M8 17h12M4 7h.01M4 12h.01M4 17h.01"/></svg>
            </a>
        </div>
    </div>

    <div class="flex flex-1 flex-col p-4">
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-baseline gap-2">
                <span class="text-lg font-bold text-shop-dark">{{ $product->formattedPrice() }}</span>
                @if ($product->isOnSale())
                    <span class="text-sm text-shop-orange line-through">{{ $product->formattedOriginalPrice() }}</span>
                @endif
            </div>
            <x-star-rating :rating="$product->rating" :count="$product->review_count" />
        </div>
        <a href="{{ route('products.show', $product) }}" class="mt-2 text-sm font-medium text-shop-muted transition hover:text-shop-orange">
            {{ $product->name }}
        </a>
        <a href="{{ route('cart.quick-add', $product) }}" class="mt-2 inline-flex items-center gap-1 text-xs font-semibold text-shop-orange hover:underline" @click.stop>
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add to Cart
        </a>
    </div>
</article>
