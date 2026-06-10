{{-- Hardcoded dynamic slider (config/shop.php) — auto-play + manual nav --}}
<div
    x-data="{
        slide: 0,
        slides: {{ count($sliderSlides) }},
        timer: null,
        start() {
            this.timer = setInterval(() => {
                this.slide = this.slide === this.slides - 1 ? 0 : this.slide + 1;
            }, 5000);
        },
        stop() { clearInterval(this.timer); },
        go(n) { this.slide = n; this.stop(); this.start(); }
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
    class="relative overflow-hidden rounded-3xl bg-shop-dark shadow-card"
>
    <div class="relative aspect-[16/7] min-h-[280px] sm:min-h-[360px]">
        @foreach ($sliderSlides as $index => $slide)
            <div
                x-show="slide === {{ $index }}"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0"
                @if ($index > 0) x-cloak @endif
            >
                <img
                    src="{{ asset($slide['image']) }}"
                    alt="{{ $slide['title'] }}"
                    class="h-full w-full object-cover"
                >
                <div class="absolute inset-0 bg-gradient-to-r from-shop-dark/90 via-shop-dark/50 to-transparent"></div>
                <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-14">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-shop-orange">{{ $slide['eyebrow'] }}</p>
                    <h2 class="mt-2 max-w-lg text-3xl font-extrabold text-white md:text-5xl">{{ $slide['title'] }}</h2>
                    @if (!empty($slide['subtitle']))
                        <p class="mt-2 max-w-md text-sm text-white/80 md:text-base">{{ $slide['subtitle'] }}</p>
                    @endif
                    <a href="{{ url($slide['link']) }}" class="shop-btn mt-6 w-fit">{{ $slide['link_text'] ?? 'Shop Now' }}</a>
                </div>
            </div>
        @endforeach
    </div>

    <button @click="go(slide === 0 ? slides - 1 : slide - 1)" type="button" class="absolute left-4 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/20 text-2xl text-white backdrop-blur hover:bg-white/30" aria-label="Previous slide">‹</button>
    <button @click="go(slide === slides - 1 ? 0 : slide + 1)" type="button" class="absolute right-4 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/20 text-2xl text-white backdrop-blur hover:bg-white/30" aria-label="Next slide">›</button>

    <div class="absolute bottom-4 left-1/2 z-10 flex -translate-x-1/2 gap-2">
        @foreach ($sliderSlides as $index => $slide)
            <button
                @click="go({{ $index }})"
                type="button"
                class="h-2 rounded-full transition-all"
                :class="slide === {{ $index }} ? 'w-8 bg-shop-orange' : 'w-2 bg-white/50'"
                aria-label="Go to slide {{ $index + 1 }}"
            ></button>
        @endforeach
    </div>
</div>
