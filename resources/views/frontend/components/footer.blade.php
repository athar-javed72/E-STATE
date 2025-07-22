{{-- Footer Component --}}
<footer class="bg-dark text-white pt-5 pb-3 mt-auto">
    <div class="container">
        {{-- Main Footer Content --}}
        <div class="row">
            {{-- Company Info --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-section">
                    {{-- Logo --}}
                    <div class="mb-3">
                        <img src="{{ asset('assets/images/logo-white.png') }}"
                             alt="FindState"
                             style="height: 40px;">
                    </div>

                    <p class="text-light opacity-75 mb-3">
                        FindState is your trusted partner in finding the perfect property.
                        With years of experience and a dedicated team of professionals,
                        we make your property dreams come true.
                    </p>

                    {{-- Social Media --}}
                    <div class="social-links">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-section">
                    <h5 class="text-white fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('home') }}" class="text-decoration-none text-light opacity-75">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-decoration-none text-light opacity-75">About Us</a></li>
                        <li><a href="{{ route('services') }}" class="text-decoration-none text-light opacity-75">Services</a></li>
                        <li><a href="{{ route('properties') }}" class="text-decoration-none text-light opacity-75">Properties</a></li>
                        <li><a href="{{ route('agents') }}" class="text-decoration-none text-light opacity-75">Our Agents</a></li>
                        <li><a href="{{ route('blog') }}" class="text-decoration-none text-light opacity-75">Blog</a></li>
                        <li><a href="{{ route('contact') }}" class="text-decoration-none text-light opacity-75">Contact</a></li>
                    </ul>
                </div>
            </div>

            {{-- Property Types --}}
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-section">
                    <h5 class="text-white fw-bold mb-3">Property Types</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('properties', ['type' => 'house']) }}" class="text-decoration-none text-light opacity-75">Houses</a></li>
                        <li><a href="{{ route('properties', ['type' => 'apartment']) }}" class="text-decoration-none text-light opacity-75">Apartments</a></li>
                        <li><a href="{{ route('properties', ['type' => 'villa']) }}" class="text-decoration-none text-light opacity-75">Villas</a></li>
                        <li><a href="{{ route('properties', ['type' => 'commercial']) }}" class="text-decoration-none text-light opacity-75">Commercial</a></li>
                        <li><a href="{{ route('properties', ['type' => 'land']) }}" class="text-decoration-none text-light opacity-75">Land</a></li>
                        <li><a href="{{ route('properties', ['purpose' => 'sale']) }}" class="text-decoration-none text-light opacity-75">For Sale</a></li>
                        <li><a href="{{ route('properties', ['purpose' => 'rent']) }}" class="text-decoration-none text-light opacity-75">For Rent</a></li>
                    </ul>
                </div>
            </div>

            {{-- Contact Info --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-section">
                    <h5 class="text-white fw-bold mb-3">Contact Info</h5>

                    {{-- Address --}}
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                        </div>
                        <div>
                            <p class="text-light opacity-75 mb-0">
                                123 Property Street, Real Estate City<br>
                                New York, NY 10001
                            </p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-phone text-primary me-3"></i>
                        </div>
                        <div>
                            <a href="tel:+1234567890" class="text-light opacity-75 text-decoration-none">
                                +1 (234) 567-8900
                            </a>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-envelope text-primary me-3"></i>
                        </div>
                        <div>
                            <a href="mailto:info@findstate.com" class="text-light opacity-75 text-decoration-none">
                                info@findstate.com
                            </a>
                        </div>
                    </div>

                    {{-- Working Hours --}}
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock text-primary me-3"></i>
                        </div>
                        <div class="text-light opacity-75">
                            <div>Mon - Fri: 9:00 AM - 6:00 PM</div>
                            <div>Sat: 10:00 AM - 4:00 PM</div>
                            <div>Sun: Closed</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Newsletter Section --}}
        <div class="row border-top border-secondary pt-4 mb-4">
            <div class="col-lg-6">
                <h5 class="text-white fw-bold mb-3">Newsletter</h5>
                <p class="text-light opacity-75 mb-3">
                    Subscribe to our newsletter to get the latest property updates and offers.
                </p>
            </div>
            <div class="col-lg-6">
                <form class="newsletter-form" id="newsletterForm">
                    <div class="input-group">
                        <input type="email"
                               class="form-control"
                               placeholder="Enter your email address"
                               name="email"
                               required>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-paper-plane me-1"></i> Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Bottom Footer --}}
        <div class="row border-top border-secondary pt-3">
            <div class="col-md-6">
                <p class="text-light opacity-75 mb-0">
                    © {{ date('Y') }} FindState. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="#" class="text-light opacity-75 text-decoration-none">Terms of Service</a>
                    </li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item">
                        <a href="{{ route('sitemap') }}" class="text-light opacity-75 text-decoration-none">Sitemap</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Back to Top Button --}}
    <div class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </div>
</footer>

{{-- Custom Styles --}}
<style>
.footer-links li {
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.footer-links li:hover {
    padding-left: 5px;
}

.footer-links a:hover {
    opacity: 1 !important;
    color: #ffc107 !important;
}

.social-links a {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background-color: #ffc107;
    border-color: #ffc107;
    transform: translateY(-2px);
}

.newsletter-form .form-control {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border: 1px solid #444;
    background-color: rgba(255,255,255,0.1);
    color: white;
}

.newsletter-form .form-control::placeholder {
    color: rgba(255,255,255,0.7);
}

.newsletter-form .form-control:focus {
    background-color: rgba(255,255,255,0.15);
    border-color: #ffc107;
    box-shadow: none;
    color: white;
}

.newsletter-form .btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1000;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,123,255,0.3);
}

.back-to-top:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,123,255,0.4);
}

@media (max-width: 768px) {
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
    }
}
</style>

{{-- JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Newsletter Form
    document.getElementById('newsletterForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const email = this.querySelector('input[name="email"]').value;

        // Add your newsletter subscription logic here
        // For now, just show a success message
        alert('Thank you for subscribing to our newsletter!');
        this.reset();
    });

    // Back to Top Button
    const backToTop = document.getElementById('backToTop');

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTop.style.display = 'flex';
        } else {
            backToTop.style.display = 'none';
        }
    });

    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
</script>
