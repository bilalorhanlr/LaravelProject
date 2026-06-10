@props(['order'])

<span {{ $attributes->merge(['class' => 'inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold '.$order->statusBadgeClass()]) }}>
    {{ $order->statusLabel() }}
</span>
