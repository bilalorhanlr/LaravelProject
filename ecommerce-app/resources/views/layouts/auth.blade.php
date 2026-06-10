<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Account') — E-SHOP</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-shop-surface font-sans text-shop-dark antialiased">
    <div class="flex min-h-screen">
        {{-- Brand panel --}}
        <div class="relative hidden w-1/2 overflow-hidden bg-shop-dark lg:flex lg:flex-col lg:justify-between">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&h=1600&fit=crop')] bg-cover bg-center opacity-30"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-shop-dark via-shop-dark/95 to-shop-orange/20"></div>

            <div class="relative z-10 p-10">
                <a href="{{ route('home') }}" class="text-3xl font-extrabold text-white">
                    <span class="text-shop-orange">E-</span>SHOP
                </a>
            </div>

            <div class="relative z-10 p-10">
                <h2 class="text-3xl font-extrabold leading-tight text-white">Shop smarter.<br>Live better.</h2>
                <p class="mt-4 max-w-md text-white/70">Join thousands of happy customers. Exclusive deals, fast shipping, and premium products await you.</p>
                <div class="mt-8 flex gap-6">
                    <div>
                        <p class="text-2xl font-bold text-shop-orange">50K+</p>
                        <p class="text-sm text-white/60">Happy Customers</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-shop-orange">2K+</p>
                        <p class="text-sm text-white/60">Products</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form panel --}}
        <div class="flex w-full flex-col justify-center px-6 py-12 lg:w-1/2 lg:px-16">
            <div class="mx-auto w-full max-w-md">
                <a href="{{ route('home') }}" class="mb-8 inline-block text-2xl font-extrabold lg:hidden">
                    <span class="text-shop-orange">E-</span>SHOP
                </a>

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
