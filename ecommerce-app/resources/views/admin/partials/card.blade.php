@props(['title' => null, 'footer' => null, 'tools' => true])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm']) }}>
    @if ($title)
        <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
            <h3 class="text-base font-semibold text-slate-800">{{ $title }}</h3>
            @if ($tools)
                <div class="flex gap-1">
                    <button type="button" class="rounded p-1 text-slate-400 hover:bg-slate-100"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg></button>
                    <button type="button" class="rounded p-1 text-slate-400 hover:bg-slate-100"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </div>
            @endif
        </div>
    @endif
    <div class="p-4">
        {{ $slot }}
    </div>
    @if ($footer)
        <div class="border-t border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-500">{{ $footer }}</div>
    @endif
</div>
