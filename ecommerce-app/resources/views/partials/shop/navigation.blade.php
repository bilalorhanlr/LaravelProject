@php
    $womenCategory = $navCategories->firstWhere('slug', 'womens-clothing');
    $menCategory = $navCategories->firstWhere('slug', 'mens-clothing');
@endphp

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

            @if ($womenCategory)
                <div x-data="{ open: false }" class="relative">
                    <a
                        href="{{ route('categories.show', $womenCategory) }}"
                        @mouseenter="open = true"
                        @mouseleave="open = false"
                        class="flex items-center gap-1 px-4 py-4 text-sm font-semibold uppercase tracking-wide transition hover:bg-white/10 {{ request()->is('category/womens-clothing*') ? 'text-shop-orange' : '' }}"
                    >
                        Women
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                    <div x-show="open" x-cloak @mouseenter="open = true" @mouseleave="open = false" class="absolute left-0 top-full z-50 min-w-[220px] rounded-b-xl bg-white py-2 text-shop-dark shadow-card">
                        <a href="{{ route('categories.show', $womenCategory) }}" class="block border-b border-slate-100 px-4 py-2 text-sm font-semibold text-shop-orange hover:bg-shop-surface">All Women's</a>
                        @foreach ($womenCategory->children as $child)
                            <a href="{{ route('categories.show', $child) }}" class="block px-4 py-2 text-sm hover:bg-shop-surface hover:text-shop-orange">{{ $child->name }}</a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($menCategory)
                <div x-data="{ open: false }" class="relative">
                    <a
                        href="{{ route('categories.show', $menCategory) }}"
                        @mouseenter="open = true"
                        @mouseleave="open = false"
                        class="flex items-center gap-1 px-4 py-4 text-sm font-semibold uppercase tracking-wide transition hover:bg-white/10 {{ request()->is('category/mens-clothing*') ? 'text-shop-orange' : '' }}"
                    >
                        Men
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                    <div x-show="open" x-cloak @mouseenter="open = true" @mouseleave="open = false" class="absolute left-0 top-full z-50 min-w-[220px] rounded-b-xl bg-white py-2 text-shop-dark shadow-card">
                        <a href="{{ route('categories.show', $menCategory) }}" class="block border-b border-slate-100 px-4 py-2 text-sm font-semibold text-shop-orange hover:bg-shop-surface">All Men's</a>
                        @foreach ($menCategory->children as $child)
                            <a href="{{ route('categories.show', $child) }}" class="block px-4 py-2 text-sm hover:bg-shop-surface hover:text-shop-orange">{{ $child->name }}</a>
                        @endforeach
                    </div>
                </div>
            @endif

            <a href="{{ route('sales') }}" class="px-4 py-4 text-sm font-semibold uppercase tracking-wide transition hover:bg-white/10 {{ request()->routeIs('sales') ? 'text-shop-orange' : '' }}">Sales</a>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-1 px-4 py-4 text-sm font-semibold uppercase tracking-wide transition hover:bg-white/10" type="button">
                    Pages
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" @click.outside="open = false" x-cloak class="absolute left-0 top-full z-50 min-w-[200px] rounded-b-xl bg-white py-2 text-shop-dark shadow-card">
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">All Categories</a>
                    <a href="{{ route('pages.about') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">About Us</a>
                    <a href="{{ route('pages.shipping') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">Shipping & Returns</a>
                    <a href="{{ route('pages.faq') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">FAQ</a>
                    <a href="{{ route('pages.wishlist') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">Wishlist</a>
                    <a href="{{ route('pages.compare') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">Compare</a>
                    <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-sm hover:bg-shop-surface">Shopping Cart</a>
                </div>
            </div>
        </div>
    </div>

    <div x-show="mobileMenu" x-cloak class="border-t border-white/10 lg:hidden">
        <div class="space-y-1 px-4 py-3">
            <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Home</a>
            <a href="{{ route('shop') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Shop</a>
            <a href="{{ route('categories.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Categories</a>
            <a href="{{ route('sales') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Sales</a>
            <a href="{{ route('cart.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold hover:bg-white/10">Cart ({{ $cartCount }})</a>
            @foreach ($navCategories as $category)
                <a href="{{ route('categories.show', $category) }}" class="block rounded-lg px-3 py-2 text-sm hover:bg-white/10">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</nav>
