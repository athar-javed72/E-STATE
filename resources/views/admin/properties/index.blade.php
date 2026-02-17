@extends('admin.layouts.app')

@section('title', 'Properties')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 gap-md-0 mb-3 mb-md-4">
    <h1 class="h4 h3 mb-0">Properties</h1>
    <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm flex-md-shrink-0">
        <i class="fas fa-plus me-1"></i>Add Property
    </a>
</div>

<form method="GET" class="row g-2 mb-3 mb-md-4">
    <div class="col-12 col-sm-6 col-md-3">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
    </div>
    <div class="col-6 col-md-2">
        <select name="status" class="form-select form-select-sm">
            <option value="">All statuses</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="sold" {{ request('status') === 'sold' ? 'selected' : '' }}>Sold</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <div class="col-6 col-md-2">
        <select name="type" class="form-select form-select-sm">
            <option value="">All types</option>
            <option value="house" {{ request('type') === 'house' ? 'selected' : '' }}>House</option>
            <option value="apartment" {{ request('type') === 'apartment' ? 'selected' : '' }}>Apartment</option>
            <option value="condo" {{ request('type') === 'condo' ? 'selected' : '' }}>Condo</option>
            <option value="villa" {{ request('type') === 'villa' ? 'selected' : '' }}>Villa</option>
        </select>
    </div>
    <div class="col-12 col-md-2">
        <button type="submit" class="btn btn-outline-primary btn-sm w-100 w-md-auto">Filter</button>
    </div>
</form>

<div class="card shadow-sm border-0 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive overflow-x-auto">
            <table class="table table-hover align-middle mb-0 table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Listing</th>
                        <th>City</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                        <tr>
                            <td>
                                @if($property->featured_image)
                                    <img src="{{ asset('storage/' . $property->featured_image) }}" alt="" class="rounded" style="width: 50px; height: 40px; object-fit: cover;">
                                @else
                                    <span class="text-muted small">No image</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($property->title, 35) }}</td>
                            <td>{{ ucfirst($property->type) }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $property->listing_type)) }}</td>
                            <td>{{ $property->city ?? '—' }}</td>
                            <td>${{ number_format($property->price) }}</td>
                            <td><span class="badge bg-{{ $property->status === 'active' ? 'success' : ($property->status === 'sold' ? 'secondary' : 'warning') }}">{{ ucfirst($property->status) }}</span></td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this property?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted py-4">No properties found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($properties->hasPages())
        <div class="card-footer bg-white border-0 overflow-auto">
            {{ $properties->links() }}
        </div>
    @endif
</div>
@endsection
