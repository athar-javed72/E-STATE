<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'FindState - Find Your Dream Property')</title>
    <meta name="description" content="@yield('meta_description', 'Find your perfect home with FindState. Browse thousands of properties for sale and rent.')">

    <meta property="og:title" content="@yield('og_title', 'FindState - Find Your Dream Property')">
    <meta property="og:description" content="@yield('og_description', 'Find your perfect home with FindState.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/placeholder-600x400.svg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/default-avatar.svg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
</head>
<body class="min-h-screen">
    @include('frontend.components.navbar')

    <main id="main-content">
        @yield('content')
    </main>

    @include('frontend.components.footer')

    <script>
    (function () {
        function csrfToken() {
            var meta = document.querySelector('meta[name="csrf-token"]');
            return meta ? meta.getAttribute('content') : '';
        }

        document.addEventListener('click', function (event) {
            var btn = event.target.closest('.js-wishlist-toggle');
            if (!btn) return;
            event.preventDefault();
            event.stopPropagation();

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
                    if (!res.ok) throw new Error('Wishlist failed');
                    return res.json();
                })
                .then(function (data) {
                    var icon = document.getElementById('wishlist-' + propertyId);
                    if (!icon) return;
                    var on = !!data.in_wishlist;
                    icon.classList.toggle('fas', on);
                    icon.classList.toggle('far', !on);
                    icon.classList.toggle('text-danger', on);
                })
                .catch(function () {
                    alert('Could not update wishlist. Please try again.');
                })
                .finally(function () {
                    btn.disabled = false;
                });
        });

        // Mobile nav drawer
        var openBtn = document.getElementById('nav-open');
        var closeBtn = document.getElementById('nav-close');
        var drawer = document.getElementById('nav-drawer');
        var backdrop = document.getElementById('nav-backdrop');
        function setNav(open) {
            if (!drawer || !backdrop) return;
            drawer.classList.toggle('translate-x-0', open);
            drawer.classList.toggle('translate-x-full', !open);
            backdrop.classList.toggle('opacity-100', open);
            backdrop.classList.toggle('pointer-events-auto', open);
            backdrop.classList.toggle('opacity-0', !open);
            backdrop.classList.toggle('pointer-events-none', !open);
            document.body.classList.toggle('overflow-hidden', open);
        }
        if (openBtn) openBtn.addEventListener('click', function () { setNav(true); });
        if (closeBtn) closeBtn.addEventListener('click', function () { setNav(false); });
        if (backdrop) backdrop.addEventListener('click', function () { setNav(false); });

        // More dropdown (desktop)
        var moreBtn = document.getElementById('nav-more-btn');
        var moreMenu = document.getElementById('nav-more-menu');
        if (moreBtn && moreMenu) {
            moreBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                moreMenu.classList.toggle('hidden');
            });
            document.addEventListener('click', function () {
                moreMenu.classList.add('hidden');
            });
        }

        // Admin / user dropdown
        var userBtn = document.getElementById('nav-user-btn');
        var userMenu = document.getElementById('nav-user-menu');
        if (userBtn && userMenu) {
            userBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                userMenu.classList.toggle('hidden');
            });
            document.addEventListener('click', function () {
                userMenu.classList.add('hidden');
            });
        }
    })();
    </script>
    @stack('scripts')
</body>
</html>
