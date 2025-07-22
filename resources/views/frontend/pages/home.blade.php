@extends('layouts.app')

@section('title', 'FindState - Find Your Dream Property')
@section('meta_description', 'Discover your perfect home with FindState. Browse thousands of properties for sale and rent with detailed listings and expert agents.')

@section('content')

{{-- Hero Section --}}
<section class="hero-section bg-primary text-white position-relative overflow-hidden">
    <div class="hero-bg position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(0,123,255,0.8) 0%, rgba(0,86,179,0.9) 100%), url('{{ asset('assets/images/hero-bg.jpg') }}') center/cover;"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row min-vh-100 align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-4">
                    Find Your <span class="text-warning">Dream Home</span><br>
                    With Expert Guidance
                </h1>

                <p class="lead mb-4">
                    Discover thousands of verified properties with detailed information,
                    virtual tours, and connect with trusted real estate agents.
                </p>

                {{-- Hero Stats --}}
                <div class="row g-4 mb-5">
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <h3 class="fw-bold mb-1">{{ number_format($propertyStats['total_properties']) }}+</h3>
                            <small>Properties</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <h3 class="fw-bold mb-1">{{ number_format($propertyStats['properties_sold']) }}+</h3>
                            <small>Sold</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <h3 class="fw-bold mb-1">{{ number_format($propertyStats['happy_customers']) }}+</h3>
                            <small>Happy Clients</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <h3 class="fw-bold mb-1">{{ number_format($propertyStats['total_agents']) }}+</h3>
                            <small>Expert Agents</small>
                        </div>
                    </div>
                </div>

                {{-- Hero Search Form --}}
                <div class="hero-search-form">
                    <form action="{{ route('properties.index') }}" method="GET" class="bg-white rounded-3 p-4 shadow-lg">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label text-dark small fw-bold">Location</label>
                                <input type="text" class="form-control form-control-lg" name="search" placeholder="Enter city, area...">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label text-dark small fw-bold">Type</label>
                                <select class="form-select form-select-lg" name="type">
                                    <option value="">All Types</option>
                                    <option value="house">House</option>
                                    <option value="apartment">Apartment</option>
                                    <option value="condo">Condo</option>
                                    <option value="villa">Villa</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label text-dark small fw-bold">Purpose</label>
                                <select class="form-select form-select-lg" name="listing_type">
                                    <option value="">Buy/Rent</option>
                                    <option value="for_sale">For Sale</option>
                                    <option value="for_rent">For Rent</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label text-dark small fw-bold">Budget</label>
                                <select class="form-select form-select-lg" name="max_price">
                                    <option value="">Any</option>
                                    <option value="100000">$100K</option>
                                    <option value="300000">$300K</option>
                                    <option value="500000">$500K</option>
                                    <option value="1000000">$1M+</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-search me-2"></i>Search Properties
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Featured Properties Section --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">Featured Properties</h2>
                <p class="lead text-muted">Handpicked properties that offer the best value and location</p>
            </div>
        </div>

        @if($featuredProperties->count() > 0)
            <div class="row g-4">
                @foreach($featuredProperties as $property)
                    <div class="col-lg-4 col-md-6">
                        @include('frontend.components.property-card', ['property' => $property])
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
                    View All Properties <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        @else
            <div class="text-center py-5" data-aos="fade-up">
                <i class="fas fa-home display-1 text-muted mb-3"></i>
                <h3>No Featured Properties Yet</h3>
                <p class="text-muted">Check back soon for amazing property listings!</p>
            </div>
        @endif
    </div>
</section>

{{-- Why Choose Us Section --}}
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">Why Choose FindState?</h2>
                <p class="lead text-muted">We make property hunting simple, secure, and successful</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-search-location text-primary fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Smart Search</h4>
                    <p class="text-muted">Advanced filters and AI-powered recommendations to find your perfect match quickly and efficiently.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt text-success fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Verified Listings</h4>
                    <p class="text-muted">All properties are verified and updated regularly. No fake listings, no hidden costs, complete transparency.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-users text-warning fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Expert Agents</h4>
                    <p class="text-muted">Connect with certified real estate professionals who know the market inside and out.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-camera text-info fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Virtual Tours</h4>
                    <p class="text-muted">Explore properties from anywhere with high-quality photos and 360° virtual tours.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-hand-holding-usd text-danger fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Best Prices</h4>
                    <p class="text-muted">Competitive pricing with market analysis and negotiation support to get the best deals.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-headset text-primary fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">24/7 Support</h4>
                    <p class="text-muted">Round-the-clock customer support to assist you throughout your property journey.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Top Agents Section --}}
