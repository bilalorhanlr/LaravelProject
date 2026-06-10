@php
    $linkClass = fn (bool $active) => 'flex items-center gap-3 rounded-lg px-3 py-2.5 transition '.(
        $active ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white'
    );
@endphp

<aside
    class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col bg-[#2f343a] text-sm transition-all duration-300"
    :class="{
        '-translate-x-full lg:translate-x-0': !sidebarMobile,
        'translate-x-0': sidebarMobile,
        'lg:!w-64': sidebarOpen,
        'lg:!w-[4.5rem]': !sidebarOpen
    }"
    @click.outside="sidebarMobile = false"
>
    <a href="{{ route('admin.dashboard') }}" class="flex h-14 items-center gap-2 border-b border-white/10 px-4 text-white">
        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded bg-admin-primary font-bold">E</div>
        <span class="font-semibold tracking-wide" x-show="sidebarOpen" x-cloak>E-SHOP Admin</span>
    </a>

    <nav class="flex-1 overflow-y-auto px-3 py-4">
        <ul class="space-y-1">
            {{-- Dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ $linkClass(request()->routeIs('admin.dashboard')) }}">
                    <ion-icon name="home" class="text-xl text-yellow-400"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Dashboard</span>
                </a>
            </li>

            {{-- Orders (dropdown) --}}
            <li x-data="{ open: {{ request()->routeIs('admin.orders.*') ? 'true' : 'false' }} }">
                <button type="button" @click="open = !open" class="{{ $linkClass(request()->routeIs('admin.orders.*')) }} w-full">
                    <ion-icon name="cube" class="text-xl text-blue-400"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak class="flex-1 text-left">Orders</span>
                    <ion-icon x-show="sidebarOpen" x-cloak name="chevron-down-outline" class="text-sm transition" :class="open && 'rotate-180'"></ion-icon>
                </button>
                <ul x-show="open && sidebarOpen" x-cloak class="ml-9 mt-1 space-y-1 border-l border-white/10 pl-3">
                    <li><a href="{{ route('admin.orders.index') }}" class="block rounded py-1.5 text-xs text-slate-400 hover:text-white">All Orders</a></li>
                    <li><a href="{{ route('admin.orders.index') }}?status=pending" class="block rounded py-1.5 text-xs text-slate-400 hover:text-white">Pending</a></li>
                    <li><a href="{{ route('admin.orders.index') }}?status=completed" class="block rounded py-1.5 text-xs text-slate-400 hover:text-white">Completed</a></li>
                </ul>
            </li>

            {{-- Categories --}}
            <li>
                <a href="{{ route('admin.categories.index') }}" class="{{ $linkClass(request()->routeIs('admin.categories.*')) }}">
                    <ion-icon name="grid" class="text-xl text-yellow-400"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Categories</span>
                </a>
            </li>

            {{-- Products --}}
            <li>
                <a href="{{ route('admin.products.index') }}" class="{{ $linkClass(request()->routeIs('admin.products.*')) }}">
                    <ion-icon name="apps-outline" class="text-xl text-slate-300"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Products</span>
                </a>
            </li>

            {{-- Comments --}}
            <li>
                <a href="{{ route('admin.comments.index') }}" class="{{ $linkClass(request()->routeIs('admin.comments.*')) }}">
                    <ion-icon name="chatbubble-outline" class="text-xl text-slate-300"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Comments</span>
                </a>
            </li>

            {{-- FAQ --}}
            <li>
                <a href="{{ route('admin.faqs.index') }}" class="{{ $linkClass(request()->routeIs('admin.faqs.*')) }}">
                    <ion-icon name="help-circle-outline" class="text-xl text-slate-300"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>FAQ</span>
                </a>
            </li>

            {{-- Messages --}}
            <li>
                <a href="{{ route('admin.messages.index') }}" class="{{ $linkClass(request()->routeIs('admin.messages.*')) }}">
                    <ion-icon name="mail-unread-outline" class="text-xl text-slate-300"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Messages</span>
                </a>
            </li>

            {{-- Users --}}
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ $linkClass(request()->routeIs('admin.users.*')) }}">
                    <ion-icon name="person" class="text-xl text-green-400"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Users</span>
                </a>
            </li>

            {{-- Social --}}
            <li>
                <a href="{{ route('admin.socials.index') }}" class="{{ $linkClass(request()->routeIs('admin.socials.*')) }}">
                    <ion-icon name="share-social-outline" class="text-xl text-slate-300"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Social</span>
                </a>
            </li>

            <li class="pt-4" x-show="sidebarOpen" x-cloak>
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-500">Labels</p>
            </li>

            {{-- Settings --}}
            <li>
                <a href="{{ route('admin.settings.index') }}" class="{{ $linkClass(request()->routeIs('admin.settings.*')) }}">
                    <ion-icon name="settings-outline" class="text-xl text-slate-300"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Settings</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="border-t border-white/10 p-3" x-show="sidebarOpen" x-cloak>
        <a href="{{ route('home') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-slate-400 hover:bg-white/10 hover:text-white">
            <ion-icon name="storefront-outline" class="text-lg"></ion-icon>
            Back to Store
        </a>
    </div>
</aside>
