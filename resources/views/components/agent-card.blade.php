@props(['agent'])

@php
    use App\Support\Media;
    $avatar = Media::url($agent->avatar);
@endphp

<article {{ $attributes->merge(['class' => 'h-full']) }}>
    <a href="{{ route('agents.show', $agent->slug) }}" class="flex h-full flex-col overflow-hidden rounded-md bg-white p-4 shadow-sm transition-ui hover:shadow-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
        <div class="mx-auto aspect-square w-24 overflow-hidden rounded-full bg-canvas">
            @if($avatar)
                <img src="{{ $avatar }}" alt="{{ $agent->name }}" class="h-full w-full object-cover" loading="lazy" width="96" height="96">
            @else
                <div class="flex h-full w-full items-center justify-center text-ink-muted" aria-hidden="true">
                    <i class="fas fa-user text-xl"></i>
                </div>
            @endif
        </div>
        <h3 class="mt-4 text-center text-base font-semibold text-ink">{{ $agent->name }}</h3>
        <p class="mt-1 text-center text-sm text-ink-secondary">{{ $agent->designation ?? 'Real Estate Agent' }}</p>
        @if($agent->rating)
            <p class="mt-2 text-center text-xs font-medium text-brand">{{ number_format($agent->rating, 1) }} ★</p>
        @endif
    </a>
</article>
