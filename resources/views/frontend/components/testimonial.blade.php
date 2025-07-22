{{--
    Testimonial Component
    Usage: @include('frontend.components.testimonial', ['testimonial' => $testimonial])
--}}

<div class="testimonial-item">
    <div class="card h-100 border-0 shadow-sm testimonial-card">
        <div class="card-body position-relative p-4">
            {{-- Quote Icon --}}
            <div class="position-absolute top-0 start-0 quote-icon">
                <i class="fas fa-quote-left text-primary opacity-25" style="font-size: 3rem;"></i>
            </div>

            {{-- Rating Stars --}}
            <div class="mb-3 text-center">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= ($testimonial->rating ?? 5))
                        <i class="fas fa-star text-warning"></i>
                    @else
                        <i class="far fa-star text-muted"></i>
                    @endif
                @endfor
            </div>

            {{-- Testimonial Content --}}
            <p class="testimonial-content text-center mb-4 fst-italic">
                "{{ $testimonial->content }}"
            </p>
        </div>

        {{-- Client Info --}}
        <div class="card-footer bg-transparent border-0 text-center pt-0">
            <div class="d-flex align-items-center justify-content-center">
                {{-- Client Image --}}
                <div class="me-3">
                    <img src="{{ $testimonial->image ? asset('uploads/testimonials/' . $testimonial->image) : asset('assets/images/default-avatar.jpg') }}"
                         alt="{{ $testimonial->name }}"
                         class="rounded-circle testimonial-img"
                         width="60" height="60"
                         style="object-fit: cover;">
                </div>

                {{-- Client Details --}}
                <div>
                    <h6 class="mb-0 fw-bold text-dark">{{ $testimonial->name }}</h6>
                    <small class="text-muted">{{ $testimonial->designation ?? 'Customer' }}</small>
                    @if($testimonial->location)
                        <br><small class="text-muted">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $testimonial->location }}
                        </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Alternative Slider Version for Owl Carousel --}}
@if(isset($slider) && $slider)
<div class="item">
    <div class="testimonial-slide text-center p-4">
        {{-- Rating --}}
        <div class="mb-3">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= ($testimonial->rating ?? 5))
                    <i class="fas fa-star text-warning"></i>
                @else
                    <i class="far fa-star text-muted"></i>
                @endif
            @endfor
        </div>

        {{-- Content --}}
        <p class="h5 mb-4 fst-italic text-dark">
            "{{ $testimonial->content }}"
        </p>

        {{-- Client --}}
        <div class="d-flex align-items-center justify-content-center">
            <img src="{{ $testimonial->image ? asset('uploads/testimonials/' . $testimonial->image) : asset('assets/images/default-avatar.jpg') }}"
                 alt="{{ $testimonial->name }}"
                 class="rounded-circle me-3"
                 width="80" height="80"
                 style="object-fit: cover;">
            <div class="text-start">
                <h6 class="mb-0 fw-bold">{{ $testimonial->name }}</h6>
                <small class="text-muted">{{ $testimonial->designation ?? 'Customer' }}</small>
                @if($testimonial->location)
                    <br><small class="text-muted">{{ $testimonial->location }}</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

{{-- Custom Styles --}}
<style>
.testimonial-card {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}

.testimonial-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(45deg, #ffc107, #fd7e14);
}

.quote-icon {
    z-index: 0;
    left: 10px;
    top: -10px;
}

.testimonial-content {
    position: relative;
    z-index: 1;
    line-height: 1.6;
    color: #555;
}

.testimonial-img {
    border: 3px solid #f8f9fa;
    transition: transform 0.3s ease;
}

.testimonial-card:hover .testimonial-img {
    transform: scale(1.1);
}

.testimonial-slide {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin: 20px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .quote-icon i {
        font-size: 2rem !important;
    }

    .testimonial-content {
        font-size: 0.95rem;
    }
}
</style>
