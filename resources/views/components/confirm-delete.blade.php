@props([
    'action',
    'title' => 'Delete item?',
    'message' => 'This action cannot be undone.',
    'confirmLabel' => 'Delete',
])

@php
    $modalId = 'confirm-delete-' . str_replace('.', '', uniqid('', true));
@endphp

<div class="inline-flex" data-confirm-delete>
    <x-button
        type="button"
        variant="danger"
        data-confirm-open="{{ $modalId }}"
        {{ $attributes->except(['action', 'title', 'message', 'confirmLabel']) }}
    >
        {{ $slot->isEmpty() ? 'Delete' : $slot }}
    </x-button>

    <div
        id="{{ $modalId }}"
        class="fixed inset-0 z-[60] hidden items-center justify-center p-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="{{ $modalId }}-title"
        data-confirm-modal
    >
        <div class="absolute inset-0 bg-ink/40" data-confirm-backdrop tabindex="-1"></div>
        <div class="relative z-10 w-full max-w-md rounded-md border border-line bg-white p-6 shadow-lg" data-confirm-panel>
            <h2 id="{{ $modalId }}-title" class="text-base font-semibold text-ink">{{ $title }}</h2>
            <p class="mt-2 text-sm text-ink-secondary">{{ $message }}</p>
            <form action="{{ $action }}" method="POST" class="mt-6 flex flex-wrap justify-end gap-3">
                @csrf
                @method('DELETE')
                <x-button type="button" variant="ghost" data-confirm-close>Cancel</x-button>
                <x-button type="submit" variant="danger">{{ $confirmLabel }}</x-button>
            </form>
        </div>
    </div>
</div>
