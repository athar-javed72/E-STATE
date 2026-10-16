@extends('admin.layouts.app')

@section('title', 'Properties')

@section('content')
<x-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Properties'],
]" />

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Properties</h1>
    <x-button variant="primary" href="{{ route('admin.properties.create') }}">Add Property</x-button>
</div>

<form method="GET" class="mb-6 grid grid-cols-1 gap-3 rounded-md border border-line bg-white p-4 shadow-sm sm:grid-cols-2 lg:grid-cols-4">
    <x-input name="search" label="Search" placeholder="Search..." :value="request('search')" />
    <x-select name="type" label="Type">
        <option value="">All types</option>
        @foreach(\App\Models\Property::TYPES as $t)
            <option value="{{ $t }}" @selected(request('type') === $t)>{{ ucfirst($t) }}</option>
        @endforeach
    </x-select>
    <x-select name="status" label="Status">
        <option value="">All statuses</option>
        @foreach(['active','sold','pending','inactive'] as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
        @endforeach
    </x-select>
    <div class="flex items-end">
        <x-button variant="ghost" type="submit" block>Filter</x-button>
    </div>
</form>

<div class="overflow-hidden rounded-md border border-line bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-canvas text-xs uppercase text-ink-muted">
                <tr>
                    <th class="px-4 py-3 font-semibold">Title</th>
                    <th class="px-4 py-3 font-semibold">Type</th>
                    <th class="px-4 py-3 font-semibold">Price</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3 font-medium text-ink">
                            <span class="inline-flex flex-wrap items-center gap-2">
                                {{ Str::limit($property->title, 40) }}
                                @if($property->featured)
                                    <x-badge status="featured">Featured</x-badge>
                                @endif
                            </span>
                        </td>
                        <td class="px-4 py-3 text-ink-secondary">{{ ucfirst($property->type) }}</td>
                        <td class="px-4 py-3 text-ink-secondary">${{ number_format($property->price) }}</td>
                        <td class="px-4 py-3"><x-badge :status="$property->status" /></td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap items-center justify-end gap-2">
                                <x-button variant="secondary" href="{{ route('admin.properties.edit', $property) }}">Edit</x-button>
                                <x-confirm-delete
                                    :action="route('admin.properties.destroy', $property)"
                                    title="Delete property?"
                                    message="Delete “{{ $property->title }}”? This cannot be undone."
                                />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-ink-muted">No properties found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($properties->hasPages())
        <div class="border-t border-line p-4">{{ $properties->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
