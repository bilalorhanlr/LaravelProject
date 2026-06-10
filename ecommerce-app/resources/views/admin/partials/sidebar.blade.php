@php
    $linkClass = fn (bool $active) => 'group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition '.(
        $active
            ? 'bg-admin-primary/15 text-white ring-1 ring-admin-primary/25'
            : 'text-slate-400 hover:bg-white/5 hover:text-white'
    );

    $subLinkClass = fn (bool $active) => 'block rounded-lg py-1.5 pl-3 text-xs transition '.(
        $active ? 'border-l-2 border-admin-primary font-semibold text-white' : 'text-slate-500 hover:text-white'
    );

    $iconClass = fn (bool $active) => 'text-lg shrink-0 '.($active ? 'text-admin-primary' : 'text-slate-500 group-hover:text-slate-300');
@endphp

<aside
    class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col border-r border-white/5 bg-admin-sidebar text-sm shadow-xl transition-all duration-300"
    :class="{
        '-translate-x-full lg:translate-x-0': !sidebarMobile,
        'translate-x-0': sidebarMobile,
        'lg:!w-64': sidebarOpen,
        'lg:!w-[4.5rem]': !sidebarOpen
    }"
    @click.outside="sidebarMobile = false"
>
    <a href="{{ route('admin.dashboard') }}" class="flex h-16 items-center gap-3 border-b border-white/5 px-4">
        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-admin-primary to-admin-primary-dark text-lg font-extrabold text-white shadow-lg shadow-admin-primary/30">
            E
        </div>
        <div x-show="sidebarOpen" x-cloak>
            <p class="font-bold tracking-tight text-white">E-SHOP</p>
            <p class="text-[10px] font-semibold uppercase tracking-widest text-slate-500">Admin Panel</p>
        </div>
    </a>

    <nav class="flex-1 overflow-y-auto px-3 py-5">
        <p x-show="sidebarOpen" x-cloak class="mb-2 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-600">Overview</p>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ $linkClass(request()->routeIs('admin.dashboard')) }}">
                    <ion-icon name="grid-outline" class="{{ $iconClass(request()->routeIs('admin.dashboard')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Dashboard</span>
                </a>
            </li>

            <li x-data="{ open: {{ request()->routeIs('admin.orders.*') ? 'true' : 'false' }} }">
                <button type="button" @click="open = !open" class="{{ $linkClass(request()->routeIs('admin.orders.*')) }} w-full">
                    <ion-icon name="bag-handle-outline" class="{{ $iconClass(request()->routeIs('admin.orders.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak class="flex-1 text-left">Orders</span>
                    <ion-icon x-show="sidebarOpen" x-cloak name="chevron-down-outline" class="text-xs text-slate-500 transition" :class="open && 'rotate-180'"></ion-icon>
                </button>
                <ul x-show="open && sidebarOpen" x-cloak class="ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-2">
                    <li><a href="{{ route('admin.orders.index') }}" class="{{ $subLinkClass(!request('status')) }}">All Orders</a></li>
                    <li><a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="{{ $subLinkClass(request('status') === 'pending') }}">Pending</a></li>
                    <li><a href="{{ route('admin.orders.index', ['status' => 'approved']) }}" class="{{ $subLinkClass(request('status') === 'approved') }}">Approved</a></li>
                    <li><a href="{{ route('admin.orders.index', ['status' => 'rejected']) }}" class="{{ $subLinkClass(request('status') === 'rejected') }}">Rejected</a></li>
                </ul>
            </li>
        </ul>

        <p x-show="sidebarOpen" x-cloak class="mb-2 mt-6 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-600">Catalog</p>
        <ul class="space-y-1">
            <li x-data="{ open: {{ request()->routeIs('admin.categories.*') ? 'true' : 'false' }} }">
                <button type="button" @click="open = !open" class="{{ $linkClass(request()->routeIs('admin.categories.*')) }} w-full">
                    <ion-icon name="folder-outline" class="{{ $iconClass(request()->routeIs('admin.categories.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak class="flex-1 text-left">Categories</span>
                    <ion-icon x-show="sidebarOpen" x-cloak name="chevron-down-outline" class="text-xs text-slate-500 transition" :class="open && 'rotate-180'"></ion-icon>
                </button>
                <ul x-show="open && sidebarOpen" x-cloak class="ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-2">
                    <li><a href="{{ route('admin.categories.index') }}" class="{{ $subLinkClass(request()->routeIs('admin.categories.index')) }}">Category List</a></li>
                    <li><a href="{{ route('admin.categories.tree') }}" class="{{ $subLinkClass(request()->routeIs('admin.categories.tree')) }}">Category Tree</a></li>
                    <li><a href="{{ route('admin.categories.create') }}" class="{{ $subLinkClass(request()->routeIs('admin.categories.create')) }}">Add Category</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('admin.products.index') }}" class="{{ $linkClass(request()->routeIs('admin.products.*')) }}">
                    <ion-icon name="cube-outline" class="{{ $iconClass(request()->routeIs('admin.products.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Products</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.comments.index') }}" class="{{ $linkClass(request()->routeIs('admin.comments.*')) }}">
                    <ion-icon name="chatbubbles-outline" class="{{ $iconClass(request()->routeIs('admin.comments.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Comments</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.faqs.index') }}" class="{{ $linkClass(request()->routeIs('admin.faqs.*')) }}">
                    <ion-icon name="help-circle-outline" class="{{ $iconClass(request()->routeIs('admin.faqs.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>FAQ</span>
                </a>
            </li>
        </ul>

        <p x-show="sidebarOpen" x-cloak class="mb-2 mt-6 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-600">Communication</p>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.messages.index') }}" class="{{ $linkClass(request()->routeIs('admin.messages.*')) }}">
                    <ion-icon name="mail-outline" class="{{ $iconClass(request()->routeIs('admin.messages.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Messages</span>
                </a>
            </li>
        </ul>

        <p x-show="sidebarOpen" x-cloak class="mb-2 mt-6 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-600">Users</p>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ $linkClass(request()->routeIs('admin.users.*')) }}">
                    <ion-icon name="people-outline" class="{{ $iconClass(request()->routeIs('admin.users.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.roles.index') }}" class="{{ $linkClass(request()->routeIs('admin.roles.*')) }}">
                    <ion-icon name="shield-checkmark-outline" class="{{ $iconClass(request()->routeIs('admin.roles.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Roles</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.socials.index') }}" class="{{ $linkClass(request()->routeIs('admin.socials.*')) }}">
                    <ion-icon name="share-social-outline" class="{{ $iconClass(request()->routeIs('admin.socials.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Social</span>
                </a>
            </li>
        </ul>

        <p x-show="sidebarOpen" x-cloak class="mb-2 mt-6 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-600">System</p>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.settings.index') }}" class="{{ $linkClass(request()->routeIs('admin.settings.*')) }}">
                    <ion-icon name="settings-outline" class="{{ $iconClass(request()->routeIs('admin.settings.*')) }}"></ion-icon>
                    <span x-show="sidebarOpen" x-cloak>Settings</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="border-t border-white/5 p-3">
        <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-slate-400 transition hover:bg-white/5 hover:text-white">
            <ion-icon name="storefront-outline" class="text-lg"></ion-icon>
            <span x-show="sidebarOpen" x-cloak class="text-sm font-medium">Back to Store</span>
        </a>
    </div>
</aside>
