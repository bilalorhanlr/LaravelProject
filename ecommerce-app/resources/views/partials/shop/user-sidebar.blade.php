@php
    $menuClass = fn (bool $active) => 'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition '.(
        $active ? 'bg-shop-orange/10 text-shop-orange' : 'text-shop-muted hover:bg-shop-surface hover:text-shop-dark'
    );
@endphp

<aside class="rounded-2xl border border-slate-100 bg-white shadow-card">
    <div class="border-b border-slate-100 px-4 py-4">
        <p class="text-xs font-bold uppercase tracking-widest text-shop-dark">User Menu</p>
    </div>
    <nav class="space-y-1 p-3">
        <a href="{{ route('user.profile') }}" class="{{ $menuClass(request()->routeIs('user.profile')) }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            My Profile
        </a>
        <a href="{{ route('user.orders') }}" class="{{ $menuClass(request()->routeIs('user.orders')) }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            My Orders
        </a>
        <a href="{{ route('user.reviews') }}" class="{{ $menuClass(request()->routeIs('user.reviews')) }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            My Reviews
        </a>
        <a href="{{ route('pages.checkout') }}" class="{{ $menuClass(request()->routeIs('pages.checkout')) }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Checkout
        </a>
        <a href="{{ route('shop') }}" class="{{ $menuClass(false) }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            My Products
        </a>
        <form method="POST" action="{{ route('logout') }}" class="pt-1">
            @csrf
            <button type="submit" class="{{ $menuClass(false) }} w-full text-left">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </button>
        </form>
    </nav>
</aside>
