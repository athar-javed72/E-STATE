@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<x-breadcrumbs :items="[
    ['label' => 'Dashboard'],
]" />

<h1 class="mb-6 text-xl font-bold text-ink">Dashboard</h1>

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    @foreach([
        ['Active properties', $stats['properties_active'], 'fa-home'],
        ['Agents', $stats['agents_total'], 'fa-users'],
        ['Published blogs', $stats['blogs_published'], 'fa-newspaper'],
        ['New contacts', $stats['contacts_new'], 'fa-envelope'],
    ] as [$label, $value, $icon])
        <div class="rounded-md border border-line bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wide text-ink-muted">{{ $label }}</p>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-brand-light text-brand"><i class="fas {{ $icon }}" aria-hidden="true"></i></span>
            </div>
            <p class="mt-3 text-xl font-bold text-ink">{{ number_format($value) }}</p>
        </div>
    @endforeach
</div>

<div class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-2">
    <div class="overflow-hidden rounded-md border border-line bg-white shadow-sm">
        <div class="border-b border-line px-5 py-4">
            <h2 class="text-base font-semibold text-ink">Recent properties</h2>
        </div>
        <div class="overflow-x-auto xl:overflow-visible">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-canvas text-xs uppercase text-ink-muted">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Title</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentProperties as $property)
                        <tr class="border-t border-line">
                            <td class="px-5 py-3 font-medium text-ink">
                                {{ Str::limit($property->title, 40) }}
                                @if($property->featured)
                                    <x-badge status="featured" class="ml-2">Featured</x-badge>
                                @endif
                            </td>
                            <td class="px-5 py-3"><x-badge :status="$property->status" /></td>
                            <td class="px-5 py-3 text-ink-secondary">${{ number_format($property->price) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-5 py-6 text-center text-ink-muted">No properties yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="overflow-hidden rounded-md border border-line bg-white shadow-sm">
        <div class="border-b border-line px-5 py-4">
            <h2 class="text-base font-semibold text-ink">Recent contacts</h2>
        </div>
        <div class="overflow-x-auto xl:overflow-visible">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-canvas text-xs uppercase text-ink-muted">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Name</th>
                        <th class="px-5 py-3 font-semibold">Subject</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentContacts as $contact)
                        <tr class="border-t border-line">
                            <td class="px-5 py-3 font-medium text-ink">{{ $contact->name }}</td>
                            <td class="px-5 py-3 text-ink-secondary">{{ Str::limit($contact->subject, 30) }}</td>
                            <td class="px-5 py-3"><x-badge :status="$contact->status" /></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-5 py-6 text-center text-ink-muted">No contacts yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
