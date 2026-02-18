@extends('admin.layouts.app')

@section('title', 'Edit Agent')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 mb-4">
    <h1 class="admin-page-title mb-0">Edit Agent</h1>
    <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary btn-sm flex-md-shrink-0">Back to list</a>
</div>

<div class="card admin-card admin-form-card shadow-sm">
    <div class="card-header">Edit Agent</div>
    <div class="card-body">
        <form action="{{ route('admin.agents.update', $agent) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $agent->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $agent->email) }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $agent->phone) }}">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Designation</label>
                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $agent->designation) }}">
                    @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="3">{{ old('bio', $agent->bio) }}</textarea>
                    @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Avatar</label>
                    @if($agent->avatar)
                        <div class="file-preview mb-2">
                            <img src="{{ asset('storage/' . $agent->avatar) }}" alt="" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                            <span class="text-muted small d-block mt-1">Current. Upload new to replace.</span>
                        </div>
                    @endif
                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                    <small class="text-muted">JPEG, PNG, GIF, WebP. Max 2MB.</small>
                    @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Experience (years)</label>
                    <input type="number" name="experience" class="form-control @error('experience') is-invalid @enderror" value="{{ old('experience', $agent->experience) }}" min="0" max="50">
                    @error('experience')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Rating (0–5)</label>
                    <input type="number" name="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating', $agent->rating) }}" min="0" max="5" step="0.01">
                    @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Facebook URL</label>
                    <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $agent->facebook) }}">
                    @error('facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Twitter URL</label>
                    <input type="text" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $agent->twitter) }}">
                    @error('twitter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">LinkedIn</label>
                    <input type="text" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $agent->linkedin) }}">
                    @error('linkedin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Instagram</label>
                    <input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $agent->instagram) }}">
                    @error('instagram')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="active" {{ old('status', $agent->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $agent->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check">
                        <input type="hidden" name="is_online" value="0">
                        <input type="checkbox" name="is_online" value="1" class="form-check-input" {{ old('is_online', $agent->is_online) ? 'checked' : '' }}>
                        <label class="form-check-label">Online</label>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <div class="admin-form-actions">
                <button type="submit" class="btn btn-primary">Update Agent</button>
                <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary">Back to list</a>
            </div>
        </form>
    </div>
</div>
@endsection
