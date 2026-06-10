{{-- Category & SubCategory section — loaded from database --}}
@if ($rootCategories->isNotEmpty())
    <section class="mt-14">
        <div class="mb-8 flex items-end justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-shop-orange">Browse</p>
                <h2 class="shop-section-title mt-1">Categories & Sub Categories</h2>
            </div>
            <a href="{{ route('categories.index') }}" class="text-sm font-semibold text-shop-orange hover:underline">All Categories →</a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($rootCategories as $category)
                @php
                    $cardImage = $category->image
                        ?? config("shop.category_images.{$category->slug}")
                        ?? asset('images/slider/slide-1.jpg');
                @endphp
                <article class="group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card transition hover:-translate-y-1 hover:shadow-card-hover">
                    <a href="{{ route('categories.show', $category) }}" class="relative block aspect-[4/3] overflow-hidden">
                        <img src="{{ $cardImage }}" alt="{{ $category->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-shop-dark/80 via-shop-dark/20 to-transparent"></div>
                        <div class="absolute bottom-3 left-4 right-4 text-white">
                            <h3 class="text-lg font-bold">{{ $category->title }}</h3>
                            <p class="text-xs text-white/70">{{ $category->products_count }} products</p>
                        </div>
                    </a>

                    @if ($category->children->isNotEmpty())
                        <ul class="divide-y divide-slate-50 px-4 py-2">
                            @foreach ($category->children->take(4) as $child)
                                <li>
                                    <a href="{{ route('categories.show', $child) }}" class="flex items-center justify-between py-2 text-sm text-shop-muted transition hover:text-shop-orange">
                                        <span>{{ $child->title }}</span>
                                        <svg class="h-3.5 w-3.5 opacity-0 transition group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </li>
                            @endforeach
                            @if ($category->children->count() > 4)
                                <li>
                                    <a href="{{ route('categories.show', $category) }}" class="block py-2 text-xs font-semibold text-shop-orange hover:underline">
                                        +{{ $category->children->count() - 4 }} more sub categories
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @else
                        <div class="px-4 py-3">
                            <a href="{{ route('categories.show', $category) }}" class="text-xs font-semibold text-shop-orange hover:underline">View products →</a>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    </section>
@endif
