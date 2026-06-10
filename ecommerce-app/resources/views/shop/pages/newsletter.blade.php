@extends('shop.pages._layout')

@section('title', 'Newsletter')

@section('page-title', 'Join Our Newsletter')

@section('page-content')
    <p class="text-shop-muted">Get exclusive deals, early access to sales, and style tips delivered to your inbox.</p>
    <form class="mt-8 flex flex-col gap-4 sm:flex-row">
        <input type="email" placeholder="Enter your email" class="flex-1 rounded-xl border-slate-200 shadow-sm focus:border-shop-orange focus:ring-shop-orange">
        <button type="submit" class="shop-btn">Subscribe</button>
    </form>
@endsection
