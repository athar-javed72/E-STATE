<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Dynamic Meta Tags --}}
    <title>@yield('title', 'FindState - Find Your Dream Property')</title>
    <meta name="description" content="@yield('meta_description', 'Find your perfect home with FindState. Browse thousands of properties for sale and rent.')">
    <meta name="keywords" content="@yield('meta_keywords', 'real estate, properties, homes for sale, homes for rent, property listings')">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="@yield('og_title', 'FindState - Find Your Dream Property')">
    <meta property="og:description" content="@yield('og_description', 'Find your perfect home with FindState.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/placeholder-600x400.svg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/default-avatar.svg') }}">

    {{-- CSS Files --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">

    {{-- Vite / Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Additional CSS --}}
    @stack('css')
</head>
<body>
    {{-- Loading Spinner --}}
    <div id="preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    {{-- Navigation --}}
    @include('frontend.components.navbar')

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('frontend.components.footer')

    {{-- Back to Top Button --}}
    <button id="back-to-top" class="btn btn-primary" style="display: none;">
        <i class="fas fa-arrow-up"></i>
    </button>

    {{-- JavaScript Files --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    {{-- Page-specific JavaScript --}}
    @stack('js')

    {{-- Initialize AOS --}}
    <script>
        $(document).ready(function() {
            // Initialize AOS
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true,
                    mirror: false
                });
            }

            // Hide preloader
            $('#preloader').fadeOut('slow');

            // Back to top button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });

            $('#back-to-top').click(function() {
                $('html, body').animate({scrollTop: 0}, 800);
                return false;
            });
        });
    </script>

    {{-- Additional JavaScript --}}
    @stack('scripts')
</body>
</html>
