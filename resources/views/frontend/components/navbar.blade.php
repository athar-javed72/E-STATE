<header class="sticky top-0 z-40 border-b border-line bg-white">
    <x-container class="flex h-[72px] items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2 text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-sm bg-brand text-white">
                <i class="fas fa-building" aria-hidden="true"></i>
            </span>
            <span class="text-base font-bold">FindState</span>
        </a>

        <nav class="hidden items-center gap-6 lg:flex" aria-label="Primary">
            <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-brand' : 'text-ink-secondary hover:text-ink' }} transition-ui">Home</a>
            <a href="{{ route('properties.index') }}" class="text-sm font-medium {{ request()->routeIs('properties.*') ? 'text-brand' : 'text-ink-secondary hover:text-ink' }} transition-ui">Properties</a>
            <a href="{{ route('agents.index') }}" class="text-sm font-medium {{ request()->routeIs('agents.*') ? 'text-brand' : 'text-ink-secondary hover:text-ink' }} transition-ui">Agents</a>
            <a href="{{ route('blog.index') }}" class="text-sm font-medium {{ request()->routeIs('blog.*') ? 'text-brand' : 'text-ink-secondary hover:text-ink' }} transition-ui">Blog</a>
            <div class="relative">
                <button id="nav-more-btn" type="button" class="inline-flex h-11 items-center gap-1 text-sm font-medium text-ink-secondary transition-ui hover:text-ink">
                    More <i class="fas fa-chevron-down text-xs" aria-hidden="true"></i>
                </button>
                <div id="nav-more-menu" class="absolute left-0 top-full z-50 mt-2 hidden w-44 rounded-md border border-line bg-white py-2 shadow-lg">
                    <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-ink-secondary hover:bg-canvas hover:text-ink">About</a>
                    <a href="{{ route('services') }}" class="block px-4 py-2 text-sm text-ink-secondary hover:bg-canvas hover:text-ink">Services</a>
                    <a href="{{ route('contact.index') }}" class="block px-4 py-2 text-sm text-ink-secondary hover:bg-canvas hover:text-ink">Contact</a>
                </div>
            </div>
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <a href="{{ route('contact.index') }}?subject=list_property" class="inline-flex h-11 items-center justify-center rounded-sm bg-accent px-5 text-sm font-semibold text-white transition-ui hover:bg-accent/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">
                List Property
            </a>
            @auth
                <div class="relative">
                    <button id="nav-user-btn" type="button" class="inline-flex h-11 items-center gap-2 rounded-sm border border-line px-4 text-sm font-semibold text-ink">
                        {{ Str::limit(Auth::user()->name, 12) }}
                        <i class="fas fa-chevron-down text-xs" aria-hidden="true"></i>
                    </button>
                    <div id="nav-user-menu" class="absolute right-0 top-full z-50 mt-2 hidden w-48 rounded-md border border-line bg-white py-2 shadow-lg">
                        <p class="border-b border-line px-4 py-2 text-xs text-ink-muted">{{ Auth::user()->email }}</p>
                        @if(Auth::user()?->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-ink-secondary hover:bg-canvas">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-danger hover:bg-canvas">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <x-button variant="ghost" href="{{ route('login') }}">Login</x-button>
            @endauth
        </div>

        <button id="nav-open" type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-sm border border-line text-ink lg:hidden" aria-label="Open menu">
            <i class="fas fa-bars" aria-hidden="true"></i>
        </button>
    </x-container>
</header>

<div id="nav-backdrop" class="fixed inset-0 z-40 bg-ink/40 opacity-0 pointer-events-none transition-ui lg:hidden"></div>
<aside id="nav-drawer" class="fixed inset-y-0 right-0 z-50 flex w-full max-w-sm translate-x-full flex-col bg-white shadow-lg transition-ui lg:hidden" aria-label="Mobile menu">
    <div class="flex h-[72px] items-center justify-between border-b border-line px-4">
        <span class="text-base font-bold text-ink">Menu</span>
        <button id="nav-close" type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-sm border border-line" aria-label="Close menu">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>
    <nav class="flex-1 space-y-1 overflow-y-auto p-4">
        <a href="{{ route('home') }}" class="block rounded-sm px-4 py-3 text-sm font-medium text-ink hover:bg-canvas">Home</a>
        <a href="{{ route('properties.index') }}" class="block rounded-sm px-4 py-3 text-sm font-medium text-ink hover:bg-canvas">Properties</a>
        <a href="{{ route('agents.index') }}" class="block rounded-sm px-4 py-3 text-sm font-medium text-ink hover:bg-canvas">Agents</a>
        <a href="{{ route('blog.index') }}" class="block rounded-sm px-4 py-3 text-sm font-medium text-ink hover:bg-canvas">Blog</a>
        <a href="{{ route('about') }}" class="block rounded-sm px-4 py-3 text-sm font-medium text-ink hover:bg-canvas">About</a>
        <a href="{{ route('services') }}" class="block rounded-sm px-4 py-3 text-sm font-medium text-ink hover:bg-canvas">Services</a>
        <a href="{{ route('contact.index') }}" class="block rounded-sm px-4 py-3 text-sm font-medium text-ink hover:bg-canvas">Contact</a>
    </nav>
    <div class="space-y-3 border-t border-line p-4">
        <a href="{{ route('contact.index') }}?subject=list_property" class="inline-flex h-11 w-full items-center justify-center rounded-sm bg-accent text-sm font-semibold text-white">List Property</a>
        @auth
            @if(Auth::user()?->is_admin)
                <x-button variant="secondary" href="{{ route('admin.dashboard') }}" block>Dashboard</x-button>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-button variant="ghost" type="submit" block>Logout</x-button>
            </form>
        @else
            <x-button variant="ghost" href="{{ route('login') }}" block>Login</x-button>
        @endauth
    </div>
</aside>
