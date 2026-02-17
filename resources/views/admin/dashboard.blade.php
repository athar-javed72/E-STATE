@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="py-3 py-md-4 bg-light border-bottom">
    <div class="container-fluid px-0">
        <h1 class="h4 h3 fw-bold mb-1">Admin Dashboard</h1>
        <p class="text-muted small mb-0">Quick overview of your real estate platform.</p>
    </div>
</section>

<section class="py-4 py-md-5">
    <div class="container-fluid px-0">
        <div class="row g-3 g-md-4 mb-4">
            <div class="col-6 col-md-3">
                <a href="{{ route('admin.properties.index') }}" class="text-decoration-none text-body">
                    <div class="card shadow-sm border-0 h-100 card-hover">
                        <div class="card-body">
                            <h6 class="text-muted text-uppercase small mb-1">Properties</h6>
                            <h3 class="fw-bold mb-0">{{ $stats['properties_total'] }}</h3>
                            <small class="text-success">{{ $stats['properties_active'] }} active</small><br>
                            <small class="text-muted">{{ $stats['properties_sold'] }} sold</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('admin.agents.index') }}" class="text-decoration-none text-body">
                    <div class="card shadow-sm border-0 h-100 card-hover">
                        <div class="card-body">
                            <h6 class="text-muted text-uppercase small mb-1">Agents</h6>
                            <h3 class="fw-bold mb-0">{{ $stats['agents_total'] }}</h3>
                            <small class="text-muted">Active agents</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('admin.blogs.index') }}" class="text-decoration-none text-body">
                    <div class="card shadow-sm border-0 h-100 card-hover">
                        <div class="card-body">
                            <h6 class="text-muted text-uppercase small mb-1">Blog Posts</h6>
                            <h3 class="fw-bold mb-0">{{ $stats['blogs_published'] }}</h3>
                            <small class="text-muted">Published articles</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('admin.contacts.index') }}" class="text-decoration-none text-body">
                    <div class="card shadow-sm border-0 h-100 card-hover">
                        <div class="card-body">
                            <h6 class="text-muted text-uppercase small mb-1">Contacts</h6>
                            <h3 class="fw-bold mb-0">{{ $stats['contacts_total'] }}</h3>
                            <small class="text-success">{{ $stats['contacts_new'] }} new</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-3 g-md-4">
            <div class="col-12 col-lg-7">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 py-2 py-md-3">
                        <h5 class="mb-0 fw-bold small">Recent Properties</h5>
                    </div>
                    <div class="card-body p-2 p-md-3 overflow-auto">
                        @if($recentProperties->count())
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0">
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
                            <p class="text-muted mb-0">No properties yet.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 py-2 py-md-3">
                        <h5 class="mb-0 fw-bold small">Recent Contacts</h5>
                    </div>
                    <div class="card-body p-2 p-md-3">
                        @if($recentContacts->count())
                            <div class="list-group list-group-flush">
                                @foreach($recentContacts as $contact)
                                    <div class="list-group-item px-0 d-flex justify-content-between align-items-start">
                                        <div class="me-3">
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
                                        <small class="text-muted text-nowrap">
                                            {{ $contact->created_at->diffForHumans() }}
                                        </small>
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
    </div>
</section>
@endsection

