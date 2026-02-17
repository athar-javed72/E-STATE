@extends('layouts.app')

@section('title', 'Our Services - FindState')
@section('meta_description', 'Explore our comprehensive real estate services including property buying, selling, renting, property management, and investment consulting.')

@section('content')
{{-- Breadcrumb --}}
<section class="breadcrumb-section py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h2 mb-0 fw-bold">Our Services</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Services</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

{{-- Services Hero Section --}}
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="display-4 fw-bold mb-4">
                    Complete Real Estate
                    <span class="text-warning">Solutions</span>
                </h2>
                <p class="lead mb-4">
                    From buying your first home to managing investment properties,
                    we provide comprehensive real estate services tailored to your needs.
                </p>
                <a href="{{ route('contact.index') }}" class="btn btn-warning btn-lg">
                    Get Started Today
                </a>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ asset('assets/images/services-hero.jpg') }}"
                     class="img-fluid rounded-3"
                     alt="Real Estate Services">
            </div>
        </div>
    </div>
</section>

{{-- Main Services Section --}}
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-5 fw-bold mb-3">What We Offer</h2>
                <p class="lead text-muted">
                    Professional real estate services designed to make your property journey smooth and successful.
                </p>
            </div>
        </div>

        <div class="row">
            {{-- Property Buying --}}
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card h-100 p-4 bg-white rounded-3 shadow-sm border">
                    <div class="service-icon mb-4">
                        <div class="icon-circle bg-primary text-white d-inline-flex align-items-center justify-content-center rounded-circle"
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-home fa-2x"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold mb-3">Property Buying</h4>
                    <p class="text-muted mb-4">
                        Find your dream home with our expert guidance. We help you navigate the market,
                        negotiate the best deals, and handle all paperwork for a smooth transaction.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Market Analysis</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Property Search</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Negotiation Support</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Legal Assistance</li>
                    </ul>
                <a href="{{ route('properties.index') }}" class="btn btn-outline-primary">
                        Browse Properties
                    </a>
                </div>
            </div>

            {{-- Property Selling --}}
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card h-100 p-4 bg-white rounded-3 shadow-sm border">
                    <div class="service-icon mb-4">
                        <div class="icon-circle bg-success text-white d-inline-flex align-items-center justify-content-center rounded-circle"
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-dollar-sign fa-2x"></i>

                            </div>
                    </div>
                    <h4 class="fw-bold mb-3">Property Selling</h4>
                    <p class="text-muted mb-4">
                        Maximize your property's value with our comprehensive selling services. We provide expert pricing, marketing, and negotiation to ensure a successful sale.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Property Valuation</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Professional Photography</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Marketing & Promotion</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Negotiation & Closing</li>
                    </ul>
                    <a href="{{ route('contact.index') }}" class="btn btn-outline-success">
                        Request a Valuation
                    </a>
                </div>
            </div>

            {{-- Property Renting --}}
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card h-100 p-4 bg-white rounded-3 shadow-sm border">
                    <div class="service-icon mb-4">
                        <div class="icon-circle bg-warning text-white d-inline-flex align-items-center justify-content-center rounded-circle"
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-key fa-2x"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold mb-3">Property Renting</h4>
                    <p class="text-muted mb-4">
                        Discover rental properties that fit your lifestyle and budget. We assist tenants and landlords for a hassle-free rental experience.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Rental Listings</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Tenant Screening</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Lease Agreements</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Property Management</li>
                    </ul>
                    <a href="{{ route('properties.index', ['listing_type' => 'for_rent']) }}" class="btn btn-outline-warning text-dark">
                        View Rentals
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Call to Action --}}
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-2">Ready to start your property journey?</h3>
                <p class="mb-0">Contact our team today for a free consultation and let us help you achieve your real estate goals.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg fw-bold">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Custom JavaScript for AOS Animation --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.AOS) {
            window.AOS.init({
                duration: 800,
                once: true
            });
        }
    });
</script>
@endpush
