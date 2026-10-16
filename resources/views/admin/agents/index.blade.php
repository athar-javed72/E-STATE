@extends('admin.layouts.app')

@section('title', 'Agents')

@section('content')
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
    <x-button variant="ghost" type="submit" block>Filter</x-button>
</form>

<div class="overflow-hidden rounded-md border border-line bg-white shadow-sm">
    <div class="overflow-x-auto">
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
                            @if($agent->avatar)
                                <img src="{{ asset('storage/' . $agent->avatar) }}" alt="" class="h-10 w-10 rounded-full object-cover">
                            @else
                                <span class="text-xs text-ink-muted">No photo</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-ink">{{ $agent->name }}</td>
                        <td class="px-4 py-3 text-ink-secondary">{{ $agent->email ?? '—' }}</td>
                        <td class="px-4 py-3 text-ink-secondary">{{ $agent->designation ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <x-badge :tone="$agent->status === 'active' ? 'brand' : 'muted'">{{ ucfirst($agent->status) }}</x-badge>
                        </td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.agents.edit', $agent) }}" class="mr-2 text-sm font-semibold text-brand">Edit</a>
                            <form action="{{ route('admin.agents.destroy', $agent) }}" method="POST" class="inline" onsubmit="return confirm('Delete this agent?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-semibold text-danger">Delete</button>
                            </form>
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
