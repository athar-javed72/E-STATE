@extends('layouts.app')

@section('title', 'Services - FindState')
@section('meta_description', 'Buying, selling, renting, and property management services from FindState.')

@section('content')
<section class="border-b border-line bg-white py-12">
    <div class="container-page max-w-3xl">
        <h1 class="text-xl font-bold text-ink sm:text-2xl">Services</h1>
        <p class="mt-4 text-sm text-ink-secondary">End-to-end support whether you are buying, selling, or renting.</p>
    </div>
</section>

<section class="py-12">
    <div class="container-page grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach([
            ['Buying', 'Search, tour, negotiate, and close with a dedicated agent.'],
            ['Selling', 'Pricing strategy, listing prep, and qualified buyer outreach.'],
            ['Renting', 'Find apartments and homes that match your budget and lifestyle.'],
            ['Property management', 'Tenant screening, maintenance coordination, and reporting.'],
            ['Investment consulting', 'Analyze returns and market timing for your portfolio.'],
            ['Relocation support', 'Settle faster with neighborhood guidance and shortlists.'],
        ] as [$title, $copy])
            <div class="rounded-md border border-line bg-white p-6 shadow-sm">
                <h2 class="text-base font-semibold text-ink">{{ $title }}</h2>
                <p class="mt-3 text-sm text-ink-secondary">{{ $copy }}</p>
            </div>
        @endforeach
    </div>
    <div class="container-page mt-12 text-center">
        <x-button variant="primary" href="{{ route('contact.index') }}">Talk to us</x-button>
    </div>
</section>
@endsection
