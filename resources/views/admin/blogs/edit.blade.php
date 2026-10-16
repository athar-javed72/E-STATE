@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')

@section('content')
@php use App\Support\Media; @endphp
<x-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Blogs', 'url' => route('admin.blogs.index')],
    ['label' => 'Edit'],
]" />

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Edit Blog Post</h1>
    <x-button variant="ghost" href="{{ route('admin.blogs.index') }}">Back to list</x-button>
</div>

<div class="w-full max-w-5xl rounded-md border border-line bg-white p-6 shadow-sm">
    <p class="mb-6 text-sm font-semibold text-ink-secondary">Edit Blog Post</p>

    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-input label="Title" name="title" :value="old('title', $blog->title)" required class="md:col-span-2" />
            <x-input label="Category" name="category" :value="old('category', $blog->category)" />
            <x-input label="Author" name="author" :value="old('author', $blog->author)" />

            <div class="w-full md:col-span-2">
                <label for="excerpt" class="mb-1 block text-xs font-semibold text-ink">Excerpt</label>
                <textarea id="excerpt" name="excerpt" rows="2" class="w-full rounded-sm border border-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-muted transition-ui focus:border-brand focus:ring-2 focus:ring-brand/20 @error('excerpt') border-danger @enderror">{{ old('excerpt', $blog->excerpt) }}</textarea>
                @error('excerpt')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full md:col-span-2">
                <label for="content" class="mb-1 block text-xs font-semibold text-ink">Content</label>
                <textarea id="content" name="content" rows="10" class="w-full rounded-sm border border-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-muted transition-ui focus:border-brand focus:ring-2 focus:ring-brand/20 @error('content') border-danger @enderror">{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full">
                <label for="featured_image" class="mb-1 block text-xs font-semibold text-ink">Featured image</label>
                @php $imageUrl = Media::url($blog->featured_image); @endphp
                @if($imageUrl)
                    <div class="mb-3">
                        <p class="mb-1 text-xs font-semibold text-ink-muted">Current image</p>
                        <img src="{{ $imageUrl }}" alt="{{ $blog->title }}" class="max-h-40 rounded-sm object-cover">
                        <p class="mt-1 text-xs text-ink-muted">Upload a new file to replace.</p>
                    </div>
                @endif
                <input id="featured_image" type="file" name="featured_image" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="block w-full text-sm text-ink-secondary file:mr-4 file:inline-flex file:h-11 file:items-center file:rounded-sm file:border-0 file:bg-brand-light file:px-4 file:text-sm file:font-semibold file:text-brand">
                <p class="mt-1 text-xs text-ink-muted">JPEG, PNG, GIF, WebP. Max 2MB.</p>
                @error('featured_image')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <x-select label="Status" name="status">
                @foreach(['published','draft','archived'] as $s)
                    <option value="{{ $s }}" @selected(old('status', $blog->status) === $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </x-select>
        </div>

        <div class="mt-8 flex flex-wrap gap-3 border-t border-line pt-6">
            <x-button type="submit">Update Post</x-button>
            <x-button variant="ghost" href="{{ route('admin.blogs.index') }}">Back to list</x-button>
        </div>
    </form>
</div>
@endsection
