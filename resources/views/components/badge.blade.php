@props([
    'tone' => 'brand',
])

@php
    $tones = [
        'brand' => 'bg-brand-light text-brand',
        'accent' => 'bg-accent/10 text-accent',
        'muted' => 'bg-canvas text-ink-secondary border border-line',
        'danger' => 'bg-danger/10 text-danger',
        'dark' => 'bg-ink text-white',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ' . ($tones[$tone] ?? $tones['brand'])]) }}>
    {{ $slot }}
</span>
