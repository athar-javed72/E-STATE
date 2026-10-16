@extends('layouts.app')

@section('title', 'Agents - FindState')
@section('meta_description', 'Meet FindState real estate agents.')

@section('content')
<section class="border-b border-line bg-white py-8">
    <div class="container-page">
        <h1 class="text-xl font-bold text-ink sm:text-2xl">Our agents</h1>
        <p class="mt-2 text-sm text-ink-secondary">Professionals ready to guide your next move.</p>
    </div>
</section>
<section class="py-10">
    <div class="container-page">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($agents as $agent)
                <x-agent-card :agent="$agent" />
            @empty
                <p class="col-span-full text-sm text-ink-muted">No agents found.</p>
            @endforelse
        </div>
        <div class="mt-8">{{ $agents->links('vendor.pagination.tailwind') }}</div>
    </div>
</section>
@endsection
