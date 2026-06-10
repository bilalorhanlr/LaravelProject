@extends('layouts.shop')

@section('title', 'My Reviews')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <nav class="mb-6 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <span class="font-medium text-shop-orange">User Comment</span>
    </nav>

    <h1 class="shop-section-title">User Comments & Reviews</h1>

    @if (session('success'))
        <div class="mt-4 rounded-2xl border border-green-200 bg-green-50 px-5 py-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="mt-8 grid gap-8 lg:grid-cols-4">
        <div class="lg:col-span-1">
            @include('partials.shop.user-sidebar')
        </div>

        <div class="lg:col-span-3">
            <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-card">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-100 bg-shop-surface/50 text-left text-xs uppercase text-shop-muted">
                            <tr>
                                <th class="px-4 py-3">Id</th>
                                <th class="px-4 py-3">Product</th>
                                <th class="px-4 py-3">Review</th>
                                <th class="px-4 py-3">Rate</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($reviews as $review)
                                <tr class="hover:bg-shop-surface/30">
                                    <td class="px-4 py-3 text-shop-muted">{{ $review->id }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('products.show', $review->product) }}" class="font-medium text-shop-dark hover:text-shop-orange">
                                            {{ $review->product?->title ?? '—' }}
                                        </a>
                                    </td>
                                    <td class="max-w-xs truncate px-4 py-3 text-shop-muted">{{ $review->comment }}</td>
                                    <td class="px-4 py-3">
                                        <x-star-rating :rating="$review->rate" size="sm" />
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-xs font-semibold {{ $review->status === 'active' ? 'text-green-600' : 'text-slate-500' }}">
                                            {{ $review->status === 'active' ? 'True' : 'False' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <form action="{{ route('user.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Delete this review?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded bg-shop-orange px-3 py-1 text-xs font-semibold text-white hover:bg-shop-orange-dark">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-12 text-center text-shop-muted">You haven't written any reviews yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-slate-100 px-4 py-3">{{ $reviews->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
