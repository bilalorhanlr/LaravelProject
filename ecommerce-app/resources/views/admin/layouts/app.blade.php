<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — E-SHOP Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src="https://unpkg.com/ionicons@7.4.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.4.0/dist/ionicons/ionicons.js"></script>
    <style>ion-icon { pointer-events: none; }</style>
    @stack('styles')
</head>
<body class="bg-admin-body font-sans text-slate-700 antialiased" x-data="{ sidebarOpen: true, sidebarMobile: false }">
    <div class="flex min-h-screen">
        @include('admin.partials.sidebar')

        <div class="flex min-w-0 flex-1 flex-col transition-all duration-300" :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-[4.5rem]'">
            @include('admin.partials.navbar')

            <main class="flex-1 px-4 py-5 lg:px-8 lg:py-7">
                @if (session('success'))
                    <div class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        <ion-icon name="checkmark-circle" class="mt-0.5 shrink-0 text-lg text-emerald-500"></ion-icon>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <ion-icon name="alert-circle" class="mt-0.5 shrink-0 text-lg text-red-500"></ion-icon>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <div class="mb-1 flex items-center gap-2 font-semibold">
                            <ion-icon name="warning" class="text-lg text-red-500"></ion-icon>
                            Please fix the following:
                        </div>
                        <ul class="ml-7 list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>

            <footer class="border-t border-slate-200/80 bg-white px-6 py-4 text-xs text-slate-500">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <span><strong class="text-slate-700">E-SHOP Admin</strong> &copy; {{ date('Y') }}</span>
                    <a href="{{ route('home') }}" class="font-medium text-admin-primary hover:underline">View Storefront</a>
                </div>
            </footer>
        </div>
    </div>

    <div x-show="sidebarMobile" x-cloak @click="sidebarMobile = false" class="fixed inset-0 z-30 bg-slate-900/60 backdrop-blur-sm lg:hidden"></div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.9/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
