<nav class="bg-shop-dark text-white shadow-lg">
    <div class="mx-auto flex max-w-7xl items-stretch px-4 sm:px-6 lg:px-8">
        <a
            href="{{ route('categories.index') }}"
            class="flex items-center gap-2 bg-shop-orange px-5 py-4 text-sm font-bold uppercase tracking-wide transition hover:bg-shop-orange-dark"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            Categories
        </a>

        <div class="hidden flex-1 items-center gap-1 lg:flex">
            <a href="{{ route('home') }}" class="px-4 py-4 text-sm font-semibold uppercase tracking-wide transition hover:bg-white/10 {{ request()->routeIs('home') ? 'text-shop-orange' : '' }}">Home</a>
            <a href="{{ route('shop') }}" class="px-4 py-4 text-sm font-semibold uppercase tracking-wide transition hover:bg-white/10 {{ request()->routeIs('shop') ? 'text-shop-orange' : '' }}">Shop</a>

            @foreach ($navCategories->take(5) as $navCategory)
                <div x-data="{ open: false }" class="relative">
                    <a
                        href="{{ route('categories.show', $navCategory) }}"
                        @mouseenter="open = true"
                        @mouseleave="open = false"
                        class="flex items-center gap-1 px-4 py-4 text-sm font-semibold uppercase tracking-wide transition hover:bg-white/10 {{ request()->is('category/'.$navCategory->slug) || request()->is('category/'.$navCategory->slug.'/*') ? 'text-shop-orange' : '' }}"
                    >
                        {{ Str::limit($navCategory->title, 12) }}
                        @if ($navCategory->children->isNotEmpty())
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        @endif
                    </a>
                    @if ($navCategory->children->isNotEmpty())
                        <div x-show="open" x-cloak @mouseenter="open = true" @mouseleave="open = false" class="absolute left-0 top-full z-50 min-w-[240px] rounded-b-xl bg-white py-2 text-shop-dark shadow-card">
                            <a href="{{ route('categories.show', $navCategory) }}" class="block border-b border-slate-100 px-4 py-2 text-sm font-semibold text-shop-orange hover:bg-shop-surface">
                                All {{ $navCategory->title }}
                            </a>
                            @foreach ($navCategory->children as $child)
                                <a href="{{ route('categories.show', $child) }}" class="block px-4 py-2 text-sm hover:bg-shop-surface hover:text-shop-orange">{{ $child->title }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

            <a href="{{ route('sales') }}" class="px-4 py-4 text-sm font-semibold uppercase tracking-wide transition hover:bg-white/10 {{ request()->routeIs('sales') ? 'text-shop-orange' : '' }}">Sales</a>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-1 px-4 py-4 text-sm font-semibold uppercase tracking-wide transition hover:bg-white/10" type="button">
                    Pages
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" @click.outside="open = false" x-cloak class="absolute left-0 top-full z-50 min-w-[200px] rounded-b-xl bg-white py-2 text-shop-dark shadow-card">
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">All Categories</a>
                    <a href="{{ route('pages.about') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">About Us</a>
                    <a href="{{ route('pages.contact') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">Contact Us</a>
                    <a href="{{ route('pages.shipping') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">Shipping & Returns</a>
                    <a href="{{ route('pages.faq') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">FAQ</a>
                    <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">Shopping Cart</a>
                </div>
            </div>
        </div>
    </div>

    <div x-show="mobileMenu" x-cloak class="border-t border-white/10 lg:hidden">
        <div class="space-y-1 px-4 py-3">
            <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Home</a>
            <a href="{{ route('shop') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Shop</a>
            <a href="{{ route('pages.contact') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Contact Us</a>
            <a href="{{ route('sales') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Sales</a>
            <a href="{{ route('cart.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Cart ({{ $cartCount }})</a>
            @foreach ($navCategories as $category)
                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" type="button" class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">
                        <a href="{{ route('categories.show', $category) }}" @click.stop>{{ $category->name }}</a>
                        @if ($category->children->isNotEmpty())
                            <svg class="h-4 w-4 transition" :class="subOpen && 'rotate-90'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        @endif
                    </button>
                    @if ($category->children->isNotEmpty())
                        <div x-show="subOpen" x-cloak class="ml-4 border-l border-white/10 pl-3">
                            @foreach ($category->children as $child)
                                <a href="{{ route('categories.show', $child) }}" class="block rounded-lg px-3 py-1.5 text-xs hover:bg-white/10">{{ $child->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</nav>
