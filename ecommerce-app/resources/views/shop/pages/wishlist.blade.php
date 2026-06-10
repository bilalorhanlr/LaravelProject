@extends('shop.pages._layout')

@section('title', 'Wishlist')

@section('page-title', 'My Wishlist')

@section('page-content')
    <div class="rounded-2xl border border-dashed border-slate-200 py-16 text-center">
        <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        <p class="mt-4 text-shop-muted">Your wishlist is empty.</p>
        <a href="{{ route('shop') }}" class="shop-btn mt-6 inline-flex">Start Shopping</a>
    </div>
@endsection
