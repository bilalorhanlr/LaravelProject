@props(['title', 'breadcrumb' => ''])

<div class="mb-6 flex flex-wrap items-center justify-between gap-2">
    <h1 class="text-2xl font-semibold text-slate-800">{{ $title }}</h1>
    <nav class="text-sm text-slate-500">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary">Home</a>
        @if ($breadcrumb)
            <span class="mx-1">/</span>
            <span class="text-slate-700">{{ $breadcrumb }}</span>
        @endif
    </nav>
</div>
