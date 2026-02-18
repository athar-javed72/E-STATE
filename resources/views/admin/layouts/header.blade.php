<header class="navbar navbar-expand-lg navbar-light admin-navbar">
    <div class="container-fluid px-3 px-lg-4">
        {{-- Mobile menu: open sidebar offcanvas --}}
        <button class="btn btn-link navbar-toggler d-lg-none p-2 me-2 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-controls="adminSidebarOffcanvas" aria-label="Open menu">
            <i class="fas fa-bars fa-lg"></i>
        </button>
        <a class="navbar-brand py-2 fw-bold" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-cog me-2"></i>FindState Admin
        </a>
        {{-- Desktop: View Site + Logout (hidden on mobile; they're in offcanvas) --}}
        <div class="d-none d-lg-flex ms-auto align-items-center gap-2">
            <a class="btn btn-outline-primary btn-sm" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i>View Site
            </a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</header>
