@extends('layouts.app')

@section('title', 'Admin Dashboard - FindState')
@section('meta_description', 'Overview of properties, agents, contacts, and content for the FindState platform.')

@section('content')
<section class="py-4 bg-light border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold mb-1">Admin Dashboard</h1>
                <p class="text-muted mb-0">Quick overview of your real estate platform.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="text-muted text-uppercase small mb-1">Properties</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['properties_total'] }}</h3>
                        <small class="text-success">{{ $stats['properties_active'] }} active</small><br>
                        <small class="text-muted">{{ $stats['properties_sold'] }} sold</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="text-muted text-uppercase small mb-1">Agents</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['agents_total'] }}</h3>
                        <small class="text-muted">Active agents</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="text-muted text-uppercase small mb-1">Blog Posts</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['blogs_published'] }}</h3>
                        <small class="text-muted">Published articles</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="text-muted text-uppercase small mb-1">Contacts</h6>
                        <h3 class="fw-bold mb-0">{{ $stats['contacts_total'] }}</h3>
                        <small class="text-success">{{ $stats['contacts_new'] }} new</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0 fw-bold">Recent Properties</h5>
                    </div>
                    <div class="card-body">
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

            <div class="col-lg-5">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0 fw-bold">Recent Contacts</h5>
                    </div>
                    <div class="card-body">
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

