@extends('layouts.app')

@section('title', 'About - FindState')
@section('meta_description', 'Learn about FindState and our mission to make home search simpler.')

@section('content')
<section class="border-b border-line bg-white py-12">
    <x-container>
        <div class="max-w-prose">
            <h1 class="text-xl font-bold text-ink sm:text-2xl">About FindState</h1>
            <p class="mt-4 text-sm leading-relaxed text-ink-secondary">We help people find places they love — with clear listings, trusted agents, and a calm browsing experience on every device.</p>
        </div>
    </x-container>
</section>

<section class="py-12">
    <x-container class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <div class="rounded-md border border-line bg-white p-6 shadow-sm">
            <h2 class="text-base font-semibold text-ink">Mission</h2>
            <p class="mt-3 text-sm text-ink-secondary">Make buying and renting transparent, fast, and mobile-friendly.</p>
        </div>
        <div class="rounded-md border border-line bg-white p-6 shadow-sm">
            <h2 class="text-base font-semibold text-ink">Values</h2>
            <p class="mt-3 text-sm text-ink-secondary">Clarity over clutter. Honest pricing. Local expertise.</p>
        </div>
        <div class="rounded-md border border-line bg-white p-6 shadow-sm">
            <h2 class="text-base font-semibold text-ink">Approach</h2>
            <p class="mt-3 text-sm text-ink-secondary">Human agents plus a modern product — never one without the other.</p>
        </div>
    </x-container>
</section>

@if(isset($agents) && $agents->count())
<section class="bg-white py-12">
    <x-container>
        <x-section-heading title="Our team" subtitle="Agents behind FindState." />
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($agents->take(4) as $agent)
                <x-agent-card :agent="$agent" />
            @endforeach
        </div>
    </x-container>
</section>
@endif

@if(isset($testimonials) && $testimonials->count())
<section class="py-12">
    <x-container>
        <x-section-heading align="center" title="Client stories" />
        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials->take(3) as $testimonial)
                <x-testimonial-card :testimonial="$testimonial" />
            @endforeach
        </div>
    </x-container>
</section>
@endif
@endsection
