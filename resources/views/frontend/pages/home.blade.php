@extends('layouts.app')

@section('title', 'FindState - Find Your Dream Property')
@section('meta_description', 'Browse homes for sale and rent with FindState. Search by location, type, and budget.')

@section('content')
{{-- Hero --}}
<section class="relative isolate overflow-hidden">
    <img
        src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=1920&q=80"
        alt="Modern home exterior"
        class="absolute inset-0 h-full w-full object-cover"
        width="1920"
        height="1080"
    >
    <div class="absolute inset-0 bg-ink/70"></div>
    <div class="container-page relative py-16 sm:py-24">
        <div class="max-w-2xl text-white">
            <h1 class="text-[30px] font-bold leading-tight sm:text-2xl">Find a home that fits your life</h1>
            <p class="mt-4 text-sm text-white/80 sm:text-base">Search verified listings for sale and rent across top cities — clean filters, trusted agents, zero clutter.</p>
        </div>

        <form action="{{ route('properties.index') }}" method="GET" class="mt-8 rounded-md bg-white p-4 shadow-lg sm:p-6">
            <div class="grid grid-cols-1 items-end gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <x-input label="Location" name="location" placeholder="City or area" :value="request('location')" />
                <x-select label="Property Type" name="type">
                    <option value="">Any type</option>
                    @foreach(\App\Models\Property::TYPES as $t)
                        <option value="{{ $t }}" @selected(request('type') === $t)>{{ ucfirst($t) }}</option>
                    @endforeach
                </x-select>
                <x-select label="Budget" name="max_price">
                    <option value="">Any budget</option>
                    <option value="100000">Up to $100K</option>
                    <option value="250000">Up to $250K</option>
                    <option value="500000">Up to $500K</option>
                    <option value="1000000">Up to $1M</option>
                    <option value="10000000">$1M+</option>
                </x-select>
                <div class="w-full">
                    <span class="mb-1 block h-4 text-xs font-semibold text-transparent select-none" aria-hidden="true">Search</span>
                    <x-button variant="primary" type="submit" block :height="48">Search</x-button>
                </div>
            </div>
        </form>
    </div>
</section>

{{-- Property types --}}
<section class="py-16">
    <div class="container-page">
        <x-section-heading title="Browse by property type" subtitle="Jump straight into the category you need." />
        <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7">
            @foreach(\App\Models\Property::TYPES as $type)
                <a href="{{ route('properties.index', ['type' => $type]) }}"
                   class="flex flex-col items-center justify-center gap-3 rounded-md border border-line bg-white p-6 text-center shadow-sm transition-ui hover:shadow-lg">
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-brand-light text-brand">
                        <i class="fas fa-home" aria-hidden="true"></i>
                    </span>
                    <span class="text-sm font-semibold text-ink">{{ ucfirst($type) }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Recent properties --}}
<section class="bg-white py-16">
    <div class="container-page">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <x-section-heading title="Latest properties" subtitle="Fresh listings added to the marketplace." />
            <x-button variant="ghost" href="{{ route('properties.index') }}">View all</x-button>
        </div>
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($recentProperties as $property)
                <x-property-card :property="$property" />
            @empty
                <p class="col-span-full text-sm text-ink-muted">No properties yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Agents --}}
<section class="py-16">
    <div class="container-page">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <x-section-heading title="Meet our agents" subtitle="Experienced professionals ready to help." />
            <x-button variant="ghost" href="{{ route('agents.index') }}">All agents</x-button>
        </div>
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($topAgents as $agent)
                <x-agent-card :agent="$agent" />
            @endforeach
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="bg-white py-16">
    <div class="container-page">
        <x-section-heading align="center" title="What clients say" subtitle="Real feedback from buyers and renters." class="mb-8" />
        <div class="flex gap-4 overflow-x-auto pb-2 lg:grid lg:grid-cols-3 lg:overflow-visible">
            @foreach($testimonials->take(3) as $testimonial)
                <div class="min-w-[280px] flex-1 lg:min-w-0">
                    <x-testimonial-card :testimonial="$testimonial" />
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Blog --}}
<section class="py-16">
    <div class="container-page">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <x-section-heading title="Market insights" subtitle="Guides and tips from the FindState blog." />
            <x-button variant="ghost" href="{{ route('blog.index') }}">All posts</x-button>
        </div>
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($latestBlogs as $blog)
                <x-blog-card :blog="$blog" />
            @endforeach
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="bg-white py-16">
    <div class="container-page max-w-3xl">
        <x-section-heading align="center" title="Frequently asked questions" />
        <div class="mt-6 space-y-3">
            <x-faq-item question="How do I schedule a property viewing?">
                Open any listing and use the inquiry form, or contact the listed agent directly. We typically confirm within one business day.
            </x-faq-item>
            <x-faq-item question="Are listing prices negotiable?">
                Many sellers consider offers. Your agent can advise on comparable sales and help you submit a competitive bid.
            </x-faq-item>
            <x-faq-item question="Can I save favorites without creating an account?">
                Yes. Use the heart icon on any property card — favorites are stored in your browser session.
            </x-faq-item>
            <x-faq-item question="How do I list my property?">
                Click “List Property” in the header and send us the details. An agent will follow up to verify and publish.
            </x-faq-item>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16">
    <div class="container-page">
        <div class="rounded-md bg-brand px-6 py-12 text-center text-white sm:px-12">
            <h2 class="text-xl font-bold sm:text-2xl">Ready to make your next move?</h2>
            <p class="mx-auto mt-3 max-w-xl text-sm text-white/80">Tell us what you need — buy, rent, or sell — and we’ll match you with the right agent.</p>
            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <x-button variant="secondary" href="{{ route('contact.index') }}">Contact us</x-button>
                <x-button variant="ghost" href="{{ route('properties.index') }}" class="!border-white/30 !text-white hover:!bg-white/10">Browse listings</x-button>
            </div>
        </div>
    </div>
</section>
@endsection
