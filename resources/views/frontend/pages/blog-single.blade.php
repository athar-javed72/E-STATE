@extends('layouts.app')

@section('title', $blog->title . ' - FindState')
@section('meta_description', Str::limit(strip_tags($blog->excerpt ?: $blog->content), 160))

@php
    use App\Support\Media;
    $imageUrl = Media::url($blog->featured_image);
@endphp

@section('content')
<article class="py-10">
    <x-container>
        <div class="mx-auto w-full max-w-prose">
        @if($blog->category)
            <x-badge tone="muted">{{ $blog->category }}</x-badge>
        @endif
        <h1 class="mt-3 text-xl font-bold text-ink sm:text-2xl">{{ $blog->title }}</h1>
        <p class="mt-3 text-sm text-ink-muted">
            {{ $blog->created_at->format('F j, Y') }}
            @if($blog->author) · {{ $blog->author }}@endif
            · {{ $blog->views }} views
        </p>

        <div class="mt-8 overflow-hidden rounded-md bg-canvas">
            @if($imageUrl)
                <img src="{{ $imageUrl }}" alt="{{ $blog->title }}" class="aspect-4-3 w-full object-cover" width="1200" height="900">
            @endif
        </div>

        <div class="prose-none mt-8 space-y-4 text-sm leading-relaxed text-ink-secondary [&_a]:text-brand [&_h2]:text-lg [&_h2]:font-semibold [&_h2]:text-ink [&_h3]:text-base [&_h3]:font-semibold [&_h3]:text-ink [&_ul]:list-disc [&_ul]:pl-5">
            {!! $blog->safeContent() !!}
        </div>

        @if(isset($relatedPosts) && $relatedPosts->count())
            <h2 class="mt-16 text-lg font-semibold text-ink">Related posts</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                @foreach($relatedPosts as $rel)
                    <x-blog-card :blog="$rel" />
                @endforeach
            </div>
        @endif
        </div>
    </x-container>
</article>
@endsection
