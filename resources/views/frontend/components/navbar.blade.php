{{-- Navigation Bar - Light centered style (Logo | Centered Nav | Search + User) --}}
<nav class="navbar navbar-expand-lg fixed-top fs-navbar">
    <div class="container">
        {{-- Logo / Brand (left) --}}
        <a class="navbar-brand d-flex align-items-center fs-navbar-brand" href="{{ route('home') }}">
            <div class="fs-navbar-logo d-inline-flex align-items-center justify-content-center me-2">
                <i class="fas fa-building fs-navbar-logo-icon"></i>
            </div>
            <span class="fs-navbar-title">FindState</span>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler fs-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Centered Nav + Right Icons --}}
        <div class="collapse navbar-collapse fs-navbar-collapse" id="navbarNav">
            <ul class="navbar-nav fs-navbar-links mx-auto">
                {{-- Home --}}
                <li class="nav-item">
                    <a class="nav-link fs-nav-link {{ Request::routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>

                {{-- About Us --}}
                <li class="nav-item">
                    <a class="nav-link fs-nav-link {{ Request::routeIs('about') ? 'active' : '' }}"
                       href="{{ route('about') }}">About Us</a>
                </li>

                {{-- Services --}}
                <li class="nav-item">
                    <a class="nav-link fs-nav-link {{ Request::routeIs('services') ? 'active' : '' }}"
                       href="{{ route('services') }}">Services</a>
                </li>

                {{-- Properties (dropdown) --}}
                <li class="nav-item dropdown">
                    <a class="nav-link fs-nav-link dropdown-toggle {{ Request::routeIs('properties.*') ? 'active' : '' }}"
                       href="#" role="button" data-bs-toggle="dropdown">
                        Properties
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('properties.index') }}">All Properties</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.index', ['listing_type' => 'for_sale']) }}">For Sale</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.index', ['listing_type' => 'for_rent']) }}">For Rent</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('properties.index', ['type' => 'house']) }}">Houses</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.index', ['type' => 'apartment']) }}">Apartments</a></li>
                        <li><a class="dropdown-item" href="{{ route('properties.index', ['type' => 'condo']) }}">Condos</a></li>
                    </ul>
                </li>

                {{-- Our Agents --}}
                <li class="nav-item">
                    <a class="nav-link fs-nav-link {{ Request::routeIs('agents.*') ? 'active' : '' }}"
                       href="{{ route('agents.index') }}">Our Agents</a>
                </li>

                {{-- Blog --}}
                <li class="nav-item">
                    <a class="nav-link fs-nav-link {{ Request::routeIs('blog.*') ? 'active' : '' }}"
                       href="{{ route('blog.index') }}">Blog</a>
                </li>

                {{-- Contact --}}
                <li class="nav-item">
                    <a class="nav-link fs-nav-link {{ Request::routeIs('contact') ? 'active' : '' }}"
                       href="{{ route('contact.index') }}">Contact</a>
                </li>
            </ul>

            {{-- Right: Search + User icons only --}}
            <div class="d-flex align-items-center gap-3 fs-navbar-actions">
                {{-- Search icon --}}
                <button class="btn btn-link p-0 border-0 fs-navbar-icon-btn" type="button" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Search">
                    <i class="fas fa-search fs-navbar-icon"></i>
                </button>

                {{-- User / Login icon --}}
                @auth
                    <div class="dropdown fs-navbar-profile">
                        <a href="#" class="d-flex align-items-center text-decoration-none fs-navbar-profile-toggle fs-navbar-icon-btn p-0 border-0 bg-transparent"
                           id="navbarProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Profile">
                            <i class="fas fa-user-circle fs-navbar-icon fs-navbar-icon-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm mt-2 fs-navbar-dropdown" aria-labelledby="navbarProfileDropdown">
                            <li class="px-3 py-2">
                                <div class="d-flex align-items-center">
                                    <div class="fs-profile-avatar fs-profile-avatar-sm me-2">
                                        @if (Auth::user()->avatar_url ?? false)
                                            <img src="{{ Auth::user()->avatar_url }}" alt="">
                                        @else
                                            <span class="fs-profile-initial">{{ strtoupper(mb_substr(Auth::user()->name ?? 'U', 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="fs-profile-name text-dark">{{ Auth::user()->name }}</span>
                                        <span class="fs-profile-role">Member</span>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @if (Route::has('profile.show'))
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user-circle me-2"></i>My Profile</a></li>
                            @endif
                            @if (Route::has('properties.index'))
                                <li><a class="dropdown-item" href="{{ route('properties.index', ['listing_type' => 'my_listings']) }}"><i class="fas fa-home me-2"></i>My Listings</a></li>
                            @endif
                            @if (Route::has('favorites.index'))
                                <li><a class="dropdown-item" href="{{ route('favorites.index') }}"><i class="fas fa-heart me-2"></i>Saved Properties</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="fs-navbar-icon-btn p-0 border-0 bg-transparent text-decoration-none" aria-label="Login">
                        <i class="fas fa-user fs-navbar-icon"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Quick Search Modal --}}
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick Property Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('properties.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Search Keywords</label>
                            <input type="text" class="form-control" name="search" placeholder="Enter location, property name...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Property Type</label>
                            <select class="form-select" name="type">
                                <option value="">All Types</option>
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                                <option value="condo">Condo</option>
                                <option value="townhouse">Townhouse</option>
                                <option value="villa">Villa</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Listing Type</label>
                            <select class="form-select" name="listing_type">
                                <option value="">For Sale & Rent</option>
                                <option value="for_sale">For Sale</option>
                                <option value="for_rent">For Rent</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bedrooms</label>
                            <select class="form-select" name="bedrooms">
                                <option value="">Any</option>
                                <option value="1">1+ Bedroom</option>
                                <option value="2">2+ Bedrooms</option>
                                <option value="3">3+ Bedrooms</option>
                                <option value="4">4+ Bedrooms</option>
                                <option value="5">5+ Bedrooms</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Min Price</label>
                            <input type="number" class="form-control" name="min_price" placeholder="Min Price">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Max Price</label>
                            <input type="number" class="form-control" name="max_price" placeholder="Max Price">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search me-1"></i>Search Properties
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Add some space for fixed navbar --}}
<div style="height: 76px;"></div>
