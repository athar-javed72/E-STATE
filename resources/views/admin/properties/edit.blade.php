@extends('admin.layouts.app')

@section('title', 'Edit Property')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 mb-4">
    <h1 class="admin-page-title mb-0">Edit Property</h1>
    <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary btn-sm flex-md-shrink-0">Back to list</a>
</div>

<div class="card admin-card admin-form-card shadow-sm">
    <div class="card-header">Edit Property</div>
    <div class="card-body">
        <form action="{{ route('admin.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $property->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Agent</label>
                    <select name="agent_id" class="form-select @error('agent_id') is-invalid @enderror">
                        <option value="">— None —</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ old('agent_id', $property->agent_id) == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                        @endforeach
                    </select>
                    @error('agent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $property->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $property->address) }}">
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $property->city) }}">
                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $property->state) }}">
                    @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">ZIP</label>
                    <input type="text" name="zip" class="form-control @error('zip') is-invalid @enderror" value="{{ old('zip', $property->zip) }}">
                    @error('zip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        @foreach(['house','apartment','condo','villa'] as $t)
                            <option value="{{ $t }}" {{ old('type', $property->type) === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Listing type <span class="text-danger">*</span></label>
                    <select name="listing_type" class="form-select @error('listing_type') is-invalid @enderror" required>
                        <option value="for_sale" {{ old('listing_type', $property->listing_type) === 'for_sale' ? 'selected' : '' }}>For Sale</option>
                        <option value="for_rent" {{ old('listing_type', $property->listing_type) === 'for_rent' ? 'selected' : '' }}>For Rent</option>
                    </select>
                    @error('listing_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Price <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $property->price) }}" min="0" step="0.01" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-2">
                    <label class="form-label">Bedrooms</label>
                    <input type="number" name="bedrooms" class="form-control @error('bedrooms') is-invalid @enderror" value="{{ old('bedrooms', $property->bedrooms) }}" min="0">
                    @error('bedrooms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Bathrooms</label>
                    <input type="number" name="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms', $property->bathrooms) }}" min="0">
                    @error('bathrooms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Area (sqft)</label>
                    <input type="number" name="area" class="form-control @error('area') is-invalid @enderror" value="{{ old('area', $property->area) }}" min="0">
                    @error('area')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Parking</label>
                    <input type="number" name="parking" class="form-control @error('parking') is-invalid @enderror" value="{{ old('parking', $property->parking) }}" min="0">
                    @error('parking')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Featured image</label>
                    @if($property->featured_image)
                        <div class="file-preview mb-2">
                            <img src="{{ asset('storage/' . $property->featured_image) }}" alt="" class="rounded">
                            <span class="text-muted small d-block mt-1">Current image. Upload new to replace.</span>
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                    <small class="text-muted">JPEG, PNG, GIF, WebP. Max 2MB.</small>
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        @foreach(['active','sold','pending','inactive'] as $s)
                            <option value="{{ $s }}" {{ old('status', $property->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" value="1" class="form-check-input" {{ old('featured', $property->featured) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <div class="admin-form-actions">
                <button type="submit" class="btn btn-primary">Update Property</button>
                <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary">Back to list</a>
            </div>
        </form>
    </div>
</div>
@endsection
