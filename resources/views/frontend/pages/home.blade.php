@extends('layouts.app')

@section('title', 'FindState - Find Your Perfect Home')
@section('meta_description', 'Find your perfect home easily with FindState. Trusted listings, verified agents, and a simple search experience.')

@section('content')

{{-- FindState Home: production-ready design system --}}
@push('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --fs-white: #FFFFFF;
    --fs-bg-secondary: #F7F9FC;
    --fs-text: #1F2937;
    --fs-text-muted: #6B7280;
    --fs-border: #E5E7EB;
    --fs-accent: #1e5f4a;
    --fs-accent-hover: #164a3a;
    --fs-accent-muted: rgba(30, 95, 74, 0.1);
    --fs-card-shadow: 0 1px 3px rgba(0,0,0,0.06);
    --fs-card-shadow-hover: 0 10px 40px rgba(0,0,0,0.08);
    --fs-radius: 12px;
    --fs-radius-sm: 8px;
    --fs-section-padding: 4.5rem 0;
    --fs-container-max: 1200px;
    --fs-font: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

#main-content { font-family: var(--fs-font); }
#main-content .container { max-width: var(--fs-container-max); }
.fs-container { max-width: var(--fs-container-max); margin-left: auto; margin-right: auto; padding-left: 1.25rem; padding-right: 1.25rem; }
@media (min-width: 576px) { .fs-container { padding-left: 1.5rem; padding-right: 1.5rem; } }
@media (min-width: 992px) { .fs-container { padding-left: 2rem; padding-right: 2rem; } }

/* ----- Hero: full-width image + overlay ----- */
.fs-hero {
    min-height: 90vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    background-color: #0f172a;
    background-image: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1920&q=80');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
.fs-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(15,23,42,0.75) 0%, rgba(15,23,42,0.5) 50%, rgba(15,23,42,0.85) 100%);
    pointer-events: none;
}
.fs-hero .container { position: relative; z-index: 1; }
.fs-hero h1 {
    font-family: var(--fs-font);
    font-size: clamp(2rem, 5vw, 3.25rem);
    font-weight: 700;
    color: #FFFFFF;
    letter-spacing: -0.03em;
    line-height: 1.15;
    margin-bottom: 1rem;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}
.fs-hero .lead {
    font-size: 1.125rem;
    font-weight: 400;
    color: rgba(255,255,255,0.9);
    max-width: 520px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 2rem;
}
.fs-hero-search {
    background: var(--fs-white);
    border-radius: var(--fs-radius);
    box-shadow: var(--fs-card-shadow-hover);
    padding: 1.5rem 1.75rem;
    max-width: 920px;
    margin-left: auto;
    margin-right: auto;
}
.fs-hero-search .form-control,
.fs-hero-search .form-select {
    border: 1px solid var(--fs-border);
    border-radius: var(--fs-radius-sm);
    padding: 0.7rem 1rem;
    font-size: 0.95rem;
    font-family: var(--fs-font);
}
.fs-hero-search .form-control:focus,
.fs-hero-search .form-select:focus {
    border-color: var(--fs-accent);
    box-shadow: 0 0 0 3px var(--fs-accent-muted);
    outline: none;
}
.fs-hero-search .btn-search-cta {
    background: var(--fs-accent);
    color: var(--fs-white);
    border: none;
    padding: 0.7rem 1.5rem;
    border-radius: var(--fs-radius-sm);
    font-weight: 600;
    font-size: 0.95rem;
    font-family: var(--fs-font);
    transition: background 0.2s, transform 0.15s;
}
.fs-hero-search .btn-search-cta:hover {
    background: var(--fs-accent-hover);
    color: var(--fs-white);
    transform: translateY(-1px);
}

/* ----- Trust: pills below hero ----- */
.fs-trust {
    padding: 2rem 0;
    background: var(--fs-bg-secondary);
    border-bottom: 1px solid var(--fs-border);
}
.fs-trust-item {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.5rem 1rem;
    background: var(--fs-bg-secondary);
    border-radius: 999px;
    color: var(--fs-text);
    font-size: 0.9rem;
    font-weight: 500;
    border: 1px solid var(--fs-border);
}
.fs-trust-item i {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--fs-accent-muted);
    color: var(--fs-accent);
    border-radius: 50%;
    font-size: 0.9rem;
}

