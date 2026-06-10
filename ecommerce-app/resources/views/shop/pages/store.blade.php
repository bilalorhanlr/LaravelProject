@extends('shop.pages._layout')

@section('title', 'Store Locator')

@section('page-title', 'Our Stores')

@section('page-content')
    <p class="text-shop-muted">Visit our flagship stores for an immersive shopping experience.</p>
    <div class="mt-6 space-y-4">
        <div class="rounded-2xl border border-slate-100 p-5">
            <h3 class="font-bold text-shop-dark">Istanbul Flagship</h3>
            <p class="mt-1 text-sm text-shop-muted">Nişantaşı, Istanbul — Mon–Sat 10:00–21:00</p>
        </div>
        <div class="rounded-2xl border border-slate-100 p-5">
            <h3 class="font-bold text-shop-dark">Ankara Store</h3>
            <p class="mt-1 text-sm text-shop-muted">Çankaya, Ankara — Mon–Sat 10:00–20:00</p>
        </div>
    </div>
@endsection
