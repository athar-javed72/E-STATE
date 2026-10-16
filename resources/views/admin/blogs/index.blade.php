@extends('admin.layouts.app')

@section('title', 'Blogs')

@section('content')
@php use App\Support\Media; @endphp
<x-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Blogs'],
]" />

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Blog Posts</h1>
    <x-button variant="primary" href="{{ route('admin.blogs.create') }}">Add Post</x-button>
</div>

<form method="GET" class="mb-6 grid grid-cols-1 gap-3 rounded-md border border-line bg-white p-4 shadow-sm sm:grid-cols-3">
    <x-input name="search" label="Search" placeholder="Search title, category, author..." :value="request('search')" />
    <x-select name="status" label="Status">
        <option value="">All statuses</option>
        <option value="published" @selected(request('status') === 'published')>Published</option>
        <option value="draft" @selected(request('status') === 'draft')>Draft</option>
        <option value="archived" @selected(request('status') === 'archived')>Archived</option>
    </x-select>
    <div class="flex items-end">
        <x-button variant="ghost" type="submit" block>Filter</x-button>
    </div>
</form>

<div class="overflow-hidden rounded-md border border-line bg-white shadow-sm">
    <div class="overflow-x-auto xl:overflow-visible">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-canvas text-xs uppercase text-ink-muted">
                <tr>
                    <th class="px-4 py-3 font-semibold">Image</th>
                    <th class="px-4 py-3 font-semibold">Title</th>
                    <th class="px-4 py-3 font-semibold">Category</th>
                    <th class="px-4 py-3 font-semibold">Author</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3">
                            @php $image = Media::url($blog->featured_image); @endphp
                            @if($image)
                                <img src="{{ $image }}" alt="{{ $blog->title }}" class="h-12 w-16 rounded-sm object-cover" loading="lazy" width="64" height="48">
                            @else
                                <span class="text-xs text-ink-muted">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-ink">{{ Str::limit($blog->title, 40) }}</td>
                        <td class="px-4 py-3 text-ink-secondary">{{ $blog->category ?? '—' }}</td>
                        <td class="px-4 py-3 text-ink-secondary">{{ $blog->author ?? '—' }}</td>
                        <td class="px-4 py-3"><x-badge :status="$blog->status" /></td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap items-center justify-end gap-2">
                                <x-button variant="secondary" href="{{ route('admin.blogs.edit', $blog) }}">Edit</x-button>
                                <x-confirm-delete
                                    :action="route('admin.blogs.destroy', $blog)"
                                    title="Delete post?"
                                    message="Delete “{{ $blog->title }}”? This cannot be undone."
                                />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-ink-muted">No blog posts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($blogs->hasPages())
        <div class="border-t border-line p-4">{{ $blogs->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
