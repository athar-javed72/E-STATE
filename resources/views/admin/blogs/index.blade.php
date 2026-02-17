@extends('admin.layouts.app')

@section('title', 'Blogs')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 gap-md-0 mb-3 mb-md-4">
    <h1 class="h4 h3 mb-0">Blog Posts</h1>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm flex-md-shrink-0">
        <i class="fas fa-plus me-1"></i>Add Post
    </a>
</div>

<form method="GET" class="row g-2 mb-3 mb-md-4">
    <div class="col-12 col-sm-6 col-md-4">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search title, category, author..." value="{{ request('search') }}">
    </div>
    <div class="col-6 col-md-2">
        <select name="status" class="form-select form-select-sm">
            <option value="">All statuses</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
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
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                        <tr>
                            <td>
                                @if($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="" class="rounded" style="width: 50px; height: 40px; object-fit: cover;">
                                @else
                                    <span class="text-muted small">No image</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($blog->title, 40) }}</td>
                            <td>{{ $blog->category ?? '—' }}</td>
                            <td>{{ $blog->author ?? '—' }}</td>
                            <td><span class="badge bg-{{ $blog->status === 'published' ? 'success' : ($blog->status === 'draft' ? 'warning' : 'secondary') }}">{{ ucfirst($blog->status) }}</span></td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No blog posts found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($blogs->hasPages())
        <div class="card-footer bg-white border-0 overflow-auto">
            {{ $blogs->links() }}
        </div>
    @endif
</div>
@endsection
