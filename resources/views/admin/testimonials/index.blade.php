@extends('admin.layouts.app')

@section('title', 'Testimonials')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 mb-4">
    <h1 class="admin-page-title mb-0">Testimonials</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm flex-md-shrink-0">
        <i class="fas fa-plus me-1"></i> Add Testimonial
    </a>
</div>

<div class="card admin-filters">
    <div class="card-body p-0 border-0">
        <form method="GET" class="row g-2 align-items-end p-0">
            <div class="col-12 col-sm-6 col-md-4">
                <label class="form-label small mb-0">Search</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name or content..." value="{{ request('search') }}">
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label small mb-0">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">All statuses</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <button type="submit" class="btn btn-outline-primary btn-sm w-100 w-md-auto">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card admin-card shadow-sm overflow-hidden">
    <div class="card-body p-0">
        <div class="admin-table-wrap">
            <table class="table table-hover align-middle mb-0 admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->designation ?? '—' }}</td>
                            <td>{{ $testimonial->rating }}/5</td>
                            <td><span class="badge bg-{{ $testimonial->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($testimonial->status) }}</span></td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this testimonial?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No testimonials found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($testimonials->hasPages())
        <div class="card-footer">{{ $testimonials->links() }}</div>
    @endif
</div>
@endsection