@if($topAgents->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">Meet Our Top Agents</h2>
                <p class="lead text-muted">Experienced professionals ready to help you find your perfect home</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($topAgents as $agent)
                <div class="col-lg-3 col-md-6">
                    @include('frontend.components.agent-card', ['agent' => $agent])
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('agents.index') }}" class="btn btn-primary btn-lg">
                View All Agents <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- Testimonials Section --}}
@if($testimonials->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">What Our Clients Say</h2>
                <p class="lead text-muted">Real experiences from happy homeowners and investors</p>
            </div>
        </div>

        <div class="testimonials-slider owl-carousel owl-theme">
            @foreach($testimonials as $testimonial)
                @include('frontend.components.testimonial', ['testimonial' => $testimonial])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Latest Blog Posts Section --}}
@if($latestBlogs->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">Latest News & Tips</h2>
                <p class="lead text-muted">Stay updated with market trends and expert insights</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($latestBlogs as $blog)
                <div class="col-lg-4">
                    <article class="blog-card h-100" data-aos="fade-up">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ $blog->featured_image ? asset('uploads/blogs/' . $blog->featured_image) : asset('assets/images/blog-placeholder.jpg') }}"
                                 class="card-img-top blog-img" alt="{{ $blog->title }}">

                            <div class="card-body d-flex flex-column">
                                <div class="blog-meta mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>{{ $blog->created_at->format('M d, Y') }}
                                        <i class="fas fa-user ms-3 me-1"></i>{{ $blog->author ?? 'Admin' }}
                                    </small>
                                </div>

                                <h5 class="card-title">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">
                                        {{ $blog->title }}
                                    </a>
                                </h5>

                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit(strip_tags($blog->excerpt ?: $blog->content), 120) }}
                                </p>

                                <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-outline-primary btn-sm mt-auto">
                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg">
                View All Posts <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- Call to Action Section --}}
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-4">Ready to Find Your Dream Home?</h2>
                <p class="lead mb-4">
                    Join thousands of satisfied customers who found their perfect property with us.
                    Start your journey today!
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="{{ route('properties.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-search me-2"></i>Browse Properties
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-phone me-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

{{-- Custom CSS for Home Page --}}
@push('css')
<style>
.hero-section {
    min-height: 100vh;
}

.stat-item h3 {
    font-size: 2rem;
    color: #ffc107;
}

.hero-search-form {
    max-width: 100%;
    margin: 0 auto;
}

.blog-img {
    height: 200px;
    object-fit: cover;
}

.feature-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.testimonials-slider .owl-item {
    padding: 0 15px;
}

@media (max-width: 768px) {
    .hero-search-form .row {
        --bs-gutter-x: 0.5rem;
    }

    .hero-search-form .col-md-3,
    .hero-search-form .col-md-2 {
        margin-bottom: 1rem;
    }
}
</style>
@endpush

{{-- Custom JavaScript for Home Page --}}
@push('js')
<script>
$(document).ready(function() {
    // Initialize testimonials slider
    $('.testimonials-slider').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1024: { items: 3 }
        }
    });

    // Counter animation for stats
    $('.stat-item h3').each(function() {
        const $this = $(this);
        const countTo = parseInt($this.text().replace(/[^\d]/g, ''));

        $({ countNum: 0 }).animate({
            countNum: countTo
        }, {
            duration: 2000,
            easing: 'swing',
            step: function() {
                $this.text(Math.floor(this.countNum).toLocaleString() + '+');
            },
            complete: function() {
                $this.text(countTo.toLocaleString() + '+');
            }
        });
    });
});
</script>
@endpush
