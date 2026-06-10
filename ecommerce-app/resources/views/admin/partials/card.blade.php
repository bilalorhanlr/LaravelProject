@props(['title' => null, 'footer' => null, 'tools' => false])

<div {{ $attributes->merge(['class' => 'admin-card']) }}>
    @if ($title)
        <div class="admin-card-header">
            <h3 class="text-base font-semibold text-slate-800">{{ $title }}</h3>
            @if ($tools)
                <div class="flex gap-1">
                    <button type="button" class="admin-btn-ghost">
                        <ion-icon name="expand-outline"></ion-icon>
                    </button>
                </div>
            @endif
        </div>
    @endif
    <div class="{{ $title ? 'admin-card-body' : 'p-0' }}">
        {{ $slot }}
    </div>
    @if ($footer)
        <div class="admin-card-footer">{{ $footer }}</div>
    @endif
</div>
