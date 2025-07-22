@extends('layouts.app')

@section('title', 'About Us - FindState')
@section('meta_description', 'Learn about FindState - your trusted real estate partner with years of experience in helping clients find their dream properties.')

@section('content')
{{-- Breadcrumb --}}
<section class="breadcrumb-section py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h2 mb-0 fw-bold">About Us</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

{{-- About Hero Section --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="about-content">
                    <h2 class="display-5 fw-bold mb-4">
                        Your Trusted Real Estate
                        <span class="text-primary">Partner</span>
                    </h2>
                    <p class="lead text-muted mb-4">
                        With over a decade of experience in the real estate industry, FindState has been
                        helping families and businesses find their perfect properties across the nation.
                    </p>
                    <p class="mb-4">
                        We understand that buying or selling a property is one of life's most significant
                        decisions. That's why our team of experienced professionals is committed to providing
                        exceptional service, expert guidance, and personalized solutions tailored to your unique needs.
                    </p>

                    {{-- Key Points --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">Expert Guidance</h6>
                                    <small class="text-muted">Professional advice at every step</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">Market Knowledge</h6>
                                    <small class="text-muted">Deep understanding of local markets</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">Personalized Service</h6>
                                    <small class="text-muted">Tailored solutions for your needs</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">Proven Results</h6>
                                    <small class="text-muted">Thousands of satisfied clients</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <img src="{{ asset('assets/images/about-hero.jpg') }}"
                         class="img-fluid rounded-3 shadow"
                         alt="About FindState">

                    {{-- Play Button Overlay --}}
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <button class="btn btn-primary btn-lg rounded-circle"
                                style="width: 80px; height: 80px;"
                                data-bs-toggle="modal"
                                data-bs-target="#videoModal">
                            <i class="fas fa-play ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Statistics Section --}}
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold mb-2" data-counter="1500">0</h2>
                    <p class="mb-0 h5">Properties Sold</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold mb-2" data-counter="2000">0</h2>
                    <p class="mb-0 h5">Happy Clients</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold mb-2" data-counter="50">0</h2>
                    <p class="mb-0 h5">Expert Agents</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-item">
                    <h2 class="display-4 fw-bold mb-2" data-counter="15">0</h2>
                    <p class="mb-0 h5">Years Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mission & Vision Section --}}
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="mission-box h-100 p-4 bg-light rounded-3">
                    <div class="icon-box mb-3">
                        <i class="fas fa-bullseye fa-3x text-primary"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Our Mission</h3>
                    <p class="text-muted mb-0">
                        To provide exceptional real estate services that exceed our clients' expectations
                        while building long-lasting relationships based on trust, integrity, and professional excellence.
                        We strive to make the property buying and selling process as smooth and stress-free as possible.
                    </p>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="vision-box h-100 p-4 bg-primary text-white rounded-3">
                    <div class="icon-box mb-3">
                        <i class="fas fa-eye fa-3x text-white"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Our Vision</h3>
                    <p class="mb-0">
                        To be the leading real estate company in the region, recognized for our innovative
                        approach, exceptional customer service, and commitment to helping people achieve
                        their property dreams. We envision a future where finding your perfect home is simple and enjoyable.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Why Choose Us Section --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-5 fw-bold mb-3">Why Choose FindState?</h2>
                <p class="lead text-muted">
                    We go above and beyond to ensure your real estate journey is successful and rewarding.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="icon-box mb-3">
                        <i class="fas fa-award fa-3x text-warning"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Award-Winning Service</h5>
                    <p class="text-muted">
                        Recognized for excellence in customer service and professional achievements
                        in the real estate industry.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="icon-box mb-3">
                        <i class="fas fa-handshake fa-3x text-success"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Trusted Partnership</h5>
                    <p class="text-muted">
                        Building long-term relationships with clients based on trust, transparency,
                        and mutual respect.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="icon-box mb-3">
                        <i class="fas fa-chart-line fa-3x text-info"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Market Expertise</h5>
                    <p class="text-muted">
                        Deep knowledge of local market trends, pricing, and investment opportunities
                        to guide your decisions.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="icon-box mb-3">
                        <i class="fas fa-mobile-alt fa-3x text-danger"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Technology Driven</h5>
                    <p class="text-muted">
                        Leveraging latest technology and digital tools to provide seamless
                        and efficient real estate services.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-card text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="icon-box mb-3">
                        <i class="fas fa-clock fa-3x text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-3">24/7 Support</h5>
                    <p class="text-muted">
                        Round-the-clock customer support to answer your questions and
                        assist you throughout your property journey.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-card text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="icon-box mb-3">
                        <i class="fas fa-shield-alt fa-3x text-secondary"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Secure Transactions</h5>
                    <p class="text-muted">
                        Ensuring safe and secure property transactions with proper legal
                        documentation and verification processes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Team Section --}}
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-5 fw-bold mb-3">Meet Our Leadership Team</h2>
                <p class="lead text-muted">
                    Experienced professionals dedicated to your success in real estate.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="team-card text-center">
                    <div class="team-img mb-3">
                        <img src="{{ asset('assets/images/team-1.jpg') }}"
                             class="img-fluid rounded-circle"
                             alt="John Smith"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="fw-bold mb-1">John Smith</h5>
                    <p class="text-muted mb-2">CEO & Founder</p>
                    <p class="small text-muted mb-3">
                        With 20+ years in real estate, John leads our company with vision and expertise.
                    </p>
                    <div class="social-links">
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle me-2">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle me-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="team-card text-center">
                    <div class="team-img mb-3">
                        <img src="{{ asset('assets/images/team-2.jpg') }}"
                             class="img-fluid rounded-circle"
                             alt="Sarah Johnson"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="fw-bold mb-1">Sarah Johnson</h5>
                    <p class="text-muted mb-2">Head of Sales</p>
                    <p class="small text-muted mb-3">
                        Sarah manages our sales team and ensures exceptional client experiences.
                    </p>
                    <div class="social-links">
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle me-2">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle me-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="team-card text-center">
                    <div class="team-img mb-3">
                        <img src="{{ asset('assets/images/team-3.jpg') }}"
                             class="img-fluid rounded-circle"
                             alt="Mike Brown"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="fw-bold mb-1">Mike Brown</h5>
                    <p class="text-muted mb-2">Operations Manager</p>
                    <p class="small text-muted mb-3">
                        Mike oversees daily operations and ensures smooth business processes.
                    </p>
                    <div class="social-links">
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle me-2">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle me-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Video Modal --}}
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                            title="About FindState Video"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom JavaScript --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation
    const counters = document.querySelectorAll('[data-counter]');

    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-counter'));
        const increment = target / 100;
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.ceil(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        updateCounter();
    };

    // Intersection Observer for counters
    const observerOptions = {
        threshold: 0.5,
        triggerOnce: true
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
            }
        });
    }, observerOptions);

    counters.forEach(counter => {
        observer.observe(counter);
    });
});
</script>
@endpush
@endsection