/* ----- Section headings ----- */
.fs-section-title {
    font-family: var(--fs-font);
    font-size: clamp(1.5rem, 3vw, 1.875rem);
    font-weight: 700;
    color: var(--fs-text);
    margin-bottom: 0.5rem;
    letter-spacing: -0.02em;
}
.fs-section-subtitle {
    color: var(--fs-text-muted);
    font-size: 1rem;
    margin-bottom: 2rem;
    font-weight: 400;
}

/* ----- Popular locations: chips on light gray ----- */
.fs-locations {
    padding: var(--fs-section-padding);
    background: var(--fs-bg-secondary);
}
.fs-location-chip {
    display: inline-flex;
    align-items: center;
    padding: 0.6rem 1.25rem;
    background: var(--fs-white);
    border: 1px solid var(--fs-border);
    border-radius: var(--fs-radius);
    color: var(--fs-text);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: border-color 0.2s, box-shadow 0.2s, color 0.2s;
}
.fs-location-chip:hover {
    border-color: var(--fs-accent);
    color: var(--fs-accent);
    box-shadow: var(--fs-card-shadow);
}

/* ----- Property type filters: icon buttons (colored, clearly clickable) ----- */
.fs-types {
    padding: var(--fs-section-padding);
    background: var(--fs-white);
}
.fs-type-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    padding: 1.5rem 1rem;
    border-radius: var(--fs-radius);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    border: 2px solid transparent;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s, color 0.2s, transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
