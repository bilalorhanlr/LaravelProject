<header class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/90 backdrop-blur-md">
    <div class="flex h-16 items-center gap-4 px-4 lg:px-8">
        <button
            @click="sidebarOpen = !sidebarOpen; sidebarMobile = !sidebarMobile"
            type="button"
            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-600 transition hover:border-slate-300 hover:bg-slate-50"
        >
            <ion-icon name="menu-outline" class="text-xl"></ion-icon>
        </button>

        <div class="hidden min-w-0 flex-1 sm:block">
            <p class="truncate text-sm font-semibold text-slate-800">@yield('title', 'Dashboard')</p>
            <p class="truncate text-xs text-slate-500">Welcome back, {{ Auth::user()->name }}</p>
        </div>

        <form action="{{ route('admin.products.index') }}" method="GET" class="ml-auto hidden max-w-sm flex-1 md:block">
            <div class="relative">
                <ion-icon name="search-outline" class="absolute left-3 top-1/2 -translate-y-1/2 text-lg text-slate-400"></ion-icon>
                <input
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search products..."
                    class="w-full rounded-xl border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm transition focus:border-admin-primary focus:bg-white focus:ring-admin-primary"
                >
            </div>
        </form>

        <div class="flex items-center gap-2">
            <a
                href="{{ route('admin.messages.index') }}"
                class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-600 transition hover:border-slate-300 hover:bg-slate-50"
                title="Messages"
            >
                <ion-icon name="mail-outline" class="text-xl"></ion-icon>
            </a>

            <a
                href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
                class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-600 transition hover:border-slate-300 hover:bg-slate-50"
                title="Pending Orders"
            >
                <ion-icon name="bag-handle-outline" class="text-xl"></ion-icon>
            </a>

            <div class="relative ml-1" x-data="{ open: false }" @click.outside="open = false">
                <button
                    type="button"
                    @click="open = !open"
                    class="flex items-center gap-2 rounded-xl border border-slate-200 py-1.5 pl-1.5 pr-3 transition hover:border-slate-300 hover:bg-slate-50"
                >
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-admin-primary to-admin-primary-dark text-xs font-bold text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden text-sm font-semibold text-slate-700 lg:block">{{ Auth::user()->name }}</span>
                    <ion-icon name="chevron-down-outline" class="hidden text-sm text-slate-400 lg:block" :class="open && 'rotate-180'"></ion-icon>
                </button>

                <div
                    x-show="open"
                    x-cloak
                    class="absolute right-0 top-full z-50 mt-2 w-52 overflow-hidden rounded-xl border border-slate-200 bg-white py-1 shadow-card"
                >
                    <div class="border-b border-slate-100 px-4 py-3">
                        <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                        <p class="truncate text-xs text-slate-500">{{ Auth::user()->email }}</p>
                    </div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50">
                        <ion-icon name="storefront-outline" class="text-lg text-admin-primary"></ion-icon>
                        Storefront
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50">
                        <ion-icon name="settings-outline" class="text-lg text-slate-400"></ion-icon>
                        Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2 px-4 py-2.5 text-left text-sm text-red-600 hover:bg-red-50">
                            <ion-icon name="log-out-outline" class="text-lg"></ion-icon>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
