@extends('admin.layouts.app')

@section('title', 'Agents')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 gap-md-0 mb-3 mb-md-4">
    <h1 class="h4 h3 mb-0">Agents</h1>
    <a href="{{ route('admin.agents.create') }}" class="btn btn-primary btn-sm flex-md-shrink-0">
        <i class="fas fa-plus me-1"></i>Add Agent
    </a>
</div>

<form method="GET" class="row g-2 mb-3 mb-md-4">
    <div class="col-12 col-sm-6 col-md-4">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name or email..." value="{{ request('search') }}">
    </div>
    <div class="col-6 col-md-2">
        <select name="status" class="form-select form-select-sm">
            <option value="">All statuses</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <div class="col-6 col-md-2">
        <button type="submit" class="btn btn-outline-primary btn-sm w-100 w-md-auto">Filter</button>
    </div>
</form>

<div class="card shadow-sm border-0 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive overflow-x-auto">
            <table class="table table-hover align-middle mb-0 table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr>
                            <td>
                                @if($agent->avatar)
                                    <img src="{{ asset('storage/' . $agent->avatar) }}" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <span class="text-muted small">No photo</span>
                                @endif
                            </td>
                            <td>{{ $agent->name }}</td>
                            <td>{{ $agent->email ?? '—' }}</td>
                            <td>{{ $agent->designation ?? '—' }}</td>
                            <td><span class="badge bg-{{ $agent->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($agent->status) }}</span></td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('admin.agents.edit', $agent) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.agents.destroy', $agent) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this agent?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No agents found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($agents->hasPages())
        <div class="card-footer bg-white border-0 overflow-auto">
            {{ $agents->links() }}
        </div>
    @endif
</div>
@endsection
