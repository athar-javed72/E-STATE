{{-- Navigation Bar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        {{-- Logo --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <strong class="text-primary">FindState</strong>
        </a>

        {{-- Mobile Toggle Button --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navigation Links --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-4">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}"
                       href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::routeIs('properties.*') ? 'active' : '' }}"
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
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('agents.*') ? 'active' : '' }}"
                       href="{{ route('agents.index') }}">Agents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('blog.*') ? 'active' : '' }}"
                       href="{{ route('blog.index') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('services') ? 'active' : '' }}"
                       href="{{ route('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('contact') ? 'active' : '' }}"
                       href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>

            {{-- Search & CTA Buttons --}}
            <div class="d-flex align-items-center gap-2">
                {{-- Quick Search Toggle --}}
                <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="fas fa-search"></i>
                    <span class="d-none d-md-inline ms-1">Search</span>
                </button>

                {{-- Add Property Button --}}
                <a href="{{ route('contact') }}?subject=list_property" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                    <span class="d-none d-lg-inline ms-1">List Property</span>
                </a>
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
