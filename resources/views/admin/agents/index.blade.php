@extends('admin.layouts.app')

@section('title', 'Agents')

@section('content')
@php use App\Support\Media; @endphp
<x-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Agents'],
]" />

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Agents</h1>
    <x-button variant="primary" href="{{ route('admin.agents.create') }}">Add Agent</x-button>
</div>

<form method="GET" class="mb-6 grid grid-cols-1 gap-3 rounded-md border border-line bg-white p-4 shadow-sm sm:grid-cols-3">
    <x-input name="search" label="Search" placeholder="Search by name or email..." :value="request('search')" />
    <x-select name="status" label="Status">
        <option value="">All statuses</option>
        <option value="active" @selected(request('status') === 'active')>Active</option>
        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
    </x-select>
    <div class="flex items-end">
        <x-button variant="ghost" type="submit" block>Filter</x-button>
    </div>
</form>

<div class="overflow-hidden rounded-md border border-line bg-white shadow-sm">
    <div class="overflow-x-auto xl:overflow-visible">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-canvas text-xs uppercase text-ink-muted">
                <tr>
                    <th class="px-4 py-3 font-semibold">Avatar</th>
                    <th class="px-4 py-3 font-semibold">Name</th>
                    <th class="px-4 py-3 font-semibold">Email</th>
                    <th class="px-4 py-3 font-semibold">Designation</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agents as $agent)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3">
                            @php $avatar = Media::url($agent->avatar); @endphp
                            @if($avatar)
                                <img src="{{ $avatar }}" alt="{{ $agent->name }}" class="h-10 w-10 rounded-full object-cover" loading="lazy" width="40" height="40">
                            @else
                                <span class="text-xs text-ink-muted">No photo</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-ink">{{ $agent->name }}</td>
                        <td class="px-4 py-3 text-ink-secondary">{{ $agent->email ?? '—' }}</td>
                        <td class="px-4 py-3 text-ink-secondary">{{ $agent->designation ?? '—' }}</td>
                        <td class="px-4 py-3"><x-badge :status="$agent->status" /></td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap items-center justify-end gap-2">
                                <x-button variant="secondary" href="{{ route('admin.agents.edit', $agent) }}">Edit</x-button>
                                <x-confirm-delete
                                    :action="route('admin.agents.destroy', $agent)"
                                    title="Delete agent?"
                                    message="Delete “{{ $agent->name }}”? This cannot be undone."
                                />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-ink-muted">No agents found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($agents->hasPages())
        <div class="border-t border-line p-4">{{ $agents->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
