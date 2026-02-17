<header class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <div class="container-fluid px-3 px-lg-4">
        {{-- Mobile menu: open sidebar offcanvas --}}
        <button class="btn btn-link navbar-toggler d-lg-none text-white p-2 me-2 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-controls="adminSidebarOffcanvas" aria-label="Open menu">
            <i class="fas fa-bars fa-lg"></i>
        </button>
        <a class="navbar-brand py-2" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-cog me-2"></i><span class="d-none d-sm-inline">FindState</span> Admin
        </a>
        {{-- Desktop: View Site + Logout (hidden on mobile; they're in offcanvas) --}}
        <div class="d-none d-lg-flex ms-auto align-items-center">
            <a class="nav-link text-white me-2" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i>View Site
            </a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</header>
