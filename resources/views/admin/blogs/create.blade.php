@extends('admin.layouts.app')

@section('title', 'Add Blog Post')

@section('content')
<x-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Blogs', 'url' => route('admin.blogs.index')],
    ['label' => 'Add'],
]" />

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Add Blog Post</h1>
    <x-button variant="ghost" href="{{ route('admin.blogs.index') }}">Back to list</x-button>
</div>

<div class="w-full max-w-5xl rounded-md border border-line bg-white p-6 shadow-sm">
    <p class="mb-6 text-sm font-semibold text-ink-secondary">New Blog Post</p>

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-input label="Title" name="title" :value="old('title')" required class="md:col-span-2" />
            <x-input label="Category" name="category" :value="old('category')" />
            <x-input label="Author" name="author" :value="old('author')" />

            <div class="w-full md:col-span-2">
                <label for="excerpt" class="mb-1 block text-xs font-semibold text-ink">Excerpt</label>
                <textarea id="excerpt" name="excerpt" rows="2" class="w-full rounded-sm border border-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-muted transition-ui focus:border-brand focus:ring-2 focus:ring-brand/20 @error('excerpt') border-danger @enderror">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full md:col-span-2">
                <label for="content" class="mb-1 block text-xs font-semibold text-ink">Content</label>
                <textarea id="content" name="content" rows="10" class="w-full rounded-sm border border-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-muted transition-ui focus:border-brand focus:ring-2 focus:ring-brand/20 @error('content') border-danger @enderror">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full">
                <label for="featured_image" class="mb-1 block text-xs font-semibold text-ink">Featured image</label>
                <input id="featured_image" type="file" name="featured_image" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="block w-full text-sm text-ink-secondary file:mr-4 file:inline-flex file:h-11 file:items-center file:rounded-sm file:border-0 file:bg-brand-light file:px-4 file:text-sm file:font-semibold file:text-brand">
                <p class="mt-1 text-xs text-ink-muted">JPEG, PNG, GIF, WebP. Max 2MB.</p>
                @error('featured_image')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <x-select label="Status" name="status">
                <option value="published" @selected(old('status', 'published') === 'published')>Published</option>
                <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                <option value="archived" @selected(old('status') === 'archived')>Archived</option>
            </x-select>
        </div>

        <div class="mt-8 flex flex-wrap gap-3 border-t border-line pt-6">
            <x-button type="submit">Create Post</x-button>
            <x-button variant="ghost" href="{{ route('admin.blogs.index') }}">Back to list</x-button>
        </div>
    </form>
</div>
@endsection
