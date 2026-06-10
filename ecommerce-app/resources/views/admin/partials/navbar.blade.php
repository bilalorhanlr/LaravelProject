@php
    $pageTitle = trim($__env->yieldContent('title')) ?: 'Dashboard';
    $user = Auth::user();
    $displayName = $user?->name ?? 'Admin';
    $firstName = strtok($displayName, ' ');
@endphp

<header class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/90 backdrop-blur-md">
    <div class="flex h-14 items-center gap-2 px-3 sm:gap-3 sm:px-4 lg:px-6">
        <button
            @click="sidebarOpen = !sidebarOpen; sidebarMobile = !sidebarMobile"
            type="button"
            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:bg-slate-50"
            aria-label="Toggle menu"
        >
            <ion-icon name="menu-outline" class="text-lg"></ion-icon>
        </button>

        <p class="min-w-0 max-w-[7rem] truncate text-sm font-semibold text-slate-800 sm:max-w-[10rem] md:max-w-[14rem] lg:max-w-xs">
            {{ $pageTitle }}
        </p>

        <div class="ml-auto flex shrink-0 items-center gap-1.5 sm:gap-2">
            <form action="{{ route('admin.products.index') }}" method="GET" class="hidden lg:block">
                <div class="relative w-40 xl:w-52">
                    <ion-icon name="search-outline" class="absolute left-2.5 top-1/2 -translate-y-1/2 text-base text-slate-400"></ion-icon>
                    <input
                        type="search"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search..."
                        class="w-full rounded-lg border-slate-200 bg-slate-50 py-2 pl-8 pr-3 text-xs transition focus:border-admin-primary focus:bg-white focus:ring-admin-primary"
                    >
                </div>
            </form>

            <a
                href="{{ route('admin.messages.index') }}"
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:bg-slate-50"
                title="Messages"
            >
                <ion-icon name="mail-outline" class="text-lg"></ion-icon>
            </a>

            <a
                href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:bg-slate-50"
                title="Pending orders"
            >
                <ion-icon name="bag-handle-outline" class="text-lg"></ion-icon>
            </a>

            <div class="relative shrink-0" x-data="{ open: false }" @click.outside="open = false">
                <button
                    type="button"
                    @click="open = !open"
                    class="flex h-9 items-center gap-1.5 rounded-lg border border-slate-200 py-1 pl-1 pr-2 transition hover:bg-slate-50"
                    title="{{ $displayName }}"
                >
                    <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-gradient-to-br from-admin-primary to-admin-primary-dark text-[10px] font-bold text-white">
                        {{ strtoupper(substr($displayName, 0, 1)) }}
                    </div>
                    <span class="hidden max-w-[4.5rem] truncate text-xs font-semibold text-slate-700 xl:inline">{{ $firstName }}</span>
                    <ion-icon name="chevron-down-outline" class="hidden text-xs text-slate-400 xl:block" :class="open && 'rotate-180'"></ion-icon>
                </button>

                <div
                    x-show="open"
                    x-cloak
                    class="absolute right-0 top-full z-50 mt-1.5 w-48 overflow-hidden rounded-xl border border-slate-200 bg-white py-1 shadow-card"
                >
                    <div class="border-b border-slate-100 px-3 py-2.5">
                        <p class="truncate text-sm font-semibold text-slate-800">{{ $displayName }}</p>
                        @if ($user)
                            <p class="truncate text-xs text-slate-500">{{ $user->email }}</p>
                        @else
                            <p class="text-xs text-slate-500">Public admin access</p>
                        @endif
                    </div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-slate-600 hover:bg-slate-50">
                        <ion-icon name="storefront-outline" class="text-base text-admin-primary"></ion-icon>
                        Store
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-slate-600 hover:bg-slate-50">
                        <ion-icon name="settings-outline" class="text-base text-slate-400"></ion-icon>
                        Settings
                    </a>
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2 px-3 py-2 text-left text-sm text-red-600 hover:bg-red-50">
                                <ion-icon name="log-out-outline" class="text-base"></ion-icon>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-2 border-t border-slate-100 px-3 py-2 text-sm text-slate-600 hover:bg-slate-50">
                            <ion-icon name="log-in-outline" class="text-base text-slate-400"></ion-icon>
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
