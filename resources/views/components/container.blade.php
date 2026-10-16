@props([])

@php
    $base = 'mx-auto w-full px-4 sm:px-6 lg:px-8 2xl:px-12';
    $userClass = (string) ($attributes->get('class') ?? '');
    if (! preg_match('/\bmax-w-/', $userClass)) {
        $base .= ' max-w-[1440px]';
    }
@endphp

<div {{ $attributes->merge(['class' => $base]) }}>
    {{ $slot }}
</div>
