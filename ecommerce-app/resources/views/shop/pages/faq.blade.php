@extends('layouts.shop')

@section('title', 'FAQ')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
    <nav class="mb-8 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <span class="font-medium text-shop-orange">FAQ</span>
    </nav>

    <h1 class="shop-section-title">Frequently Asked Questions</h1>
    <p class="mt-2 text-shop-muted">Find answers to common questions about shopping, shipping, and returns.</p>

    <div class="mt-10 space-y-3" x-data="{ open: null }">
        @forelse ($faqs as $index => $faq)
            <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">
                <button
                    type="button"
                    @click="open = open === {{ $index }} ? null : {{ $index }}"
                    class="flex w-full items-center justify-between px-5 py-4 text-left font-semibold text-shop-dark transition hover:bg-shop-surface/50"
                >
                    <span>{{ $faq->question }}</span>
                    <svg class="h-5 w-5 shrink-0 text-shop-orange transition" :class="open === {{ $index }} && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open === {{ $index }}" x-cloak class="border-t border-slate-100 px-5 py-4">
                    <p class="text-sm leading-relaxed text-shop-muted">{{ $faq->answer }}</p>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-dashed border-slate-200 py-12 text-center text-shop-muted">
                No FAQ entries yet.
            </div>
        @endforelse
    </div>
</div>
@endsection
