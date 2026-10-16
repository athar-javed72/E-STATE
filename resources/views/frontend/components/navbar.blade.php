{{-- Modern Professional Navbar - FindState --}}
<header class="site-header" id="siteHeader">
    <nav class="navbar navbar-expand-lg" id="mainNavbar">
        <div class="container">
            {{-- Logo --}}
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span class="brand-icon">
                    <i class="fas fa-building"></i>
                </span>
                <span class="brand-text">FindState</span>
            </a>

            {{-- Toggle for mobile --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                {{-- Main nav links --}}
                <ul class="navbar-nav nav-links mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item dropdown nav-dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::routeIs('properties.*') ? 'active' : '' }}" href="{{ route('properties.index') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">Properties</a>
                        <ul class="dropdown-menu dropdown-menu-shadow">
                            <li><a class="dropdown-item" href="{{ route('properties.index') }}"><i class="fas fa-th-large me-2 opacity-75"></i>All Properties</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header small text-uppercase text-muted">By Purpose</h6></li>
                            <li><a class="dropdown-item" href="{{ route('properties.index', ['listing_type' => 'for_sale']) }}">For Sale</a></li>
                            <li><a class="dropdown-item" href="{{ route('properties.index', ['listing_type' => 'for_rent']) }}">For Rent</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header small text-uppercase text-muted">By Type</h6></li>
                            <li><a class="dropdown-item" href="{{ route('properties.index', ['type' => 'house']) }}">Houses</a></li>
                            <li><a class="dropdown-item" href="{{ route('properties.index', ['type' => 'apartment']) }}">Apartments</a></li>
                            <li><a class="dropdown-item" href="{{ route('properties.index', ['type' => 'condo']) }}">Condos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('agents.*') ? 'active' : '' }}" href="{{ route('agents.index') }}">Agents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('contact') ? 'active' : '' }}" href="{{ route('contact.index') }}">Contact</a>
                    </li>
                </ul>

                {{-- Actions --}}
                <div class="navbar-actions d-flex align-items-center gap-2 flex-shrink-0">
                    <button class="btn btn-nav btn-search" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search"></i>
                        <span class="btn-text">Search</span>
                    </button>
                    <a href="{{ route('contact.index') }}?subject=list_property" class="btn btn-nav btn-cta">
                        <i class="fas fa-plus"></i>
                        <span class="btn-text">List Property</span>
                    </a>
                    @auth
                        <div class="dropdown user-dropdown">
                            <a class="btn btn-nav btn-user dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="user-avatar"><i class="fas fa-user"></i></span>
                                <span class="user-name d-none d-md-inline">{{ Str::limit(Auth::user()->name, 14) }}</span>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-shadow">
                                <li class="px-3 py-2 border-bottom"><span class="small text-muted">{{ Auth::user()->email }}</span></li>
                                @if(Auth::user()?->is_admin)
                                    <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                    <li><hr class="dropdown-divider my-0"></li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-nav btn-outline d-flex align-items-center gap-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span class="btn-text">Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

{{-- Quick Search Modal --}}
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="modal-header border-0 pb-0 bg-light">
                <h5 class="modal-title fw-semibold"><i class="fas fa-search me-2 text-primary"></i>Quick Property Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <form action="{{ route('properties.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Keywords</label>
                            <input type="text" class="form-control" name="search" placeholder="Location, property name...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Property Type</label>
                            <select class="form-select" name="type">
                                <option value="">All Types</option>
                                @foreach(\App\Models\Property::TYPES as $t)
                                    <option value="{{ $t }}">{{ ucfirst($t) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Listing Type</label>
                            <select class="form-select" name="listing_type">
                                <option value="">For Sale & Rent</option>
                                <option value="for_sale">For Sale</option>
                                <option value="for_rent">For Rent</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Bedrooms</label>
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
                            <label class="form-label small fw-semibold text-muted">Min Price</label>
                            <input type="number" class="form-control" name="min_price" placeholder="Min">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Max Price</label>
                            <input type="number" class="form-control" name="max_price" placeholder="Max">
                        </div>
                    </div>
                    <div class="mt-4 d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-search me-1"></i>Search
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Spacer for fixed header --}}
<div class="navbar-spacer"></div>
