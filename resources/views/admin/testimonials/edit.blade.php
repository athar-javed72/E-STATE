@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 mb-4">
    <h1 class="admin-page-title mb-0">Edit Testimonial</h1>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary btn-sm flex-md-shrink-0">Back to list</a>
</div>

<div class="card admin-card admin-form-card shadow-sm">
    <div class="card-header">Edit: {{ $testimonial->name }}</div>
    <div class="card-body">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $testimonial->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Designation</label>
                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $testimonial->designation) }}">
                    @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $testimonial->location) }}">
                    @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-select @error('rating') is-invalid @enderror">
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ (int) old('rating', $testimonial->rating) === $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="active" {{ old('status', $testimonial->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $testimonial->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="4" required>{{ old('content', $testimonial->content) }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image</label>
                    @if($testimonial->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="" style="max-height: 80px;" class="rounded">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                    <small class="text-muted">Leave empty to keep current image.</small>
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Testimonial</button>
            </div>
        </form>
    </div>
</div>
@endsection
