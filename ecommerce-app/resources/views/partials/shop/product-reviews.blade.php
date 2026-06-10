<section id="reviews" class="mt-16" x-data="{ tab: '{{ session('review_success') || $errors->any() ? 'reviews' : 'details' }}' }">
    @if (session('review_success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('review_success') }}
        </div>
    @endif

    {{-- Tabs --}}
    <div class="flex border-b border-slate-200">
        <button
            type="button"
            @click="tab = 'details'"
            class="px-6 py-3 text-sm font-bold uppercase tracking-wide transition"
            :class="tab === 'details' ? 'border-b-2 border-shop-orange text-shop-dark' : 'text-shop-muted hover:text-shop-dark'"
        >
            Details
        </button>
        <button
            type="button"
            @click="tab = 'reviews'"
            class="px-6 py-3 text-sm font-bold uppercase tracking-wide transition"
            :class="tab === 'reviews' ? 'border-b-2 border-shop-orange text-shop-dark' : 'text-shop-muted hover:text-shop-dark'"
        >
            Reviews ({{ $product->review_count }})
        </button>
    </div>

    {{-- Details Tab --}}
    <div x-show="tab === 'details'" class="py-8">
        @if ($product->detail)
            <div class="prose prose-sm max-w-none text-shop-muted">{!! $product->detail !!}</div>
        @elseif ($product->description)
            <div class="prose prose-sm max-w-none text-shop-muted">{!! $product->description !!}</div>
        @else
            <p class="text-shop-muted">No additional product details available.</p>
        @endif
    </div>

    {{-- Reviews Tab --}}
    <div x-show="tab === 'reviews'" x-cloak class="py-8">
        <div class="grid gap-10 lg:grid-cols-2">
            {{-- Review List --}}
            <div>
                <h3 class="mb-6 text-sm font-bold uppercase tracking-wide text-shop-dark">Customer Reviews</h3>
                <div class="space-y-6">
                    @forelse ($reviews as $review)
                        <article class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                            <div class="flex flex-wrap items-center gap-3 text-sm">
                                <div class="flex items-center gap-2 text-shop-dark">
                                    <svg class="h-4 w-4 text-shop-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <span class="font-semibold">{{ $review->reviewerName() }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-shop-muted">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $review->created_at->format('d M Y / g:i A') }}
                                </div>
                            </div>
                            <div class="mt-2">
                                <x-star-rating :rating="$review->rate" size="sm" />
                            </div>
                            <p class="mt-3 text-sm leading-relaxed text-shop-muted">{{ $review->comment }}</p>
                        </article>
                    @empty
                        <p class="rounded-2xl border border-dashed border-slate-200 py-10 text-center text-sm text-shop-muted">
                            No reviews yet. Be the first to review this product!
                        </p>
                    @endforelse
                </div>
            </div>

            {{-- Write Review Form --}}
            <div>
                <h3 class="mb-2 text-sm font-bold uppercase tracking-wide text-shop-dark">Write Your Review</h3>
                <p class="mb-6 text-xs text-shop-muted">Your email address will not be published. Reviews are published immediately.</p>

                <form action="{{ route('products.reviews.store', $product) }}" method="POST" class="space-y-4" x-data="{ rate: {{ old('rate', 5) }} }">
                    @csrf
                    <div>
                        <input type="text" name="name" value="{{ old('name', auth()->user()?->name) }}" placeholder="Your Name" required
                            class="w-full rounded border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-shop-orange focus:ring-shop-orange">
                        @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}" placeholder="Email Address" required
                            class="w-full rounded border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-shop-orange focus:ring-shop-orange">
                        @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <textarea name="comment" rows="5" placeholder="Your review" required
                            class="w-full rounded border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-shop-orange focus:ring-shop-orange">{{ old('comment') }}</textarea>
                        @error('comment')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <p class="mb-2 text-xs font-bold uppercase tracking-wide text-shop-dark">Your Rating</p>
                        <input type="hidden" name="rate" x-model="rate">
                        <div class="flex gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" @click="rate = {{ $i }}" class="transition hover:scale-110">
                                    <svg class="h-7 w-7" :class="rate >= {{ $i }} ? 'text-amber-400' : 'text-slate-200'" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        @error('rate')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="shop-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
