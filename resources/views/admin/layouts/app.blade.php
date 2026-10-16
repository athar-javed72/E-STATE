<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — FindState</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
</head>
<body class="min-h-screen bg-canvas text-ink">
    <div class="flex min-h-screen">
        {{-- Desktop sidebar --}}
        <aside class="hidden w-64 shrink-0 border-r border-line bg-white lg:block">
            <div class="flex h-16 items-center gap-2 border-b border-line px-5">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-sm bg-brand text-white"><i class="fas fa-building"></i></span>
                <span class="text-sm font-bold">FindState Admin</span>
            </div>
            @include('admin.layouts.sidebar-nav')
        </aside>

        <div class="flex min-w-0 flex-1 flex-col">
            <header class="flex h-16 items-center justify-between border-b border-line bg-white px-4 sm:px-6">
                <button type="button" id="admin-nav-open" class="inline-flex h-11 w-11 items-center justify-center rounded-sm border border-line lg:hidden" aria-label="Open sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <p class="hidden text-sm font-semibold text-ink sm:block lg:block">@yield('title', 'Dashboard')</p>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-ink-secondary hover:text-ink">View site</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex h-11 items-center rounded-sm border border-line px-4 text-sm font-semibold text-ink">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 rounded-sm border border-brand/20 bg-brand-light px-4 py-3 text-sm text-brand">{{ session('success') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Mobile sidebar drawer --}}
    <div id="admin-backdrop" class="fixed inset-0 z-40 hidden bg-ink/40 lg:hidden"></div>
    <aside id="admin-drawer" class="fixed inset-y-0 left-0 z-50 hidden w-72 -translate-x-full border-r border-line bg-white shadow-lg transition-ui lg:hidden">
        <div class="flex h-16 items-center justify-between border-b border-line px-4">
            <span class="text-sm font-bold">Menu</span>
            <button type="button" id="admin-nav-close" class="inline-flex h-11 w-11 items-center justify-center rounded-sm border border-line" aria-label="Close sidebar"><i class="fas fa-times"></i></button>
        </div>
        @include('admin.layouts.sidebar-nav')
    </aside>

    <script>
    (function () {
        var open = document.getElementById('admin-nav-open');
        var close = document.getElementById('admin-nav-close');
        var drawer = document.getElementById('admin-drawer');
        var backdrop = document.getElementById('admin-backdrop');
        function setOpen(v) {
            if (!drawer || !backdrop) return;
            drawer.classList.toggle('hidden', !v);
            backdrop.classList.toggle('hidden', !v);
            drawer.classList.toggle('-translate-x-full', !v);
            drawer.classList.toggle('translate-x-0', v);
            document.body.classList.toggle('overflow-hidden', v);
        }
        if (open) open.addEventListener('click', function () { setOpen(true); });
        if (close) close.addEventListener('click', function () { setOpen(false); });
        if (backdrop) backdrop.addEventListener('click', function () { setOpen(false); });
    })();
    </script>
    @stack('scripts')
</body>
</html>
