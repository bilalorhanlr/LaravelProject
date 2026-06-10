@extends('shop.pages._layout')

@section('title', 'Compare')

@section('page-title', 'Compare Products')

@section('page-content')
    <div class="rounded-2xl border border-dashed border-slate-200 py-16 text-center">
        <p class="text-shop-muted">No products to compare yet. Add items from the shop to compare.</p>
        <a href="{{ route('shop') }}" class="shop-btn mt-6 inline-flex">Browse Products</a>
    </div>
@endsection
