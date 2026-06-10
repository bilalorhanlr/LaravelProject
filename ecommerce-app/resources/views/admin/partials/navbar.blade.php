<nav class="sticky top-0 z-20 flex h-14 items-center gap-4 border-b border-slate-200 bg-white px-4 shadow-sm">
    <button @click="sidebarOpen = !sidebarOpen; sidebarMobile = !sidebarMobile" type="button" class="rounded p-2 text-slate-600 hover:bg-slate-100">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>

    <div class="hidden items-center gap-4 text-sm sm:flex">
        <a href="{{ route('admin.dashboard') }}" class="text-slate-600 hover:text-admin-primary">Home</a>
        <a href="#" class="text-slate-600 hover:text-admin-primary">Contact</a>
    </div>

    <form class="ml-2 hidden max-w-xs flex-1 sm:block">
        <div class="relative">
            <input type="search" placeholder="Search" class="w-full rounded border-slate-300 py-1.5 pl-3 pr-9 text-sm focus:border-admin-primary focus:ring-admin-primary">
            <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-400">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
        </div>
    </form>

    <div class="ml-auto flex items-center gap-2">
        <button type="button" class="relative rounded p-2 text-slate-600 hover:bg-slate-100">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span class="absolute right-1 top-1 flex h-4 w-4 items-center justify-center rounded-full bg-admin-danger text-[9px] font-bold text-white">3</span>
        </button>
        <button type="button" class="relative rounded p-2 text-slate-600 hover:bg-slate-100">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            <span class="absolute right-1 top-1 flex h-4 w-4 items-center justify-center rounded-full bg-admin-warning text-[9px] font-bold text-slate-800">15</span>
        </button>
        <button type="button" class="hidden rounded p-2 text-slate-600 hover:bg-slate-100 sm:block">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
        </button>
    </div>
</nav>
