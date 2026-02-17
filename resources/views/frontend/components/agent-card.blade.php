{{--
    Agent Card Component
    Usage: @include('frontend.components.agent-card', ['agent' => $agent])
--}}

<div class="agent-card h-100" data-aos="fade-up">
    <div class="card h-100 shadow-sm border-0 agent-card-hover">
        {{-- Agent Image --}}
        <div class="position-relative overflow-hidden">
            <img src="{{ $agent->avatar ? asset('storage/' . $agent->avatar) : asset('assets/images/default-avatar.svg') }}"
                 class="card-img-top agent-img"
                 alt="{{ $agent->name }}"
                 style="height: 250px; object-fit: cover;">

            {{-- Online Status --}}
            @if($agent->is_online ?? false)
                <span class="position-absolute top-0 end-0 m-2 badge bg-success">
                    <i class="fas fa-circle me-1" style="font-size: 8px;"></i>Online
                </span>
            @endif

            {{-- Social Links Overlay --}}
            <div class="position-absolute bottom-0 start-0 end-0 p-3 social-overlay">
                <div class="d-flex justify-content-center gap-2">
                    @if($agent->facebook)
                        <a href="{{ $agent->facebook }}" class="btn btn-sm btn-light rounded-circle" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if($agent->twitter)
                        <a href="{{ $agent->twitter }}" class="btn btn-sm btn-light rounded-circle" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if($agent->linkedin)
                        <a href="{{ $agent->linkedin }}" class="btn btn-sm btn-light rounded-circle" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @endif
                    @if($agent->instagram)
                        <a href="{{ $agent->instagram }}" class="btn btn-sm btn-light rounded-circle" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Agent Info --}}
        <div class="card-body text-center">
            <h5 class="card-title mb-1">
                <a href="{{ route('agents.show', $agent->slug) }}" class="text-decoration-none text-dark fw-bold">
                    {{ $agent->name }}
                </a>
            </h5>

            <p class="text-muted small mb-2">{{ $agent->designation ?? 'Real Estate Agent' }}</p>

            {{-- Agent Stats --}}
            <div class="row text-center mb-3">
                <div class="col-4">
                    <div class="fw-bold text-primary">{{ $agent->properties_count ?? 0 }}</div>
                    <small class="text-muted">Properties</small>
                </div>
                <div class="col-4">
                    <div class="fw-bold text-success">{{ $agent->experience ?? 0 }}+</div>
                    <small class="text-muted">Years Exp</small>
                </div>
                <div class="col-4">
                    <div class="fw-bold text-warning">
                        @if($agent->rating)
                            {{ number_format($agent->rating, 1) }}
                            <i class="fas fa-star text-warning"></i>
                        @else
                            -
                        @endif
                    </div>
                    <small class="text-muted">Rating</small>
                </div>
            </div>

            {{-- Contact Info --}}
            @if($agent->phone)
                <div class="mb-2">
                    <i class="fas fa-phone text-primary me-2"></i>
                    <a href="tel:{{ $agent->phone }}" class="text-decoration-none">
                        {{ $agent->phone }}
                    </a>
                </div>
            @endif

            @if($agent->email)
                <div class="mb-3">
                    <i class="fas fa-envelope text-primary me-2"></i>
                    <a href="mailto:{{ $agent->email }}" class="text-decoration-none">
                        {{ $agent->email }}
                    </a>
                </div>
            @endif
        </div>

        {{-- Action Buttons --}}
        <div class="card-footer bg-light border-0 p-3">
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="{{ route('agents.show', $agent->slug) }}" class="btn btn-primary flex-fill">
                    <i class="fas fa-user me-1"></i> View Profile
                </a>
                <button type="button" class="btn btn-outline-primary flex-fill"
                        data-bs-toggle="modal"
                        data-bs-target="#contactAgentModal"
                        data-agent-id="{{ $agent->id }}"
                        data-agent-name="{{ $agent->name }}">
                    <i class="fas fa-envelope me-1"></i> Contact
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
.agent-card-hover {
    transition: all 0.3s ease;
}

.agent-card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.agent-img {
    transition: transform 0.3s ease;
}

.agent-card-hover:hover .agent-img {
    transform: scale(1.05);
}

.social-overlay {
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.agent-card-hover:hover .social-overlay {
    opacity: 1;
}
</style>
