@props([
    'tone' => null,
    'status' => null,
])

@php
    $statusTones = [
        'active' => 'brand',
        'published' => 'brand',
        'new' => 'brand',
        'pending' => 'warning',
        'draft' => 'warning',
        'sold' => 'danger',
        'inactive' => 'muted',
        'archived' => 'muted',
        'read' => 'muted',
        'featured' => 'accent',
        'replied' => 'accent',
    ];

    $tones = [
        'brand' => 'bg-brand-light text-brand',
        'accent' => 'bg-accent/10 text-accent',
        'muted' => 'bg-canvas text-ink-secondary border border-line',
        'danger' => 'bg-danger/10 text-danger',
        'warning' => 'bg-warning-light text-warning',
        'dark' => 'bg-ink text-white',
    ];

    $resolved = $tone;
    if (! $resolved && $status !== null) {
        $key = strtolower((string) $status);
        $resolved = $statusTones[$key] ?? 'muted';
    }
    $resolved = $resolved ?: 'brand';
    $label = $slot->isEmpty() && $status !== null ? ucfirst(str_replace('_', ' ', (string) $status)) : $slot;
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ' . ($tones[$resolved] ?? $tones['brand'])]) }}>
    {{ $label }}
</span>
