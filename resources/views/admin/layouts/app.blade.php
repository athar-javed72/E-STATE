<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - FindState</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @stack('css')
</head>
<body class="admin-body bg-light">
    @include('admin.layouts.header')

    <div class="d-flex flex-column flex-lg-row">
        {{-- Desktop sidebar (lg and up) --}}
        <nav class="admin-sidebar d-none d-lg-block">
            @include('admin.layouts.sidebar-nav')
        </nav>

        {{-- Mobile sidebar (offcanvas) --}}
        <div class="offcanvas offcanvas-start d-lg-none admin-offcanvas" tabindex="-1" id="adminSidebarOffcanvas" aria-labelledby="adminSidebarLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="adminSidebarLabel">FindState Admin</h5>
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
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <footer class="admin-nexora-footer py-2 text-center border-top bg-white">
        <span class="text-muted small">Nexora Labs © {{ date('Y') }}</span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')
</body>
</html>
