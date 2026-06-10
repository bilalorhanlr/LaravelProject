{{-- Product Image Gallery — main image + thumbnails (Product + ProductImage) --}}
@php
    $allImages = collect([$product->image])
        ->merge($product->images->pluck('image'))
        ->filter()
        ->unique()
        ->values();
@endphp

<div
    x-data="{
        images: {{ $allImages->toJson() }},
        active: 0,
        setImage(index) { this.active = index; }
    }"
    class="space-y-3"
>
  <div class="relative overflow-hidden rounded-3xl border border-slate-100 bg-shop-surface shadow-card">
        <img
            :src="images[active]"
            src="{{ $product->image }}"
            alt="{{ $product->name }}"
            class="aspect-square w-full object-cover transition-opacity duration-300"
        >
        @if ($allImages->count() > 1)
            <button
                type="button"
                @click="setImage(active === 0 ? images.length - 1 : active - 1)"
                class="absolute left-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-shop-dark shadow hover:bg-white"
                aria-label="Previous image"
            >‹</button>
            <button
                type="button"
                @click="setImage(active === images.length - 1 ? 0 : active + 1)"
                class="absolute right-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-shop-dark shadow hover:bg-white"
                aria-label="Next image"
            >›</button>
            <span class="absolute bottom-3 right-3 rounded-full bg-shop-dark/70 px-3 py-1 text-xs font-semibold text-white" x-text="(active + 1) + ' / ' + images.length"></span>
        @endif
    </div>

    @if ($allImages->count() > 1)
        <div class="grid grid-cols-5 gap-2 sm:grid-cols-6">
            <template x-for="(img, index) in images" :key="index">
                <button
                    type="button"
                    @click="setImage(index)"
                    class="overflow-hidden rounded-xl border-2 transition"
                    :class="active === index ? 'border-shop-orange ring-2 ring-shop-orange/30' : 'border-transparent hover:border-slate-200'"
                >
                    <img :src="img" alt="" class="aspect-square w-full object-cover">
                </button>
            </template>
        </div>
    @endif
</div>
