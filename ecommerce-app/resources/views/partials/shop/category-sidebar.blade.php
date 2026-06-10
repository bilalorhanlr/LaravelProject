<aside
    @click.outside="if (window.innerWidth < 1024) categoriesOpen = false"
    class="w-full shrink-0 lg:w-64"
    :class="categoriesOpen ? 'block' : 'hidden lg:block'"
>
    <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card">
        <ul class="divide-y divide-slate-50">
            @foreach ($navCategories as $category)
                <li x-data="{ subOpen: false }" class="group">
                    <div class="flex items-center justify-between">
                        <a
                            href="{{ route('categories.show', $category) }}"
                            class="flex-1 px-4 py-3.5 text-sm font-medium text-shop-dark transition hover:bg-shop-surface hover:text-shop-orange"
                        >
                            {{ $category->name }}
                        </a>
                        @if ($category->children->isNotEmpty())
                            <button @click="subOpen = !subOpen" type="button" class="px-3 py-3.5 text-shop-muted hover:text-shop-orange">
                                <svg class="h-4 w-4 transition" :class="subOpen && 'rotate-90'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        @endif
                    </div>
                    @if ($category->children->isNotEmpty())
                        <ul x-show="subOpen" x-cloak class="bg-shop-surface/50 pb-2">
                            @foreach ($category->children as $child)
                                <li>
                                    <a href="{{ route('categories.show', $child) }}" class="block py-2 pl-8 pr-4 text-xs text-shop-muted transition hover:text-shop-orange">
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            <li>
                <a href="{{ route('categories.index') }}" class="block px-4 py-3.5 text-sm font-bold text-shop-orange transition hover:bg-shop-orange/5">
                    View All →
                </a>
            </li>
        </ul>
    </div>
</aside>
