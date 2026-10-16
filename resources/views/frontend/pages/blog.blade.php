@extends('layouts.app')

@section('title', 'Blog - FindState')
@section('meta_description', 'Market insights and real estate tips from FindState.')

@section('content')
<section class="border-b border-line bg-white py-8">
    <div class="container-page">
        <h1 class="text-xl font-bold text-ink sm:text-2xl">Blog</h1>
        <p class="mt-2 text-sm text-ink-secondary">Guides, tips, and local market notes.</p>
    </div>
</section>

<section class="py-10">
    <div class="container-page grid grid-cols-1 gap-8 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <form method="GET" class="mb-6 flex flex-col gap-3 sm:flex-row">
                <x-input name="search" placeholder="Search posts..." :value="request('search')" class="flex-1" />
                <x-button variant="primary" type="submit">Search</x-button>
            </form>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                @forelse($blogs as $blog)
                    <x-blog-card :blog="$blog" />
                @empty
                    <p class="col-span-full text-sm text-ink-muted">No posts found.</p>
                @endforelse
            </div>
            <div class="mt-8">{{ $blogs->withQueryString()->links('vendor.pagination.tailwind') }}</div>
        </div>
        <aside class="space-y-6 lg:col-span-4">
            <div class="rounded-md border border-line bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-ink">Categories</h2>
                <ul class="mt-4 space-y-2">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('blog.category', $category) }}" class="text-sm text-ink-secondary hover:text-brand">{{ $category }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="rounded-md border border-line bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-ink">Recent</h2>
                <ul class="mt-4 space-y-3">
                    @foreach($recentPosts as $post)
                        <li>
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-sm font-medium text-ink hover:text-brand">{{ $post->title }}</a>
                            <p class="text-xs text-ink-muted">{{ $post->created_at->format('M d, Y') }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>
</section>
@endsection
