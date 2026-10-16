<nav class="space-y-1 p-3" aria-label="Admin">
    <a href="{{ route('admin.dashboard') }}" class="flex h-11 items-center gap-3 rounded-sm px-3 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-brand-light text-brand' : 'text-ink-secondary hover:bg-canvas hover:text-ink' }}">
        <i class="fas fa-tachometer-alt w-5 text-center" aria-hidden="true"></i> Dashboard
    </a>
    <a href="{{ route('admin.properties.index') }}" class="flex h-11 items-center gap-3 rounded-sm px-3 text-sm font-medium {{ request()->routeIs('admin.properties.*') ? 'bg-brand-light text-brand' : 'text-ink-secondary hover:bg-canvas hover:text-ink' }}">
        <i class="fas fa-building w-5 text-center" aria-hidden="true"></i> Properties
    </a>
    <a href="{{ route('admin.agents.index') }}" class="flex h-11 items-center gap-3 rounded-sm px-3 text-sm font-medium {{ request()->routeIs('admin.agents.*') ? 'bg-brand-light text-brand' : 'text-ink-secondary hover:bg-canvas hover:text-ink' }}">
        <i class="fas fa-users w-5 text-center" aria-hidden="true"></i> Agents
    </a>
    <a href="{{ route('admin.blogs.index') }}" class="flex h-11 items-center gap-3 rounded-sm px-3 text-sm font-medium {{ request()->routeIs('admin.blogs.*') ? 'bg-brand-light text-brand' : 'text-ink-secondary hover:bg-canvas hover:text-ink' }}">
        <i class="fas fa-newspaper w-5 text-center" aria-hidden="true"></i> Blogs
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="flex h-11 items-center gap-3 rounded-sm px-3 text-sm font-medium {{ request()->routeIs('admin.testimonials.*') ? 'bg-brand-light text-brand' : 'text-ink-secondary hover:bg-canvas hover:text-ink' }}">
        <i class="fas fa-comment-dots w-5 text-center" aria-hidden="true"></i> Testimonials
    </a>
    <a href="{{ route('admin.contacts.index') }}" class="flex h-11 items-center gap-3 rounded-sm px-3 text-sm font-medium {{ request()->routeIs('admin.contacts.*') ? 'bg-brand-light text-brand' : 'text-ink-secondary hover:bg-canvas hover:text-ink' }}">
        <i class="fas fa-envelope w-5 text-center" aria-hidden="true"></i> Contacts
    </a>
</nav>