.fs-type-btn i {
    font-size: 1.75rem;
    transition: color 0.2s, transform 0.2s;
}
.fs-type-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
/* House: soft green */
.fs-type-btn--house {
    background: rgba(16, 185, 129, 0.08);
    border-color: rgba(16, 185, 129, 0.35);
    color: #047857;
}
.fs-type-btn--house i { color: #059669; }
.fs-type-btn--house:hover {
    background: rgba(16, 185, 129, 0.18);
    border-color: #10b981;
    color: #047857;
}
.fs-type-btn--house:hover i { color: #059669; transform: scale(1.05); }
/* Apartment: soft blue */
.fs-type-btn--apartment {
    background: rgba(59, 130, 246, 0.08);
    border-color: rgba(59, 130, 246, 0.35);
    color: #1d4ed8;
}
.fs-type-btn--apartment i { color: #2563eb; }
.fs-type-btn--apartment:hover {
    background: rgba(59, 130, 246, 0.18);
    border-color: #3b82f6;
    color: #1d4ed8;
}
.fs-type-btn--apartment:hover i { color: #2563eb; transform: scale(1.05); }
/* Plot: soft amber */
.fs-type-btn--plot {
    background: rgba(245, 158, 11, 0.08);
    border-color: rgba(245, 158, 11, 0.4);
    color: #b45309;
}
.fs-type-btn--plot i { color: #d97706; }
.fs-type-btn--plot:hover {
    background: rgba(245, 158, 11, 0.18);
    border-color: #f59e0b;
    color: #b45309;
}
.fs-type-btn--plot:hover i { color: #d97706; transform: scale(1.05); }
/* Commercial: soft violet */
.fs-type-btn--commercial {
    background: rgba(139, 92, 246, 0.08);
    border-color: rgba(139, 92, 246, 0.35);
    color: #5b21b6;
}
.fs-type-btn--commercial i { color: #7c3aed; }
.fs-type-btn--commercial:hover {
    background: rgba(139, 92, 246, 0.18);
    border-color: #8b5cf6;
    color: #5b21b6;
}
.fs-type-btn--commercial:hover i { color: #7c3aed; transform: scale(1.05); }

/* ----- Recently added: 16:9 cards, light gray section ----- */
.fs-recent {
    padding: var(--fs-section-padding);
    background: var(--fs-bg-secondary);
}
.fs-property-card {
    background: var(--fs-white);
    border-radius: var(--fs-radius);
    overflow: hidden;
    border: 1px solid var(--fs-border);
    box-shadow: var(--fs-card-shadow);
    transition: box-shadow 0.25s, transform 0.25s;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.fs-property-card:hover {
    box-shadow: var(--fs-card-shadow-hover);
    transform: translateY(-4px);
}
.fs-property-card .card-img-wrap {
    aspect-ratio: 16 / 9;
    overflow: hidden;
    background: var(--fs-border);
}
.fs-property-card .card-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.fs-property-card .card-body-custom {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.fs-property-card .card-price {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--fs-text);
    margin-bottom: 0.25rem;
}
.fs-property-card .card-location {
    font-size: 0.9rem;
    color: var(--fs-text-muted);
    margin-bottom: 0.5rem;
}
.fs-property-card .card-type {
    font-size: 0.8rem;
    color: var(--fs-accent);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-top: auto;
}
.fs-property-card a {
    text-decoration: none;
    color: inherit;
}

/* ----- How it works: icons in circles ----- */
.fs-steps {
    padding: var(--fs-section-padding);
    background: var(--fs-white);
}
.fs-step {
    text-align: center;
    padding: 1rem 0.5rem;
}
.fs-step-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 1rem;
    background: var(--fs-accent-muted);
    color: var(--fs-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
}
.fs-step h4 {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--fs-text);
    margin-bottom: 0.25rem;
}
.fs-step p {
    font-size: 0.9rem;
    color: var(--fs-text-muted);
    margin: 0;
}

/* ----- Owner CTA: accent/dark, white text ----- */
.fs-owner-cta {
    padding: var(--fs-section-padding);
    background: var(--fs-accent);
    color: var(--fs-white);
    text-align: center;
    position: relative;
    overflow: hidden;
}
.fs-owner-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1920&q=30') center/cover;
    opacity: 0.12;
    pointer-events: none;
}
.fs-owner-cta .container { position: relative; z-index: 1; }
.fs-owner-cta h2 {
    font-size: clamp(1.5rem, 3vw, 1.875rem);
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--fs-white);
}
.fs-owner-cta p {
    color: rgba(255,255,255,0.9);
    margin-bottom: 1.5rem;
    max-width: 480px;
    margin-left: auto;
    margin-right: auto;
    font-size: 1rem;
}
.fs-owner-cta .btn-list {
    background: var(--fs-white);
    color: var(--fs-accent);
    border: none;
    padding: 0.75rem 2rem;
    border-radius: var(--fs-radius-sm);
    font-weight: 600;
    font-size: 1rem;
    font-family: var(--fs-font);
    transition: background 0.2s, transform 0.2s, color 0.2s;
}
.fs-owner-cta .btn-list:hover {
    background: rgba(255,255,255,0.95);
    color: var(--fs-accent-hover);
    transform: translateY(-2px);
}

/* ----- FAQ: white, accordion, smooth ----- */
.fs-faq {
    padding: var(--fs-section-padding);
    background: var(--fs-white);
}
.fs-faq .accordion-item {
    border: 1px solid var(--fs-border);
    border-radius: var(--fs-radius-sm) !important;
    margin-bottom: 0.5rem;
    overflow: hidden;
}
.fs-faq .accordion-button {
    background: var(--fs-white) !important;
    color: var(--fs-text) !important;
    font-weight: 600;
    font-size: 1rem;
    padding: 1rem 1.25rem;
    border: none;
    box-shadow: none !important;
    font-family: var(--fs-font);
    transition: color 0.2s ease;
}
.fs-faq .accordion-button:not(.collapsed) {
    color: var(--fs-accent) !important;
    background: var(--fs-white) !important;
}
.fs-faq .accordion-button::after {
    flex-shrink: 0;
}
.fs-faq .accordion-collapse {
    transition: height 0.3s ease;
}
.fs-faq .accordion-body {
    padding: 0 1.25rem 1rem;
    color: var(--fs-text-muted);
    font-size: 0.95rem;
    font-weight: 400;
}

/* ----- View all link ----- */
.fs-view-all {
    color: var(--fs-accent);
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    transition: color 0.2s;
}
.fs-view-all:hover { color: var(--fs-accent-hover); }

@media (max-width: 768px) {
    .fs-hero { min-height: 75vh; padding: 3rem 0; }
    .fs-hero-search .row { --bs-gutter-y: 0.75rem; }
    .fs-hero-search { padding: 1.25rem; }
}
</style>
@endpush

{{-- Hero Section --}}
<section class="fs-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1>Find your perfect home easily</h1>
                <p class="lead">Search verified listings, compare options, and connect with trusted agents—all in one place.</p>
                <form action="{{ route('properties.index') }}" method="GET" class="fs-hero-search">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-body-secondary">Location</label>
                            <input type="text" class="form-control" name="search" placeholder="City or area">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold text-body-secondary">Property type</label>
                            <select class="form-select" name="type">
                                <option value="">Any type</option>
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                                <option value="plot">Plot</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold text-body-secondary">Budget</label>
                            <select class="form-select" name="max_price">
                                <option value="">Any budget</option>
                                <option value="100000">Up to $100K</option>
                                <option value="250000">Up to $250K</option>
                                <option value="500000">Up to $500K</option>
                                <option value="1000000">Up to $1M</option>
                                <option value="10000000">$1M+</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-search-cta w-100">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Trust Indicators --}}
<section class="fs-trust">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-3">
            <div class="fs-trust-item">
                <i class="fas fa-check-circle"></i>
                <span>Verified Listings</span>
            </div>
            <div class="fs-trust-item">
                <i class="fas fa-user-tie"></i>
                <span>Trusted Agents</span>
            </div>
            <div class="fs-trust-item">
                <i class="fas fa-headset"></i>
                <span>Customer Support</span>
            </div>
        </div>
    </div>
</section>

{{-- Popular Locations --}}
<section class="fs-locations">
    <div class="container">
        <h2 class="fs-section-title text-center">Popular Locations</h2>
        <p class="fs-section-subtitle text-center">Browse properties in top cities</p>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            @foreach(['New York', 'Los Angeles', 'Chicago', 'Miami', 'Houston', 'San Francisco', 'Boston', 'Seattle'] as $city)
                <a href="{{ route('properties.index', ['search' => $city]) }}" class="fs-location-chip">{{ $city }}</a>
            @endforeach
        </div>
    </div>
</section>

{{-- Property Type Quick Filters --}}
<section class="fs-types">
    <div class="container">
        <h2 class="fs-section-title text-center">Property Types</h2>
        <p class="fs-section-subtitle text-center">Filter by type in one click</p>
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3">
                <a href="{{ route('properties.index', ['type' => 'house']) }}" class="fs-type-btn fs-type-btn--house">
                    <i class="fas fa-home"></i>
                    <span>House</span>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('properties.index', ['type' => 'apartment']) }}" class="fs-type-btn fs-type-btn--apartment">
                    <i class="fas fa-building"></i>
                    <span>Apartment</span>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('properties.index', ['type' => 'plot']) }}" class="fs-type-btn fs-type-btn--plot">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Plot</span>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('properties.index', ['type' => 'commercial']) }}" class="fs-type-btn fs-type-btn--commercial">
                    <i class="fas fa-store"></i>
                    <span>Commercial</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Recently Added Properties --}}
