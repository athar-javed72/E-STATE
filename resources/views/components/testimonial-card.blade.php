@props(['testimonial'])

@php
    use App\Support\Media;
    $imageUrl = Media::url($testimonial->image);
@endphp

<figure {{ $attributes->merge(['class' => 'h-full rounded-md bg-white p-6 shadow-sm']) }}>
    <div class="mb-4 flex gap-1 text-brand" aria-label="{{ $testimonial->rating }} out of 5 stars">
        @for($i = 1; $i <= 5; $i++)
            <i class="fas fa-star text-xs {{ $i <= ($testimonial->rating ?? 5) ? '' : 'text-line' }}" aria-hidden="true"></i>
        @endfor
    </div>
    <blockquote class="text-sm text-ink-secondary">“{{ $testimonial->content }}”</blockquote>
    <figcaption class="mt-6 flex items-center gap-3">
        <div class="h-11 w-11 overflow-hidden rounded-full bg-canvas">
            @if($imageUrl)
                <img src="{{ $imageUrl }}" alt="{{ $testimonial->name }}" class="h-full w-full object-cover" loading="lazy" width="44" height="44">
            @else
                <div class="flex h-full w-full items-center justify-center text-ink-muted"><i class="fas fa-user"></i></div>
            @endif
        </div>
        <div>
            <p class="text-sm font-semibold text-ink">{{ $testimonial->name }}</p>
            <p class="text-xs text-ink-muted">{{ $testimonial->designation }}@if($testimonial->location) · {{ $testimonial->location }}@endif</p>
        </div>
    </figcaption>
</figure>
