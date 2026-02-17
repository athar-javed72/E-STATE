@extends('layouts.app')

@section('title', isset($currentCategory) ? 'Blog: ' . $currentCategory . ' - FindState' : 'Blog - FindState')
@section('meta_description', 'Real estate tips, market trends, and news from FindState.')

@section('content')
{{-- Breadcrumb --}}
<section class="breadcrumb-section py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h2 mb-0 fw-bold">{{ isset($currentCategory) ? 'Category: ' . $currentCategory : 'Blog' }}</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                        @if(isset($currentCategory))
                            <li class="breadcrumb-item active" aria-current="page">{{ $currentCategory }}</li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">All Posts</li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('blog.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search posts...">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                @if($blogs->count() > 0)
                    <div class="row g-4">
                        @foreach($blogs as $blog)
                            <div class="col-12">
                                <article class="card border-0 shadow-sm h-100">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="{{ $blog->featured_image ? asset('storage/blogs/' . $blog->featured_image) : asset('assets/images/placeholder-600x400.svg') }}"
                                                 class="img-fluid rounded-start" alt="{{ $blog->title }}" style="height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>{{ $blog->created_at->format('M d, Y') }}
                                                    @if($blog->category)
                                                        <span class="ms-2"><i class="fas fa-tag me-1"></i>{{ $blog->category }}</span>
                                                    @endif
                                                </small>
                                                <h3 class="h5 card-title mt-2">
                                                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">{{ $blog->title }}</a>
                                                </h3>
                                                <p class="card-text text-muted">{{ Str::limit(strip_tags($blog->excerpt ?: $blog->content), 150) }}</p>
                                                <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $blogs->withQueryString()->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                        <h3>No posts found</h3>
                        <p class="text-muted">Try a different search or category.</p>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Categories</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ route('blog.index') }}" class="text-decoration-none {{ !isset($currentCategory) ? 'fw-bold text-primary' : 'text-muted' }}">All</a></li>
                            @foreach($categories as $cat)
                                <li><a href="{{ route('blog.category', $cat) }}" class="text-decoration-none {{ (isset($currentCategory) && $currentCategory == $cat) ? 'fw-bold text-primary' : 'text-muted' }}">{{ $cat }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @if($recentPosts->count() > 0)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Recent Posts</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($recentPosts as $post)
                                    <li class="mb-3">
                                        <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark">{{ Str::limit($post->title, 50) }}</a>
                                        <br><small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
