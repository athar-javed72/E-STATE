<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <h5>
                    <i class="fas fa-home me-2"></i>Findstate
                </h5>
                <p class="mb-4">Your trusted partner in finding the perfect property. We help you discover your dream home with our extensive listings and expert guidance.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('properties.index') }}">Properties</a></li>
                    <li><a href="{{ route('agents.index') }}">Agents</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Property Types</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('properties.index', ['property_type' => 'residential']) }}">Residential</a></li>
                    <li><a href="{{ route('properties.index', ['property_type' => 'commercial']) }}">Commercial</a></li>
                    <li><a href="{{ route('properties.index', ['property_type' => 'villa']) }}">Villa</a></li>
                    <li><a href="{{ route('properties.index', ['property_type' => 'apartment']) }}">Apartment</a></li>
                    <li><a href="{{ route('properties.index', ['property_type' => 'office']) }}">Office</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Contact Info</h5>
                <ul class="list-unstyled">
                    <li>
                        <i class="fas fa-map-marker-alt me-2"></i>
                        123 Main Street, Lahore, Pakistan
                    </li>
                    <li>
                        <i class="fas fa-phone me-2"></i>
                        <a href="tel:+923001234567">+92 300 1234567</a>
                    </li>
                    <li>
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:info@findstate.com">info@findstate.com</a>
                    </li>
                    <li>
                        <i class="fas fa-clock me-2"></i>
                        Mon - Fri: 9:00 AM - 6:00 PM
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4">

        <div class="row align-items-center">
            <div class="col-md-6">
                <p>&copy; {{ date('Y') }} Findstate. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="me-3">Privacy Policy</a>
                <a href="#" class="me-3">Terms of Service</a>
                <a href="#">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