<section class="fs-recent">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
            <div>
                <h2 class="fs-section-title mb-0">Recently Added Properties</h2>
                <p class="fs-section-subtitle mb-0">Latest listings on FindState</p>
            </div>
            <a href="{{ route('properties.index') }}" class="fs-view-all">View all properties <i class="fas fa-arrow-right"></i></a>
        </div>
        @if($recentProperties->count() > 0)
            <div class="row g-4">
                @foreach($recentProperties as $property)
                    @php
                        $imgSrc = $property->featured_image ? asset('storage/' . $property->featured_image) : asset('assets/images/placeholder-600x400.svg');
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('properties.show', $property->slug) }}" class="fs-property-card">
                            <div class="card-img-wrap">
                                <img src="{{ $imgSrc }}" alt="{{ $property->title }}" loading="lazy">
                            </div>
                            <div class="card-body-custom">
                                <div class="card-price">
                                    ${{ number_format($property->price) }}
                                    @if($property->listing_type === 'for_rent')<small class="text-muted">/mo</small>@endif
                                </div>
                                <div class="card-location">
                                    <i class="fas fa-map-marker-alt me-1 text-muted"></i>{{ $property->city }}{{ $property->address ? ', ' . Str::limit($property->address, 30) : '' }}
                                </div>
                                <span class="card-type">{{ ucfirst($property->type) }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-home fa-3x text-secondary mb-3"></i>
                <p class="text-muted mb-0">No recent listings yet. Check back soon.</p>
            </div>
        @endif
    </div>
</section>

{{-- How It Works --}}
<section class="fs-steps">
    <div class="container">
        <h2 class="fs-section-title text-center">How It Works</h2>
        <p class="fs-section-subtitle text-center">From search to move-in in four simple steps</p>
        <div class="row g-4">
            <div class="col-6 col-lg-3">
                <div class="fs-step">
                    <div class="fs-step-icon"><i class="fas fa-search"></i></div>
                    <h4>Search</h4>
                    <p>Find properties by location, type, and budget.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="fs-step">
                    <div class="fs-step-icon"><i class="fas fa-heart"></i></div>
                    <h4>Shortlist</h4>
                    <p>Save your favorites and compare options.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="fs-step">
                    <div class="fs-step-icon"><i class="fas fa-phone-alt"></i></div>
                    <h4>Contact Agent</h4>
                    <p>Reach out to verified agents for viewings.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="fs-step">
                    <div class="fs-step-icon"><i class="fas fa-key"></i></div>
                    <h4>Move In</h4>
                    <p>Complete paperwork and move into your new home.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Owner / Agent CTA --}}
