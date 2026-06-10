<header class="border-b border-slate-100 bg-white">
    <div class="mx-auto flex max-w-7xl flex-wrap items-center gap-4 px-4 py-5 sm:px-6 lg:gap-8 lg:px-8">
        <a href="{{ route('home') }}" class="shrink-0 text-2xl font-extrabold tracking-tight lg:text-3xl">
            <span class="text-shop-orange">E-</span><span class="text-shop-dark">SHOP</span>
        </a>

        <form action="{{ route('shop') }}" method="GET" class="order-3 flex w-full flex-1 items-stretch overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:order-none lg:max-w-xl">
            <select name="category" class="hidden border-0 bg-slate-50 px-3 text-sm font-medium text-shop-dark focus:ring-0 sm:block sm:max-w-[140px]">
                <option value="">All Categories</option>
                @foreach ($navCategories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <input
                type="search"
                name="q"
                value="{{ request('q') }}"
                placeholder="Search products, brands..."
                class="min-w-0 flex-1 border-0 px-4 py-3 text-sm focus:ring-0"
            >
            <button type="submit" class="bg-shop-orange px-5 text-white transition hover:bg-shop-orange-dark">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
        </form>

        <div class="ml-auto flex items-center gap-4 sm:gap-6">
            <div class="hidden text-right sm:block">
                <p class="text-[10px] font-bold uppercase tracking-widest text-shop-muted">My Account</p>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-shop-dark hover:text-shop-orange">Dashboard</a>
                @else
                    <div class="text-sm font-semibold">
                        <a href="{{ route('login') }}" class="hover:text-shop-orange">Login</a>
                        <span class="text-shop-muted"> / </span>
                        <a href="{{ route('register') }}" class="hover:text-shop-orange">Join</a>
                    </div>
                @endauth
            </div>

            <a href="{{ route('cart.index') }}" class="group flex items-center gap-3 rounded-2xl border border-slate-100 bg-shop-surface px-4 py-2.5 transition hover:border-shop-orange/30 hover:shadow-card">
                <div class="relative">
                    <svg class="h-6 w-6 text-shop-dark group-hover:text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    @if ($cartCount > 0)
                        <span class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-shop-orange text-[10px] font-bold text-white">{{ $cartCount }}</span>
                    @endif
                </div>
                <div class="hidden sm:block">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-shop-muted">My Cart</p>
                    <p class="text-sm font-bold text-shop-dark">{{ $cartSubtotal }}</p>
                </div>
            </a>

            <button @click="mobileMenu = !mobileMenu" class="rounded-xl p-2 text-shop-dark hover:bg-slate-100 lg:hidden" type="button">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
</header>
