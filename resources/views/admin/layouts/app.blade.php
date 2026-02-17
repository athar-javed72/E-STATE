<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - FindState</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    @stack('css')
    <style>
        .admin-sidebar { min-height: calc(100vh - 56px); background: #2c3e50; flex-shrink: 0; }
        .admin-sidebar .nav-link { color: rgba(255,255,255,0.85); padding: 0.75rem 1rem; border-left: 3px solid transparent; }
        .admin-sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,0.08); }
        .admin-sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,0.1); border-left-color: #3498db; }
        .admin-sidebar .nav-link i { width: 1.25rem; text-align: center; margin-right: 0.5rem; }
        .card-hover { transition: transform 0.15s ease, box-shadow 0.15s ease; cursor: pointer; }
        a:hover .card-hover { transform: translateY(-2px); box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1) !important; }
        .admin-main { min-height: calc(100vh - 56px); min-width: 0; overflow-x: hidden; }
        @media (max-width: 991.98px) {
            .admin-offcanvas .nav-link { color: #212529; border-left-color: transparent; padding: 0.65rem 1rem; }
            .admin-offcanvas .nav-link:hover { background: rgba(0,0,0,0.05); color: #0d6efd; }
            .admin-offcanvas .nav-link.active { background: rgba(13,110,253,0.1); color: #0d6efd; border-left: 3px solid #0d6efd; }
        }
        @media (max-width: 767.98px) {
            .admin-main .h3 { font-size: 1.25rem; }
            .pagination { flex-wrap: wrap; gap: 0.25rem; }
            .pagination .page-link { padding: 0.35rem 0.65rem; font-size: 0.875rem; }
        }
    </style>
</head>
<body class="bg-light">
    @include('admin.layouts.header')

    <div class="d-flex flex-column flex-lg-row">
        {{-- Desktop sidebar (lg and up) --}}
        <nav class="admin-sidebar border-end d-none d-lg-block" style="width: 220px;">
            @include('admin.layouts.sidebar-nav')
        </nav>

        {{-- Mobile sidebar (offcanvas) --}}
        <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="adminSidebarOffcanvas" aria-labelledby="adminSidebarLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="adminSidebarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0 admin-offcanvas">
                @include('admin.layouts.sidebar-nav')
                <hr class="my-2">
                <ul class="nav flex-column py-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" target="_blank">
                            <i class="fas fa-external-link-alt"></i> View Site
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="p-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <main class="admin-main flex-grow-1 p-3 p-md-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')
</body>
</html>
