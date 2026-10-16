@props([
    'question',
    'open' => false,
])

<details
    {{ $attributes->merge(['class' => 'group rounded-sm border border-line bg-white px-5 py-4']) }}
    @if($open) open @endif
>
    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left text-sm font-semibold text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand [&::-webkit-details-marker]:hidden">
        <span>{{ $question }}</span>
        <svg class="h-5 w-5 shrink-0 text-ink-muted transition-ui group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </summary>
    <div class="mt-3 text-sm text-ink-secondary">
        {{ $slot }}
    </div>
</details>
