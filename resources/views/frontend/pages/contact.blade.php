@extends('layouts.app')

@section('title', 'Contact - FindState')
@section('meta_description', 'Contact FindState for listings, viewings, and agent support.')

@section('content')
<section class="border-b border-line bg-white py-12">
    <div class="container-page max-w-3xl">
        <h1 class="text-xl font-bold text-ink sm:text-2xl">Contact</h1>
        <p class="mt-4 text-sm text-ink-secondary">Send a message and our team will get back to you shortly.</p>
    </div>
</section>

<section class="py-10">
    <div class="container-page max-w-2xl">
        @if(session('success'))
            <div class="mb-6 rounded-sm border border-brand/20 bg-brand-light px-4 py-3 text-sm text-brand">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-6 rounded-sm border border-danger/20 bg-danger/10 px-4 py-3 text-sm text-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="space-y-4 rounded-md border border-line bg-white p-6 shadow-sm">
            @csrf
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <x-input label="Name" name="name" required />
                <x-input label="Email" name="email" type="email" required />
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <x-input label="Phone" name="phone" type="tel" />
                <x-input label="Subject" name="subject" required :value="request('subject')" />
            </div>
            <div>
                <label for="message" class="mb-1 block text-xs font-semibold text-ink">Message <span class="text-danger">*</span></label>
                <textarea id="message" name="message" required rows="5" class="w-full rounded-sm border border-line px-4 py-3 text-sm focus:border-brand focus:ring-2 focus:ring-brand/20">{{ old('message') }}</textarea>
                @error('message')<p class="mt-1 text-xs text-danger">{{ $message }}</p>@enderror
            </div>
            <x-button variant="primary" type="submit">Send message</x-button>
        </form>
    </div>
</section>
@endsection
