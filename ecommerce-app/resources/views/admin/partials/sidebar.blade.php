<aside
    class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col bg-admin-sidebar text-sm transition-all duration-300"
    :class="{
        '-translate-x-full lg:translate-x-0': !sidebarMobile,
        'translate-x-0': sidebarMobile,
        'lg:!w-64': sidebarOpen,
        'lg:!w-[4.5rem]': !sidebarOpen
    }"
    @click.outside="sidebarMobile = false"
>
    {{-- Brand --}}
    <a href="{{ route('admin.dashboard') }}" class="flex h-14 items-center gap-2 border-b border-white/10 px-4 text-white">
        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded bg-admin-primary font-bold">E</div>
        <span class="font-semibold tracking-wide" x-show="sidebarOpen" x-cloak>E-SHOP Admin</span>
    </a>

    {{-- User panel --}}
    <div class="border-b border-white/10 px-4 py-3" x-show="sidebarOpen" x-cloak>
        <div class="flex items-center gap-3">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-admin-primary text-xs font-bold text-white">AP</div>
            <span class="text-slate-300">Admin User</span>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 overflow-y-auto px-2 py-3">
        <ul class="space-y-0.5">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded px-3 py-2.5 {{ request()->routeIs('admin.dashboard') ? 'bg-admin-primary text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Dashboard</span>
                </a>
            </li>

            <li class="pt-3">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-500" x-show="sidebarOpen" x-cloak>E-Commerce</p>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 rounded px-3 py-2.5 {{ request()->routeIs('admin.products.*') ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 rounded px-3 py-2.5 {{ request()->routeIs('admin.categories.*') ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 rounded px-3 py-2.5 {{ request()->routeIs('admin.orders.*') ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Orders</span>
                    <span x-show="sidebarOpen" x-cloak class="ml-auto rounded bg-admin-danger px-1.5 py-0.5 text-[10px] font-bold text-white">12</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 rounded px-3 py-2.5 {{ request()->routeIs('admin.customers.*') ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Customers</span>
                </a>
            </li>

            <li class="pt-3">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-500" x-show="sidebarOpen" x-cloak>Examples</p>
            </li>
            <li>
                <span class="flex cursor-default items-center gap-3 rounded px-3 py-2.5 text-slate-400">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Calendar</span>
                    <span x-show="sidebarOpen" x-cloak class="ml-auto rounded bg-admin-primary px-1.5 py-0.5 text-[10px] font-bold text-white">2</span>
                </span>
            </li>
            <li>
                <span class="flex cursor-default items-center gap-3 rounded px-3 py-2.5 text-slate-400">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Charts</span>
                </span>
            </li>
            <li>
                <span class="flex cursor-default items-center gap-3 rounded px-3 py-2.5 text-slate-400">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                    <span x-show="sidebarOpen" x-cloak>Widgets</span>
                    <span x-show="sidebarOpen" x-cloak class="ml-auto rounded bg-admin-danger px-1.5 py-0.5 text-[10px] font-bold text-white">New</span>
                </span>
            </li>
        </ul>
    </nav>

    <div class="border-t border-white/10 p-3" x-show="sidebarOpen" x-cloak>
        <a href="{{ route('home') }}" class="flex items-center gap-2 rounded px-3 py-2 text-slate-400 hover:bg-white/10 hover:text-white">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Store
        </a>
    </div>
</aside>
