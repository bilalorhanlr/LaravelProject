@props(['title', 'breadcrumb' => '', 'description' => null])

<div class="mb-6 flex flex-wrap items-start justify-between gap-4">
    <div>
        <h1 class="admin-page-title">{{ $title }}</h1>
        @if ($description)
            <p class="mt-1 text-sm text-slate-500">{{ $description }}</p>
        @endif
        @if ($breadcrumb)
            <nav class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
                <a href="{{ route('admin.dashboard') }}" class="font-medium hover:text-admin-primary">Home</a>
                <ion-icon name="chevron-forward" class="text-sm text-slate-300"></ion-icon>
                <span class="text-slate-700">{{ $breadcrumb }}</span>
            </nav>
        @endif
    </div>
    @isset($actions)
        <div class="flex flex-wrap items-center gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>
