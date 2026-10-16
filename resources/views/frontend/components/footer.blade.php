<footer class="border-t border-line bg-ink text-white">
    <x-container class="py-16">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <p class="text-base font-bold">FindState</p>
                <p class="mt-3 text-sm text-white/70">Find homes, agents, and market insights in one clean place.</p>
            </div>
            <div>
                <p class="text-sm font-semibold">Explore</p>
                <ul class="mt-4 space-y-2 text-sm text-white/70">
                    <li><a class="hover:text-white" href="{{ route('properties.index') }}">Properties</a></li>
                    <li><a class="hover:text-white" href="{{ route('agents.index') }}">Agents</a></li>
                    <li><a class="hover:text-white" href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a class="hover:text-white" href="{{ route('services') }}">Services</a></li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-semibold">Company</p>
                <ul class="mt-4 space-y-2 text-sm text-white/70">
                    <li><a class="hover:text-white" href="{{ route('about') }}">About</a></li>
                    <li><a class="hover:text-white" href="{{ route('contact.index') }}">Contact</a></li>
                    <li><a class="hover:text-white" href="{{ route('login') }}">Admin Login</a></li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-semibold">Newsletter</p>
                <p class="mt-3 text-sm text-white/70">Get new listings in your inbox.</p>
                <form action="{{ route('api.newsletter.subscribe') }}" method="POST" class="mt-4 flex flex-col gap-3 sm:flex-row" id="footer-newsletter">
                    @csrf
                    <label class="sr-only" for="newsletter-email">Email</label>
                    <input id="newsletter-email" type="email" name="email" required placeholder="you@example.com"
                           class="h-11 w-full rounded-sm border-0 bg-white/10 px-4 text-sm text-white placeholder:text-white/50 focus:ring-2 focus:ring-brand-light">
                    <x-button variant="secondary" type="submit">Subscribe</x-button>
                </form>
            </div>
        </div>
        <div class="mt-12 border-t border-white/10 pt-6 text-xs text-white/50">
            © {{ date('Y') }} FindState. All rights reserved.
        </div>
    </x-container>
</footer>
