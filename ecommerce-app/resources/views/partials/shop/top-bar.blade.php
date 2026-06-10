<div class="border-b border-slate-100 bg-shop-surface">
    <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-2 px-4 py-2 text-xs text-shop-muted sm:px-6 lg:px-8">
        <p class="font-medium">Welcome to <span class="text-shop-orange">E-SHOP</span> — Free shipping on orders over $50</p>
        <div class="flex flex-wrap items-center gap-4">
            <a href="{{ route('pages.store') }}" class="transition hover:text-shop-orange">Store</a>
            <a href="{{ route('pages.newsletter') }}" class="transition hover:text-shop-orange">Newsletter</a>
            <a href="{{ route('pages.faq') }}" class="transition hover:text-shop-orange">FAQ</a>
            <div class="hidden items-center gap-3 sm:flex">
                <select class="cursor-pointer border-0 bg-transparent py-0 pl-0 pr-6 text-xs font-semibold uppercase text-shop-dark focus:ring-0">
                    <option>ENG</option>
                    <option>TR</option>
                </select>
                <select class="cursor-pointer border-0 bg-transparent py-0 pl-0 pr-6 text-xs font-semibold uppercase text-shop-dark focus:ring-0">
                    <option>USD</option>
                    <option>EUR</option>
                </select>
            </div>
        </div>
    </div>
</div>
