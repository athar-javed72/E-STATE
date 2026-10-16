@extends('admin.layouts.app')

@section('title', 'Contact details')

@section('content')
<x-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Contacts', 'url' => route('admin.contacts.index')],
    ['label' => 'View'],
]" />

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Contact message</h1>
    <x-button variant="ghost" href="{{ route('admin.contacts.index') }}">Back to list</x-button>
</div>

<div class="w-full max-w-5xl space-y-6">
    <div class="rounded-md border border-line bg-white p-6 shadow-sm">
        <div class="flex flex-wrap items-center gap-3">
            <x-badge :status="$contact->status" />
            <x-badge :tone="$contact->type === 'property_inquiry' ? 'brand' : 'muted'">
                {{ $contact->type === 'property_inquiry' ? 'Property inquiry' : 'General' }}
            </x-badge>
            <p class="text-xs text-ink-muted">{{ $contact->created_at->format('M j, Y \a\t H:i') }}</p>
        </div>

        <dl class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-ink-muted">Name</dt>
                <dd class="mt-1 text-sm font-medium text-ink">{{ $contact->name }}</dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-ink-muted">Email</dt>
                <dd class="mt-1 text-sm text-ink">
                    <a href="mailto:{{ $contact->email }}" class="text-brand hover:underline">{{ $contact->email }}</a>
                </dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-ink-muted">Phone</dt>
                <dd class="mt-1 text-sm text-ink">
                    @if($contact->phone)
                        <a href="tel:{{ $contact->phone }}" class="text-brand hover:underline">{{ $contact->phone }}</a>
                    @else
                        <span class="text-ink-muted">—</span>
                    @endif
                </dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-ink-muted">Subject</dt>
                <dd class="mt-1 text-sm font-medium text-ink">{{ $contact->subject }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-xs font-semibold uppercase tracking-wide text-ink-muted">Linked property</dt>
                <dd class="mt-1 text-sm text-ink">
                    @if($contact->property)
                        <a href="{{ route('properties.show', $contact->property->slug) }}" class="font-semibold text-brand hover:underline" target="_blank" rel="noopener">
                            {{ $contact->property->title }}
                        </a>
                    @else
                        <span class="text-ink-muted">None</span>
                    @endif
                </dd>
            </div>
        </dl>

        <div class="mt-6 border-t border-line pt-6">
            <h2 class="text-base font-semibold text-ink">Message</h2>
            <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-ink-secondary">{{ $contact->message }}</p>
        </div>
    </div>

    <div class="rounded-md border border-line bg-white p-6 shadow-sm">
        <h2 class="text-base font-semibold text-ink">Update status</h2>
        <div class="mt-4 flex flex-wrap items-center gap-3">
            <form action="{{ route('admin.contacts.update-status', $contact) }}" method="POST" class="flex flex-wrap items-center gap-2">
                @csrf
                @method('PATCH')
                <label class="sr-only" for="show-status">Status</label>
                <select
                    id="show-status"
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
    </div>
</div>
@endsection
