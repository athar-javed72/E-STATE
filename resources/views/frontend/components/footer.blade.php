{{-- FindState Footer - Simple & Professional --}}
<footer class="fs-footer mt-auto">
    <div class="container">
        <div class="row align-items-center py-4">
            <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                <a href="{{ route('home') }}" class="fs-footer-brand">FindState</a>
            </div>
            <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                <nav class="fs-footer-nav">
                    <a href="{{ route('properties.index', ['listing_type' => 'for_sale']) }}">Buy</a>
                    <a href="{{ route('properties.index', ['listing_type' => 'for_rent']) }}">Rent</a>
                    <a href="{{ route('properties.index') }}">Locations</a>
                    <a href="{{ route('contact.index') }}?subject=list_property">List Property</a>
                </nav>
            </div>
            <div class="col-lg-4 col-md-12 text-lg-end">
                <div class="fs-footer-contact">
                    <a href="mailto:info@findstate.com"><i class="fas fa-envelope me-1"></i> info@findstate.com</a>
                    <a href="tel:+1234567890"><i class="fas fa-phone me-1"></i> +1 (234) 567-8900</a>
                </div>
            </div>
        </div>
        <div class="fs-footer-bottom py-3">
            <p class="mb-0 small">© {{ date('Y') }} FindState. Built by <span class="nexora-brand">Nexora Labs</span>.</p>
        </div>
    </div>

    {{-- Back to Top --}}
    <button type="button" class="fs-back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<style>
.fs-footer {
    background: #1F2937;
    color: rgba(255,255,255,0.85);
    font-size: 0.95rem;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}
.fs-footer-brand {
    font-size: 1.35rem;
    font-weight: 700;
    color: #fff;
    text-decoration: none;
    letter-spacing: -0.02em;
}
.fs-footer-brand:hover { color: #fff; opacity: 0.9; }
.fs-footer-nav {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem 1.5rem;
}
.fs-footer-nav a {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}
.fs-footer-nav a:hover { color: #34d399; }
.fs-footer-contact {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem 1.5rem;
    justify-content: flex-end;
}
.fs-footer-contact a {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    transition: color 0.2s;
}
.fs-footer-contact a:hover { color: #34d399; }
.fs-footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.6);
}
.nexora-brand {
    color: rgba(255,255,255,0.75);
    font-weight: 500;
    text-decoration: none;
}
.nexora-brand:hover { color: rgba(255,255,255,0.9); }
.fs-back-to-top {
    position: fixed;
    bottom: 4.5rem;
    right: 1.5rem;
    width: 44px;
    height: 44px;
    background: #1e5f4a;
    color: #fff;
    border: none;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 999;
    transition: background 0.2s, transform 0.2s;
}
.fs-back-to-top:hover { background: #164a3a; color: #fff; transform: translateY(-2px); }
.fs-back-to-top.visible { display: flex; }
@media (max-width: 767px) {
    .fs-footer-nav { justify-content: flex-start; }
    .fs-footer-contact { justify-content: flex-start; }
    .fs-back-to-top { bottom: 1.25rem; right: 1.25rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', function() {
            backToTop.classList.toggle('visible', window.pageYOffset > 400);
        });
        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
</script>
