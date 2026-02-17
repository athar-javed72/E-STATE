<nav class="admin-sidebar border-end" style="width: 220px;">
    <ul class="nav flex-column py-2">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.properties.*') ? 'active' : '' }}" href="{{ route('admin.properties.index') }}">
                <i class="fas fa-building"></i>Properties
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.agents.*') ? 'active' : '' }}" href="{{ route('admin.agents.index') }}">
                <i class="fas fa-users"></i>Agents
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}" href="{{ route('admin.blogs.index') }}">
                <i class="fas fa-newspaper"></i>Blogs
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                <i class="fas fa-envelope"></i>Contacts
            </a>
        </li>
    </ul>
</nav>
