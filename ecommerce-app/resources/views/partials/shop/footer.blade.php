<footer class="mt-16 bg-shop-surface">
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
            <div>
                <a href="{{ route('home') }}" class="text-2xl font-extrabold">
                    <span class="text-shop-orange">E-</span><span class="text-shop-dark">SHOP</span>
                </a>
                <p class="mt-4 text-sm leading-relaxed text-shop-muted">
                    Your destination for premium fashion, electronics, and lifestyle products. Quality you can trust, style you'll love.
                </p>
                <div class="mt-5 flex gap-3">
                    @foreach (['facebook', 'twitter', 'instagram'] as $social)
                        <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-shop-muted shadow-sm transition hover:bg-shop-orange hover:text-white">
                            <span class="sr-only">{{ $social }}</span>
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-shop-dark">My Account</h4>
                <ul class="mt-4 space-y-2.5 text-sm text-shop-muted">
                    <li>
                        @auth
                            <a href="{{ route('user.profile') }}" class="hover:text-shop-orange">{{ Auth::user()->name }}</a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-shop-orange">My Account</a>
                        @endauth
                    </li>
                    <li><a href="{{ route('pages.wishlist') }}" class="hover:text-shop-orange">My Wishlist</a></li>
                    <li><a href="{{ route('pages.compare') }}" class="hover:text-shop-orange">Compare</a></li>
                    <li><a href="{{ route('cart.index') }}" class="hover:text-shop-orange">Shopping Cart</a></li>
                    <li><a href="{{ route('pages.checkout') }}" class="hover:text-shop-orange">Checkout</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-shop-orange">Login</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-shop-dark">Customer Service</h4>
                <ul class="mt-4 space-y-2.5 text-sm text-shop-muted">
                    <li><a href="{{ route('pages.about') }}" class="hover:text-shop-orange">About Us</a></li>
                    <li><a href="{{ route('pages.contact') }}" class="hover:text-shop-orange">Contact Us</a></li>
                    <li><a href="{{ route('pages.shipping') }}" class="hover:text-shop-orange">Shipping & Return</a></li>
                    <li><a href="{{ route('pages.shipping') }}" class="hover:text-shop-orange">Shipping Guide</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="hover:text-shop-orange">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-shop-dark">Stay Connected</h4>
                <p class="mt-4 text-sm text-shop-muted">Subscribe for exclusive deals and new arrivals.</p>
                <form action="{{ route('pages.newsletter') }}" method="GET" class="mt-4 flex gap-2">
                    <input type="email" placeholder="Enter email address" class="flex-1 rounded-xl border-slate-200 text-sm shadow-sm focus:border-shop-orange focus:ring-shop-orange">
                    <button type="submit" class="shop-btn shrink-0 px-4 py-2.5 text-xs">Join</button>
                </form>
            </div>
        </div>

        <div class="mt-12 border-t border-slate-200 pt-6 text-center text-xs text-shop-muted">
            Copyright © {{ date('Y') }} E-SHOP. All rights reserved.
        </div>
    </div>
</footer>
