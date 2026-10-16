@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'align' => 'left',
])

@php
    $alignClass = $align === 'center' ? 'text-center mx-auto' : 'text-left';
@endphp

<div {{ $attributes->merge(['class' => 'max-w-2xl ' . $alignClass]) }}>
    @if($eyebrow)
        <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-brand">{{ $eyebrow }}</p>
    @endif
    <h2 class="text-xl sm:text-2xl font-bold text-ink">{{ $title }}</h2>
    @if($subtitle)
        <p class="mt-2 text-sm text-ink-secondary">{{ $subtitle }}</p>
    @endif
</div>
