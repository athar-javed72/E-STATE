@extends('admin.layouts.app')

@section('title', 'Add Blog Post')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 mb-3 mb-md-4">
    <h1 class="h4 h3 mb-0">Add Blog Post</h1>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-sm flex-md-shrink-0">Back to list</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-3 p-md-4">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}">
                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Author</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author') }}">
                    @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Excerpt</label>
                    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="2">{{ old('excerpt') }}</textarea>
                    @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="10">{{ old('content') }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Featured image</label>
                    <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                    <small class="text-muted">JPEG, PNG, GIF, WebP. Max 2MB.</small>
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr class="my-4">
            <button type="submit" class="btn btn-primary">Create Post</button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
