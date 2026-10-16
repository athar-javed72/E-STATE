@extends('layouts.app')

@section('title', $blog->title . ' - FindState')
@section('meta_description', Str::limit(strip_tags($blog->excerpt ?: $blog->content), 160))

@section('content')
{{-- Breadcrumb --}}
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 40) }}</li>
            </ol>
        </nav>
    </div>
</section>

<article class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <header class="mb-4">
                    @if($blog->category)
                        <a href="{{ route('blog.category', $blog->category) }}" class="badge bg-primary text-decoration-none mb-2">{{ $blog->category }}</a>
                    @endif
                    <h1 class="display-6 fw-bold">{{ $blog->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-calendar me-2"></i>{{ $blog->created_at->format('F j, Y') }}
                        @if($blog->author)
                            <span class="ms-3"><i class="fas fa-user me-2"></i>{{ $blog->author }}</span>
                        @endif
                        <span class="ms-3"><i class="fas fa-eye me-2"></i>{{ $blog->views }} views</span>
                    </p>
                </header>
                @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">
                @else
                    <img src="{{ asset('assets/images/placeholder-600x400.svg') }}" class="img-fluid rounded mb-4" alt="">
                @endif
                <div class="blog-content">
                    {!! $blog->safeContent() !!}
                </div>
                <hr class="my-5">
                @if($relatedPosts->count() > 0)
                    <h4 class="fw-bold mb-4">Related Posts</h4>
                    <div class="row g-3">
                        @foreach($relatedPosts as $rel)
                            <div class="col-md-4">
                                <a href="{{ route('blog.show', $rel->slug) }}" class="text-decoration-none text-dark">
                                    <div class="card border-0 shadow-sm h-100">
                                        <img src="{{ $rel->featured_image ? asset('storage/' . $rel->featured_image) : asset('assets/images/placeholder-600x400.svg') }}"
                                             class="card-img-top" alt="{{ $rel->title }}" style="height: 140px; object-fit: cover;">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ Str::limit($rel->title, 50) }}</h6>
                                            <small class="text-muted">{{ $rel->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</article>
@endsection
