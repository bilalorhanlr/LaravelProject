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

        <div class="ml-auto flex items-center gap-3 sm:gap-5">
            {{-- User account dropdown --}}
            <div class="relative hidden sm:block" x-data="{ open: false }" @click.outside="open = false">
                <button type="button" @click="open = !open" class="flex items-center gap-3 rounded-xl border border-slate-100 p-2 transition hover:border-shop-orange/30 hover:shadow-sm">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-shop-surface text-shop-muted">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="text-left">
                        @auth
                            <p class="text-sm font-bold uppercase text-shop-dark">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-semibold uppercase tracking-wider text-shop-orange">Account</p>
                        @else
                            <p class="text-sm font-bold text-shop-dark">Guest</p>
                            <p class="text-[10px] font-semibold uppercase tracking-wider text-shop-muted">Login</p>
                        @endauth
                    </div>
                    <svg class="h-4 w-4 text-shop-muted" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open" x-cloak class="absolute right-0 top-full z-50 mt-2 w-56 overflow-hidden rounded-xl border border-slate-100 bg-white py-2 shadow-card">
                    <div class="h-1 bg-shop-orange"></div>
                    @auth
                        <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-shop-dark hover:bg-shop-surface hover:text-shop-orange">
                            <svg class="h-4 w-4 text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            My Account
                        </a>
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-shop-dark hover:bg-shop-surface hover:text-shop-orange">
                                <svg class="h-4 w-4 text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>
                                Admin Panel
                            </a>
                        @endif
                        <a href="{{ route('pages.wishlist') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-shop-dark hover:bg-shop-surface hover:text-shop-orange">
                            <svg class="h-4 w-4 text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            My Wishlist
                        </a>
                        <a href="{{ route('pages.compare') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-shop-dark hover:bg-shop-surface hover:text-shop-orange">
                            <svg class="h-4 w-4 text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                            Compare
                        </a>
                        <a href="{{ route('pages.checkout') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-shop-dark hover:bg-shop-surface hover:text-shop-orange">
                            <svg class="h-4 w-4 text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Checkout
                        </a>
                        <div class="my-1 border-t border-slate-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 px-4 py-2.5 text-left text-sm text-shop-dark hover:bg-shop-surface hover:text-shop-orange">
                                <svg class="h-4 w-4 text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-shop-dark hover:bg-shop-surface hover:text-shop-orange">
                            <svg class="h-4 w-4 text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-shop-dark hover:bg-shop-surface hover:text-shop-orange">
                            <svg class="h-4 w-4 text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Create an Account
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="group flex items-center gap-3 rounded-xl border border-slate-100 bg-shop-surface px-3 py-2 transition hover:border-shop-orange/30 hover:shadow-card sm:px-4 sm:py-2.5">
                <div class="relative flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-white">
                    <svg class="h-6 w-6 text-shop-dark group-hover:text-shop-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    @if ($cartCount > 0)
                        <span class="absolute -right-1.5 -top-1.5 flex h-5 w-5 items-center justify-center rounded-full bg-shop-orange text-[10px] font-bold text-white">{{ $cartCount }}</span>
                    @endif
                </div>
                <div class="hidden sm:block">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-shop-muted">My Cart:</p>
                    <p class="text-sm font-bold text-shop-dark">{{ $cartSubtotal }}</p>
                </div>
            </a>

            <button @click="mobileMenu = !mobileMenu" class="rounded-xl p-2 text-shop-dark hover:bg-slate-100 lg:hidden" type="button">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
</header>
