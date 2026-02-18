@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 mb-4">
    <h1 class="admin-page-title mb-0">Edit Blog Post</h1>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-sm flex-md-shrink-0">Back to list</a>
</div>

<div class="card admin-card admin-form-card shadow-sm">
    <div class="card-header">Edit Blog Post</div>
    <div class="card-body">
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $blog->category) }}">
                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Author</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $blog->author) }}">
                    @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="2">{{ old('excerpt', $blog->excerpt) }}</textarea>
                    @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="10">{{ old('content', $blog->content) }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Featured image</label>
                    @if($blog->featured_image)
                        <div class="file-preview mb-2">
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="" class="rounded">
                            <span class="text-muted small d-block mt-1">Current image. Upload new to replace.</span>
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                    <small class="text-muted">JPEG, PNG, GIF, WebP. Max 2MB.</small>
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        @foreach(['published','draft','archived'] as $s)
                            <option value="{{ $s }}" {{ old('status', $blog->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr class="my-4">
            <div class="admin-form-actions">
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">Back to list</a>
            </div>
        </form>
    </div>
</div>
@endsection
