@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="admin-page-header">
    <h1 class="admin-page-title">Admin Dashboard</h1>
    <p class="admin-page-subtitle">Quick overview of your real estate platform.</p>
</section>

<section class="py-4">
    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-lg-3">
            <a href="{{ route('admin.properties.index') }}" class="admin-stat-card">
                <div class="card admin-card shadow-sm">
                    <div class="card-body">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-label">Properties</div>
                        <div class="stat-value">{{ $stats['properties_total'] }}</div>
                        <small class="text-success">{{ $stats['properties_active'] }} active</small>
                        <small class="text-muted"> · {{ $stats['properties_sold'] }} sold</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('admin.agents.index') }}" class="admin-stat-card">
                <div class="card admin-card shadow-sm">
                    <div class="card-body">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-label">Agents</div>
                        <div class="stat-value">{{ $stats['agents_total'] }}</div>
                        <small class="text-muted">Active agents</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('admin.blogs.index') }}" class="admin-stat-card">
                <div class="card admin-card shadow-sm">
                    <div class="card-body">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-label">Blog Posts</div>
                        <div class="stat-value">{{ $stats['blogs_published'] }}</div>
                        <small class="text-muted">Published articles</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('admin.contacts.index') }}" class="admin-stat-card">
                <div class="card admin-card shadow-sm">
                    <div class="card-body">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stat-label">Contacts</div>
                        <div class="stat-value">{{ $stats['contacts_total'] }}</div>
                        <small class="text-success">{{ $stats['contacts_new'] }} new</small>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-3 g-md-4">
        <div class="col-12 col-lg-7">
            <div class="card admin-card shadow-sm h-100">
                <div class="card-header">
                    <h5 class="mb-0">Recent Properties</h5>
                </div>
                <div class="card-body p-0 overflow-auto">
                    @if($recentProperties->count())
                        <div class="admin-table-wrap">
                            <table class="table table-sm align-middle mb-0 admin-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Listing</th>
                                        <th>City</th>
                                        <th class="text-end">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentProperties as $property)
                                        <tr>
                                            <td>
                                                <a href="{{ route('properties.show', $property->slug) }}" target="_blank">
                                                    {{ \Illuminate\Support\Str::limit($property->title, 32) }}
                                                </a>
                                            </td>
                                            <td>{{ ucfirst($property->type) }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $property->listing_type)) }}</td>
                                            <td>{{ $property->city }}</td>
                                            <td class="text-end">${{ number_format($property->price) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0 p-3">No properties yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="card admin-card shadow-sm h-100">
                <div class="card-header">
                    <h5 class="mb-0">Recent Contacts</h5>
                </div>
                <div class="card-body">
                    @if($recentContacts->count())
                        <div class="list-group list-group-flush admin-list-group">
                            @foreach($recentContacts as $contact)
                                <div class="list-group-item px-0 d-flex justify-content-between align-items-start border-0">
                                    <div class="me-3 flex-grow-1">
                                        <div class="fw-bold">{{ $contact->name }}</div>
                                        <small class="text-muted d-block">
                                            {{ $contact->email }}
                                            @if($contact->property_id)
                                                · Property #{{ $contact->property_id }}
                                            @endif
                                        </small>
                                        <small class="text-muted d-block">
                                            {{ \Illuminate\Support\Str::limit($contact->subject, 40) }}
                                        </small>
                                    </div>
                                    <small class="text-muted text-nowrap">{{ $contact->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No contact messages yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

