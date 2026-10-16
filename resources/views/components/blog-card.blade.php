@props(['blog'])

@php
    use App\Support\Media;
    $imageUrl = Media::url($blog->featured_image);
@endphp

<article {{ $attributes->merge(['class' => 'h-full']) }}>
    <a href="{{ route('blog.show', $blog->slug) }}" class="flex h-full flex-col overflow-hidden rounded-md bg-white shadow-sm transition-ui hover:shadow-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
        <div class="aspect-4-3 overflow-hidden bg-canvas">
            @if($imageUrl)
                <img src="{{ $imageUrl }}" alt="{{ $blog->title }}" class="h-full w-full object-cover" loading="lazy" width="800" height="600">
            @else
                <div class="flex h-full w-full items-center justify-center bg-slate-200 text-ink-muted" aria-hidden="true">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
            @endif
        </div>
        <div class="flex flex-1 flex-col p-4">
            @if($blog->category)
                <x-badge tone="muted">{{ $blog->category }}</x-badge>
            @endif
            <h3 class="mt-2 line-clamp-2 text-base font-semibold text-ink">{{ $blog->title }}</h3>
            <p class="mt-2 line-clamp-2 text-sm text-ink-secondary">{{ Str::limit(strip_tags($blog->excerpt ?: $blog->content), 100) }}</p>
            <p class="mt-auto pt-4 text-xs text-ink-muted">{{ $blog->created_at->format('M d, Y') }}</p>
        </div>
    </a>
</article>
