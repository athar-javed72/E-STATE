@extends('admin.layouts.app')

@section('title', 'Contacts')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 gap-md-0 mb-3 mb-md-4">
    <h1 class="h4 h3 mb-0">Contacts</h1>
</div>

<form method="GET" class="row g-2 mb-3 mb-md-4">
    <div class="col-6 col-md-2">
        <select name="status" class="form-select form-select-sm">
            <option value="">All statuses</option>
            <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
            <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
            <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
        </select>
    </div>
    <div class="col-6 col-md-2">
        <select name="type" class="form-select form-select-sm">
            <option value="">All types</option>
            <option value="general" {{ request('type') === 'general' ? 'selected' : '' }}>General</option>
            <option value="property_inquiry" {{ request('type') === 'property_inquiry' ? 'selected' : '' }}>Property Inquiry</option>
        </select>
    </div>
    <div class="col-12 col-md-2">
        <button type="submit" class="btn btn-outline-primary btn-sm w-100 w-md-auto">Filter</button>
    </div>
</form>

<div class="card shadow-sm border-0 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive overflow-x-auto">
            <table class="table table-hover align-middle mb-0 table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ Str::limit($contact->subject, 40) }}</td>
                            <td><span class="badge bg-{{ $contact->type === 'property_inquiry' ? 'info' : 'secondary' }}">{{ $contact->type === 'property_inquiry' ? 'Property' : 'General' }}</span></td>
                            <td><span class="badge bg-{{ $contact->status === 'new' ? 'warning' : 'success' }}">{{ ucfirst($contact->status) }}</span></td>
                            <td>{{ $contact->created_at->format('M j, Y H:i') }}</td>
                        </tr>
                        @if($contact->message)
                            <tr class="table-light">
                                <td colspan="6" class="small text-muted py-2">{{ Str::limit($contact->message, 120) }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No contacts found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($contacts->hasPages())
        <div class="card-footer bg-white border-0 overflow-auto">
            {{ $contacts->links() }}
        </div>
    @endif
</div>
@endsection
