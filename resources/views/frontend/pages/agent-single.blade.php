@extends('layouts.app')

@section('title', $agent->name . ' - FindState')
@section('meta_description', Str::limit(strip_tags($agent->bio), 160))

@php
    use App\Support\Media;
    $avatar = Media::url($agent->avatar);
@endphp

@section('content')
<section class="border-b border-line bg-white py-10">
    <x-container class="flex flex-col items-start gap-6 sm:flex-row sm:items-center">
        <div class="h-24 w-24 overflow-hidden rounded-full bg-canvas">
            @if($avatar)
                <img src="{{ $avatar }}" alt="{{ $agent->name }}" class="h-full w-full object-cover" width="96" height="96">
            @endif
        </div>
        <div>
            <h1 class="text-xl font-bold text-ink sm:text-2xl">{{ $agent->name }}</h1>
            <p class="mt-1 text-sm text-ink-secondary">{{ $agent->designation ?? 'Real Estate Agent' }}</p>
            @if($agent->email || $agent->phone)
                <p class="mt-2 text-sm text-ink-muted">
                    @if($agent->email)<span class="mr-4">{{ $agent->email }}</span>@endif
                    @if($agent->phone)<span>{{ $agent->phone }}</span>@endif
                </p>
            @endif
        </div>
    </x-container>
</section>

<section class="py-10">
    <x-container>
        @if($agent->bio)
            <h2 class="text-lg font-semibold text-ink">About</h2>
            <p class="mt-3 max-w-3xl text-sm leading-relaxed text-ink-secondary">{{ $agent->bio }}</p>
        @endif

        <h2 class="mt-12 text-lg font-semibold text-ink">Active listings</h2>
        <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4">
            @forelse($agent->properties as $property)
                <x-property-card :property="$property" />
            @empty
                <p class="col-span-full text-sm text-ink-muted">No active listings.</p>
            @endforelse
        </div>
    </x-container>
</section>
@endsection
