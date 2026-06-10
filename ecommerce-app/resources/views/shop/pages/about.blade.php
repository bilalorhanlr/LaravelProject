@extends('layouts.shop')

@section('title', 'About Us')

@section('content')
<div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
    <nav class="mb-8 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <span class="font-medium text-shop-orange">About Us</span>
    </nav>

    <h1 class="shop-section-title">About {{ $setting?->title ?? 'E-SHOP' }}</h1>

    <div class="prose prose-slate mt-8 max-w-none">
        @if ($setting?->aboutus)
            {!! nl2br(e($setting->aboutus)) !!}
        @else
            <p>E-SHOP is a modern e-commerce destination offering curated fashion, electronics, and lifestyle products. We believe in quality, transparency, and exceptional customer experience.</p>
            <p>Founded with a passion for design and innovation, we partner with trusted brands to bring you the best products at competitive prices.</p>
        @endif
    </div>

    @if ($setting?->company || $setting?->address)
        <div class="mt-10 rounded-2xl border border-slate-100 bg-shop-surface/50 p-6">
            <h2 class="text-lg font-bold text-shop-dark">Our Company</h2>
            <dl class="mt-4 space-y-2 text-sm text-shop-muted">
                @if ($setting?->company)<div><span class="font-semibold text-shop-dark">Company:</span> {{ $setting->company }}</div>@endif
                @if ($setting?->address)<div><span class="font-semibold text-shop-dark">Address:</span> {{ $setting->address }}</div>@endif
                @if ($setting?->email)<div><span class="font-semibold text-shop-dark">Email:</span> {{ $setting->email }}</div>@endif
            </dl>
        </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('pages.contact') }}" class="shop-btn">Contact Us</a>
    </div>
</div>
@endsection
