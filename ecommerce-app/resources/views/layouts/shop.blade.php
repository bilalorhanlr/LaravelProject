<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'E-SHOP') — {{ config('app.name', 'Ecommerce') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white font-sans text-shop-dark antialiased" x-data="{ mobileMenu: false, categoriesOpen: false }">
    @include('partials.shop.top-bar')
    @include('partials.shop.header')
    @include('partials.shop.navigation')

    @if (session('cart_success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 4000)"
            class="fixed right-4 top-4 z-[100] max-w-sm rounded-2xl bg-shop-dark px-5 py-4 text-sm font-medium text-white shadow-xl"
        >
            {{ session('cart_success') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.shop.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.9/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
