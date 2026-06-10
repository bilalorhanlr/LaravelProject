<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — E-SHOP Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=source-sans-3:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-admin-body font-sans text-slate-700 antialiased" x-data="{ sidebarOpen: true, sidebarMobile: false }">
    <div class="flex min-h-screen">
        @include('admin.partials.sidebar')

        <div class="flex min-w-0 flex-1 flex-col" :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-[4.5rem]'">
            @include('admin.partials.navbar')

            <main class="flex-1 p-4 lg:p-6">
                @if (session('success'))
                    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <ul class="list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>

            <footer class="border-t border-slate-200 bg-white px-6 py-3 text-sm text-slate-500">
                <strong>Copyright &copy; {{ date('Y') }} E-SHOP Admin.</strong> All rights reserved.
            </footer>
        </div>
    </div>

    <div x-show="sidebarMobile" x-cloak @click="sidebarMobile = false" class="fixed inset-0 z-30 bg-black/50 lg:hidden"></div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.9/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
