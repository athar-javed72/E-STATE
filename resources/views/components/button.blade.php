@props([
    'variant' => 'primary',
    'type' => 'button',
    'href' => null,
    'block' => false,
    'height' => 44,
])

@php
    $h = ((int) $height === 48) ? 'h-12' : 'h-11';
    $base = "inline-flex items-center justify-center gap-2 {$h} px-5 rounded-sm text-sm font-semibold transition-ui focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 disabled:opacity-50 disabled:pointer-events-none";
    $variants = [
        'primary' => 'bg-brand text-white hover:bg-brand/90 focus-visible:outline-brand',
        'secondary' => 'bg-brand-light text-brand hover:bg-brand-light/80 focus-visible:outline-brand',
        'ghost' => 'bg-transparent text-ink border border-line hover:bg-canvas focus-visible:outline-brand',
        'danger' => 'bg-danger text-white hover:bg-danger/90 focus-visible:outline-danger',
    ];
    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']) . ($block ? ' w-full' : '');
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
