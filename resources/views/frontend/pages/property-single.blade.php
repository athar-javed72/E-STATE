@extends('layouts.app')

@section('title', $property->title . ' - FindState')
@section('meta_description', Str::limit(strip_tags($property->description), 160))

@section('content')
{{-- Breadcrumb --}}
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Properties</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($property->title, 40) }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                    <img src="{{ $property->featured_image ? asset('storage/properties/' . $property->featured_image) : asset('assets/images/placeholder-600x400.svg') }}"
                         class="card-img-top" alt="{{ $property->title }}" style="max-height: 450px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-primary">{{ ucfirst(str_replace('_', ' ', $property->listing_type)) }}</span>
                            <span class="badge bg-secondary">{{ ucfirst($property->type) }}</span>
                            @if($property->featured)
                                <span class="badge bg-warning text-dark">Featured</span>
                            @endif
                        </div>
                        <h1 class="h2 fw-bold mb-3">{{ $property->title }}</h1>
                        <p class="text-muted mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            {{ $property->address }}, {{ $property->city }}{{ $property->state ? ', ' . $property->state : '' }}
                        </p>
                        <h3 class="text-primary fw-bold mb-4">
                            ${{ number_format($property->price) }}
                            @if($property->listing_type === 'for_rent')
                                <small class="fs-6 fw-normal text-muted">/ month</small>
                            @endif
                        </h3>
                        <div class="row g-3 mb-4">
                            @if($property->bedrooms)
                                <div class="col-auto"><i class="fas fa-bed text-primary me-2"></i>{{ $property->bedrooms }} Beds</div>
                            @endif
                            @if($property->bathrooms)
                                <div class="col-auto"><i class="fas fa-bath text-primary me-2"></i>{{ $property->bathrooms }} Baths</div>
                            @endif
                            @if($property->area)
                                <div class="col-auto"><i class="fas fa-arrows-alt text-primary me-2"></i>{{ number_format($property->area) }} sqft</div>
                            @endif
                            @if($property->parking)
                                <div class="col-auto"><i class="fas fa-car text-primary me-2"></i>{{ $property->parking }} Parking</div>
                            @endif
                        </div>
                        <hr>
                        <div class="property-description">
                            <h5 class="fw-bold mb-3">Description</h5>
                            {!! nl2br(e($property->description)) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @if($property->agent)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body text-center">
                            <img src="{{ $property->agent->avatar ? asset('storage/agents/' . $property->agent->avatar) : asset('assets/images/default-avatar.svg') }}"
                                 alt="{{ $property->agent->name }}" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;">
                            <h5 class="fw-bold">{{ $property->agent->name }}</h5>
                            <p class="text-muted small">{{ $property->agent->designation ?? 'Real Estate Agent' }}</p>
                            @if($property->agent->phone)
                                <p class="small mb-1"><i class="fas fa-phone me-2"></i><a href="tel:{{ $property->agent->phone }}">{{ $property->agent->phone }}</a></p>
                            @endif
                            @if($property->agent->email)
                                <p class="small mb-3"><i class="fas fa-envelope me-2"></i><a href="mailto:{{ $property->agent->email }}">{{ $property->agent->email }}</a></p>
                            @endif
                            <a href="{{ route('agents.show', $property->agent->slug) }}" class="btn btn-outline-primary btn-sm me-2">View Profile</a>
                            <a href="{{ route('contact.index') }}?property_id={{ $property->id }}" class="btn btn-primary btn-sm">Contact Agent</a>
                        </div>
                    </div>
                @endif
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <p class="small text-muted mb-0"><i class="fas fa-eye me-2"></i>{{ $property->views }} views</p>
                    </div>
                </div>
            </div>
        </div>

        @if($relatedProperties->count() > 0)
            <h4 class="fw-bold mt-5 mb-4">Related Properties</h4>
            <div class="row g-4">
                @foreach($relatedProperties as $rel)
                    <div class="col-md-4">
                        @include('frontend.components.property-card', ['property' => $rel])
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
