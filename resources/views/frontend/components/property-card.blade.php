{{--
    Property Card Component
    Usage: @include('frontend.components.property-card', ['property' => $property])
--}}

<div class="property-card h-100" data-aos="fade-up">
        <div class="card h-100 shadow-sm border-0">
        {{-- Property Image --}}
        @php
            $propertyPlaceholder = asset('assets/images/placeholder-600x400.svg');
            switch ($property->type) {
                case 'house':
                    $propertyPlaceholder = asset('assets/images/property-house.svg');
                    break;
                case 'apartment':
                    $propertyPlaceholder = asset('assets/images/property-apartment.svg');
                    break;
                case 'condo':
                    $propertyPlaceholder = asset('assets/images/property-condo.svg');
                    break;
                case 'villa':
                    $propertyPlaceholder = asset('assets/images/property-villa.svg');
                    break;
            }
        @endphp
        <div class="card-img-wrapper position-relative">
            <img src="{{ $property->featured_image ? asset('storage/' . $property->featured_image) : $propertyPlaceholder }}"
                 class="card-img-top property-img"
                 alt="{{ $property->title }}"
                 loading="lazy">

            {{-- Property Badge --}}
            <div class="property-badges position-absolute top-0 start-0 m-3">
                <span class="badge bg-primary me-1">{{ ucfirst(str_replace('_', ' ', $property->listing_type)) }}</span>
                @if($property->featured)
                    <span class="badge bg-warning text-dark">Featured</span>
                @endif
            </div>

            {{-- Price Badge --}}
            <div class="price-badge position-absolute top-0 end-0 m-3">
                <span class="badge bg-dark fs-6">
                    ${{ number_format($property->price) }}
                    @if($property->listing_type === 'for_rent')
                        <small>/month</small>
                    @endif
                </span>
            </div>

            {{-- Wishlist Button --}}
            @php
                $inWishlist = in_array($property->id, session('wishlist', []), true);
            @endphp
            <div class="wishlist-btn position-absolute bottom-0 end-0 m-3">
                <button type="button"
                        class="btn btn-light btn-sm rounded-circle js-wishlist-toggle"
                        data-property-id="{{ $property->id }}"
                        data-wishlist-url="{{ route('api.property.wishlist', $property) }}"
                        aria-label="Toggle wishlist">
                    <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"
                       id="wishlist-{{ $property->id }}"
                       @if($inWishlist) style="color:#dc3545" @endif></i>
                </button>
            </div>
        </div>

        {{-- Property Details --}}
        <div class="card-body d-flex flex-column">
            {{-- Title --}}
            <h5 class="card-title mb-2">
                <a href="{{ route('properties.show', $property->slug) }}" class="text-decoration-none text-dark">
                    {{ Str::limit($property->title, 50) }}
                </a>
            </h5>

            {{-- Location --}}
            <p class="text-muted mb-2 small">
                <i class="fas fa-map-marker-alt text-primary me-1"></i>
                {{ $property->address }}, {{ $property->city }}
            </p>

            {{-- Property Features --}}
            <div class="property-features mb-3">
                <div class="row g-0 text-center">
                    @if($property->bedrooms)
                        <div class="col">
                            <small class="text-muted">
                                <i class="fas fa-bed text-primary"></i><br>
                                {{ $property->bedrooms }} Beds
                            </small>
                        </div>
                    @endif

                    @if($property->bathrooms)
                        <div class="col">
                            <small class="text-muted">
                                <i class="fas fa-bath text-primary"></i><br>
                                {{ $property->bathrooms }} Baths
                            </small>
                        </div>
                    @endif

                    @if($property->area)
                        <div class="col">
                            <small class="text-muted">
                                <i class="fas fa-arrows-alt text-primary"></i><br>
                                {{ number_format($property->area) }} sqft
                            </small>
                        </div>
                    @endif

                    @if($property->parking)
                        <div class="col">
                            <small class="text-muted">
                                <i class="fas fa-car text-primary"></i><br>
                                {{ $property->parking }} Parking
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Property Type --}}
            <div class="mb-2">
                <span class="badge bg-light text-dark border">{{ ucfirst($property->type) }}</span>
            </div>

            {{-- Description --}}
            <p class="card-text text-muted small mb-3 flex-grow-1">
                {{ Str::limit(strip_tags($property->description), 80) }}
            </p>

            {{-- Agent Info & Action Buttons --}}
            <div class="mt-auto">
                {{-- Agent Info --}}
                @if($property->agent)
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $property->agent->avatar ? asset('storage/' . $property->agent->avatar) : asset('assets/images/default-avatar.svg') }}"
                             alt="{{ $property->agent->name }}"
                             class="rounded-circle me-2"
                             width="30" height="30">
                        <div class="flex-grow-1">
                            <small class="text-muted">Listed by</small><br>
                            <small class="fw-bold">{{ $property->agent->name }}</small>
                        </div>
                        <small class="text-muted">{{ $property->created_at->diffForHumans() }}</small>
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="d-flex gap-2">
                    <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-primary btn-sm flex-grow-1">
                        <i class="fas fa-eye me-1"></i>View Details
                    </a>
                    <button class="btn btn-outline-primary btn-sm" onclick="contactAgent({{ $property->id }})" data-bs-toggle="tooltip" title="Contact Agent">
                        <i class="fas fa-phone"></i>
                    </button>
                    <button class="btn btn-outline-primary btn-sm" onclick="shareProperty({{ $property->id }})" data-bs-toggle="tooltip" title="Share Property">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Property Card CSS --}}
@push('css')
<style>
.property-card .property-img {
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.property-card:hover .property-img {
    transform: scale(1.05);
}

.property-card .card-img-wrapper {
    overflow: hidden;
}

.property-card .property-features {
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 10px 0;
}

.wishlist-btn button {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.property-card .card {
    transition: box-shadow 0.3s ease;
}

.property-card:hover .card {
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}
</style>
@endpush

{{-- Property Card JavaScript --}}
@once
@push('scripts')
<script>
(function () {
    function csrfToken() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    function setWishlistIcon(icon, inWishlist) {
        if (!icon) return;
        icon.classList.toggle('fas', inWishlist);
        icon.classList.toggle('far', !inWishlist);
        icon.style.color = inWishlist ? '#dc3545' : '';
    }

    document.addEventListener('click', function (event) {
        var btn = event.target.closest('.js-wishlist-toggle');
        if (!btn) return;

        event.preventDefault();
        var url = btn.getAttribute('data-wishlist-url');
        var propertyId = btn.getAttribute('data-property-id');
        if (!url) return;

        btn.disabled = true;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken(),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({})
        })
            .then(function (res) {
                if (!res.ok) throw new Error('Wishlist request failed');
                return res.json();
            })
            .then(function (data) {
                setWishlistIcon(document.getElementById('wishlist-' + propertyId), !!data.in_wishlist);
            })
            .catch(function () {
                alert('Could not update wishlist. Please try again.');
            })
            .finally(function () {
                btn.disabled = false;
            });
    });
})();

function contactAgent(propertyId) {
    window.location.href = '/contact?property_id=' + propertyId;
}

function shareProperty(propertyId) {
    var url = window.location.origin + '/properties/' + propertyId;
    if (navigator.share) {
        navigator.share({ title: 'Check out this property', url: url });
    } else if (navigator.clipboard) {
        navigator.clipboard.writeText(url);
        alert('Property link copied to clipboard!');
    }
}
</script>
@endpush
@endonce
