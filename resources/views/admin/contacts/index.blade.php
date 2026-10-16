@extends('admin.layouts.app')

@section('title', 'Contacts')

@section('content')
<x-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Contacts'],
]" />

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Contacts</h1>
</div>

<form method="GET" class="mb-6 grid grid-cols-1 gap-3 rounded-md border border-line bg-white p-4 shadow-sm sm:grid-cols-2 lg:grid-cols-4">
    <x-input name="search" label="Search" placeholder="Name, email, or subject..." :value="request('search')" />
    <x-select name="status" label="Status">
        <option value="">All statuses</option>
        <option value="new" @selected(request('status') === 'new')>New</option>
        <option value="read" @selected(request('status') === 'read')>Read</option>
        <option value="replied" @selected(request('status') === 'replied')>Replied</option>
    </x-select>
    <x-select name="type" label="Type">
        <option value="">All types</option>
        <option value="general" @selected(request('type') === 'general')>General</option>
        <option value="property_inquiry" @selected(request('type') === 'property_inquiry')>Property Inquiry</option>
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
                    <th class="px-4 py-3 font-semibold">Name</th>
                    <th class="px-4 py-3 font-semibold">Email</th>
                    <th class="px-4 py-3 font-semibold">Subject</th>
                    <th class="px-4 py-3 font-semibold">Type</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Date</th>
                    <th class="px-4 py-3 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3 font-medium text-ink">{{ $contact->name }}</td>
                        <td class="px-4 py-3 text-ink-secondary">{{ $contact->email }}</td>
                        <td class="px-4 py-3 text-ink-secondary">{{ Str::limit($contact->subject, 40) }}</td>
                        <td class="px-4 py-3">
                            <x-badge :tone="$contact->type === 'property_inquiry' ? 'brand' : 'muted'">
                                {{ $contact->type === 'property_inquiry' ? 'Property' : 'General' }}
                            </x-badge>
                        </td>
                        <td class="px-4 py-3">
                            <x-badge :status="$contact->status" />
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-ink-secondary">{{ $contact->created_at->format('M j, Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap items-center justify-end gap-2">
                                <x-button variant="ghost" href="{{ route('admin.contacts.show', $contact) }}">View</x-button>

                                <form action="{{ route('admin.contacts.update-status', $contact) }}" method="POST" class="flex flex-wrap items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <label class="sr-only" for="status-{{ $contact->id }}">Update status for {{ $contact->name }}</label>
                                    <select
                                        id="status-{{ $contact->id }}"
                                        name="status"
                                        class="h-11 rounded-sm border border-line bg-white px-3 text-sm text-ink focus:border-brand focus:ring-2 focus:ring-brand/20"
                                    >
                                        <option value="new" @selected($contact->status === 'new')>New</option>
                                        <option value="read" @selected($contact->status === 'read')>Read</option>
                                        <option value="replied" @selected($contact->status === 'replied')>Replied</option>
                                    </select>
                                    <x-button type="submit" variant="ghost">Update</x-button>
                                </form>

                                @if($contact->status !== 'read')
                                    <form action="{{ route('admin.contacts.update-status', $contact) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="read">
                                        <x-button type="submit" variant="ghost">Mark as read</x-button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @if($contact->message)
                        <tr class="border-t border-line bg-canvas/50">
                            <td colspan="7" class="px-4 py-2 text-xs text-ink-muted">{{ Str::limit($contact->message, 120) }}</td>
                        </tr>
                    @endif
                @empty
                    <tr><td colspan="7" class="px-4 py-8 text-center text-ink-muted">No contacts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($contacts->hasPages())
        <div class="border-t border-line p-4">{{ $contacts->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