<section class="fs-owner-cta">
    <div class="container">
        <h2>List your property on FindState</h2>
        <p>Reach thousands of serious buyers and renters. Join property owners and agents who trust FindState.</p>
        <a href="{{ route('contact.index') }}?subject=list_property" class="btn btn-list">List Your Property</a>
    </div>
</section>

{{-- FAQ Section --}}
<section class="fs-faq">
    <div class="container">
        <h2 class="fs-section-title text-center">Frequently Asked Questions</h2>
        <p class="fs-section-subtitle text-center">Quick answers to common questions</p>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">How do I list my property?</button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Use the “List Your Property” button to get in touch. Our team will guide you through verification and listing steps. You can also contact us via the contact page or WhatsApp.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">Are agents verified?</button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Yes. We verify agent credentials and listing details before publishing. You’ll see a verified badge on trusted agents and listings.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">Is there any listing fee?</button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Listing fees depend on the plan you choose. Basic listings may be free or low-cost; premium placement has optional fees. We’ll explain all options when you list.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">How do I schedule a viewing?</button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Open the property listing and use the “Contact Agent” or “Chat with us” option. You can also call or message via WhatsApp to fix a time that works.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">Can I search for both sale and rent?</button>
                        </h3>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Yes. Use the search bar or filters to choose “For Sale” or “For Rent,” and combine with location and budget to see matching listings.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Quick Contact / WhatsApp CTA (floating) --}}
<a href="https://wa.me/1234567890?text=Hi%2C%20I%20have%20a%20query%20about%20FindState%20properties" class="fs-whatsapp-cta" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
    <span class="fs-whatsapp-text">Chat with us</span>
</a>

@endsection

@push('css')
<style>
.fs-whatsapp-cta {
    position: fixed;
    bottom: 1.5rem;
    right: 1.5rem;
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #25D366;
    color: #fff;
    border-radius: 50%;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 4px 16px rgba(37, 211, 102, 0.45);
    z-index: 1000;
    transition: transform 0.2s, box-shadow 0.2s;
}
.fs-whatsapp-cta:hover {
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 6px 24px rgba(37, 211, 102, 0.5);
}
.fs-whatsapp-cta i { font-size: 1.6rem; }
.fs-whatsapp-text { display: none; }
@media (min-width: 480px) {
    .fs-whatsapp-cta { width: auto; padding: 0.75rem 1.25rem; border-radius: 999px; }
    .fs-whatsapp-text { display: inline; margin-left: 0.35rem; font-size: 0.9rem; }
}
@media (max-width: 575px) {
    .fs-whatsapp-cta { bottom: 1.25rem; right: 1.25rem; }
}
</style>
@endpush
