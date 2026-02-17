@extends('layouts.app')

@section('title', $agent->name . ' - FindState')
@section('meta_description', $agent->designation ?? 'Real Estate Agent' . ' - ' . Str::limit($agent->bio, 120))

@section('content')
{{-- Breadcrumb --}}
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('agents.index') }}">Agents</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $agent->name }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ $agent->avatar ? asset('storage/' . $agent->avatar) : asset('assets/images/default-avatar.svg') }}"
                         class="card-img-top" alt="{{ $agent->name }}" style="height: 320px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h2 class="h4 fw-bold">{{ $agent->name }}</h2>
                        <p class="text-muted">{{ $agent->designation ?? 'Real Estate Agent' }}</p>
                        <div class="row text-center mb-3">
                            <div class="col-4">
                                <div class="fw-bold text-primary">{{ $totalProperties }}</div>
                                <small class="text-muted">Properties</small>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold text-success">{{ $agent->experience }}+</div>
                                <small class="text-muted">Years</small>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold text-warning">{{ $agent->rating ? number_format($agent->rating, 1) : '-' }} <i class="fas fa-star text-warning small"></i></div>
                                <small class="text-muted">Rating</small>
                            </div>
                        </div>
                        @if($agent->phone)
                            <p class="small mb-1"><i class="fas fa-phone me-2"></i><a href="tel:{{ $agent->phone }}">{{ $agent->phone }}</a></p>
                        @endif
                        @if($agent->email)
                            <p class="small mb-3"><i class="fas fa-envelope me-2"></i><a href="mailto:{{ $agent->email }}">{{ $agent->email }}</a></p>
                        @endif
                        <a href="{{ route('contact.index') }}?agent={{ $agent->id }}" class="btn btn-primary w-100">Contact Agent</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                @if($agent->bio)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">About</h5>
                            {!! nl2br(e($agent->bio)) !!}
                        </div>
                    </div>
                @endif
                @if($agent->properties->count() > 0)
                    <h5 class="fw-bold mb-4">Listings ({{ $agent->properties->count() }})</h5>
                    <div class="row g-4">
                        @foreach($agent->properties as $property)
                            <div class="col-md-6 col-lg-4">
                                @include('frontend.components.property-card', ['property' => $property])
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No active listings at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
