@extends('layouts.app')

@section('title', 'Properties - FindState')
@section('meta_description', 'Browse our listings of properties for sale and rent. Filter by type, price, location, and more.')

@section('content')
{{-- Breadcrumb --}}
<section class="breadcrumb-section py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h2 mb-0 fw-bold">Properties</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Properties</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

{{-- Filters --}}
<section class="py-3 border-bottom">
    <div class="container">
        <form action="{{ route('properties.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-2">
                <label class="form-label small fw-bold">Search</label>
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Location, title...">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">Type</label>
                <select class="form-select" name="type">
                    <option value="">All Types</option>
                    @foreach($propertyTypes as $t)
                        <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">Listing</label>
                <select class="form-select" name="listing_type">
                    <option value="">All</option>
                    <option value="for_sale" {{ request('listing_type') == 'for_sale' ? 'selected' : '' }}>For Sale</option>
                    <option value="for_rent" {{ request('listing_type') == 'for_rent' ? 'selected' : '' }}>For Rent</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">Min Price</label>
                <input type="number" class="form-control" name="min_price" value="{{ request('min_price') }}" placeholder="0" min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">Max Price</label>
                <input type="number" class="form-control" name="max_price" value="{{ request('max_price') }}" placeholder="{{ $maxPrice ?? '' }}" min="0">
            </div>
            <div class="col-md-2">
                <input type="hidden" name="sort" value="{{ request('sort', 'latest') }}">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-2"></i>Search</button>
            </div>
        </form>
        <div class="mt-2 d-flex flex-wrap gap-2">
            <span class="small text-muted">Sort:</span>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" class="badge bg-{{ request('sort', 'latest') == 'latest' ? 'primary' : 'light text-dark' }} text-decoration-none">Latest</a>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" class="badge bg-{{ request('sort') == 'price_low' ? 'primary' : 'light text-dark' }} text-decoration-none">Price: Low to High</a>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" class="badge bg-{{ request('sort') == 'price_high' ? 'primary' : 'light text-dark' }} text-decoration-none">Price: High to Low</a>
        </div>
    </div>
</section>

{{-- Property List --}}
<section class="py-5">
    <div class="container">
        @if($properties->count() > 0)
            <div class="row g-4">
                @foreach($properties as $property)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.property-card', ['property' => $property])
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-5">
                {{ $properties->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-4x text-muted mb-3"></i>
                <h3>No properties found</h3>
                <p class="text-muted">Try adjusting your filters or search terms.</p>
                <a href="{{ route('properties.index') }}" class="btn btn-primary">Clear filters</a>
            </div>
        @endif
    </div>
</section>
@endsection
