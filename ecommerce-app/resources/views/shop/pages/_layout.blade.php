@extends('layouts.shop')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="shop-section-title">@yield('page-title')</h1>
    <div class="prose prose-slate mt-8 max-w-none">
        @yield('page-content')
    </div>
</div>
@endsection
