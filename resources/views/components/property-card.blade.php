@props(['property'])

@php
    use App\Support\Media;
    $imageUrl = Media::url($property->featured_image);
    $isRent = $property->listing_type === 'for_rent';
    $inWishlist = in_array($property->id, session('wishlist', []), true);
@endphp

<article {{ $attributes->merge(['class' => 'group relative flex h-full flex-col overflow-hidden rounded-md bg-white shadow-sm transition-ui hover:shadow-lg']) }}>
    <div class="relative aspect-4-3 overflow-hidden bg-canvas">
        <a href="{{ route('properties.show', $property->slug) }}" class="absolute inset-0 block focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand" aria-label="{{ $property->title }}">
            @if($imageUrl)
                <img
                    src="{{ $imageUrl }}"
                    alt="{{ $property->title }}"
                    class="h-full w-full object-cover transition-ui group-hover:scale-[1.02]"
                    loading="lazy"
                    width="800"
                    height="600"
                >
            @else
                <div class="flex h-full w-full items-center justify-center bg-slate-200 text-ink-muted" aria-hidden="true">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7.5A2.5 2.5 0 015.5 5h13A2.5 2.5 0 0121 7.5v9a2.5 2.5 0 01-2.5 2.5h-13A2.5 2.5 0 013 16.5v-9z"/></svg>
                </div>
            @endif
        </a>

        <div class="pointer-events-none absolute left-4 top-4 z-10">
            <x-badge :tone="$isRent ? 'accent' : 'brand'">
                {{ $isRent ? 'For Rent' : 'For Sale' }}
            </x-badge>
        </div>

        <button
            type="button"
            class="js-wishlist-toggle absolute right-4 top-4 z-10 inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/95 text-ink shadow-sm transition-ui hover:bg-white"
            data-property-id="{{ $property->id }}"
            data-wishlist-url="{{ route('api.property.wishlist', $property) }}"
            aria-label="Toggle wishlist"
        >
            <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart text-sm {{ $inWishlist ? 'text-danger' : '' }}" id="wishlist-{{ $property->id }}"></i>
        </button>
    </div>

    <a href="{{ route('properties.show', $property->slug) }}" class="flex flex-1 flex-col p-4 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
        <p class="text-lg font-bold text-ink">
            ${{ number_format($property->price) }}@if($isRent)<span class="text-sm font-medium text-ink-muted">/mo</span>@endif
        </p>
        <h3 class="mt-1 line-clamp-2 text-base font-semibold text-ink">{{ $property->title }}</h3>
        <p class="mt-2 flex items-start gap-2 text-sm text-ink-muted">
            <i class="fas fa-map-marker-alt mt-0.5 text-brand" aria-hidden="true"></i>
            <span>{{ $property->city }}@if($property->state), {{ $property->state }}@endif</span>
        </p>

        <div class="mt-4 flex items-center gap-4 border-t border-line pt-4 text-xs font-medium text-ink-secondary">
            @if($property->bedrooms)
                <span class="inline-flex items-center gap-1"><i class="fas fa-bed text-brand" aria-hidden="true"></i>{{ $property->bedrooms }} Beds</span>
            @endif
            @if($property->bathrooms)
                <span class="inline-flex items-center gap-1"><i class="fas fa-bath text-brand" aria-hidden="true"></i>{{ $property->bathrooms }} Baths</span>
            @endif
            @if($property->area)
                <span class="inline-flex items-center gap-1"><i class="fas fa-ruler-combined text-brand" aria-hidden="true"></i>{{ number_format($property->area) }} sqft</span>
            @endif
        </div>
    </a>
</article>
