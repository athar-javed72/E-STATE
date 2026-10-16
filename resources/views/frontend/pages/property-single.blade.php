@extends('layouts.app')

@section('title', $property->title . ' - FindState')
@section('meta_description', Str::limit(strip_tags($property->description), 160))

@php
    use App\Support\Media;
    $imageUrl = Media::url($property->featured_image);
    $isRent = $property->listing_type === 'for_rent';
@endphp

@section('content')
<section class="border-b border-line bg-white py-4">
    <div class="container-page text-sm text-ink-muted">
        <a href="{{ route('home') }}" class="hover:text-ink">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('properties.index') }}" class="hover:text-ink">Properties</a>
        <span class="mx-2">/</span>
        <span class="text-ink">{{ Str::limit($property->title, 40) }}</span>
    </div>
</section>

<section class="py-8">
    <div class="container-page">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
            <div class="lg:col-span-8">
                <div class="overflow-hidden rounded-md bg-canvas shadow-sm">
                    @if($imageUrl)
                        <img src="{{ $imageUrl }}" alt="{{ $property->title }}" class="aspect-4-3 w-full object-cover" width="1200" height="900">
                    @else
                        <div class="flex aspect-4-3 items-center justify-center bg-slate-200 text-ink-muted">
                            <i class="fas fa-home text-4xl" aria-hidden="true"></i>
                        </div>
                    @endif
                </div>

                <div class="mt-6">
                    <div class="flex flex-wrap items-center gap-2">
                        <x-badge :tone="$isRent ? 'accent' : 'brand'">{{ $isRent ? 'For Rent' : 'For Sale' }}</x-badge>
                        <x-badge tone="muted">{{ ucfirst($property->type) }}</x-badge>
                    </div>
                    <h1 class="mt-3 text-xl font-bold text-ink sm:text-2xl">{{ $property->title }}</h1>
                    <p class="mt-2 text-sm text-ink-muted"><i class="fas fa-map-marker-alt text-brand" aria-hidden="true"></i> {{ $property->address }}, {{ $property->city }}, {{ $property->state }}</p>
                    <p class="mt-4 text-lg font-bold text-ink">${{ number_format($property->price) }}@if($isRent)<span class="text-sm font-medium text-ink-muted">/month</span>@endif</p>

                    <div class="mt-6 grid grid-cols-2 gap-4 rounded-md border border-line bg-white p-4 sm:grid-cols-4">
                        @if($property->bedrooms)<div><p class="text-xs text-ink-muted">Beds</p><p class="text-sm font-semibold text-ink">{{ $property->bedrooms }}</p></div>@endif
                        @if($property->bathrooms)<div><p class="text-xs text-ink-muted">Baths</p><p class="text-sm font-semibold text-ink">{{ $property->bathrooms }}</p></div>@endif
                        @if($property->area)<div><p class="text-xs text-ink-muted">Area</p><p class="text-sm font-semibold text-ink">{{ number_format($property->area) }} sqft</p></div>@endif
                        @if($property->parking)<div><p class="text-xs text-ink-muted">Parking</p><p class="text-sm font-semibold text-ink">{{ $property->parking }}</p></div>@endif
                    </div>

                    <div class="prose-none mt-8">
                        <h2 class="text-lg font-semibold text-ink">About this property</h2>
                        <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-ink-secondary">{{ $property->description }}</p>
                    </div>
                </div>
            </div>

            <aside class="lg:col-span-4">
                <div class="space-y-4 lg:sticky lg:top-24">
                    @if($property->agent)
                        <div class="rounded-md border border-line bg-white p-5 shadow-sm">
                            <h2 class="text-base font-semibold text-ink">Listing agent</h2>
                            <div class="mt-4 flex items-center gap-3">
                                @php $avatar = Media::url($property->agent->avatar); @endphp
                                <div class="h-14 w-14 overflow-hidden rounded-full bg-canvas">
                                    @if($avatar)
                                        <img src="{{ $avatar }}" alt="{{ $property->agent->name }}" class="h-full w-full object-cover" loading="lazy" width="56" height="56">
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-ink">{{ $property->agent->name }}</p>
                                    <p class="text-xs text-ink-muted">{{ $property->agent->designation }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-button variant="ghost" href="{{ route('agents.show', $property->agent->slug) }}" block>View profile</x-button>
                            </div>
                        </div>
                    @endif

                    <div class="rounded-md border border-line bg-white p-5 shadow-sm">
                        <h2 class="text-base font-semibold text-ink">Send an inquiry</h2>
                        <form action="{{ route('api.property.contact', $property) }}" method="POST" class="mt-4 space-y-3" id="inquiry-form">
                            @csrf
                            <x-input label="Name" name="name" required />
                            <x-input label="Email" name="email" type="email" required />
                            <x-input label="Phone" name="phone" type="tel" />
                            <div>
                                <label for="message" class="mb-1 block text-xs font-semibold text-ink">Message <span class="text-danger">*</span></label>
                                <textarea id="message" name="message" required rows="4" class="w-full rounded-sm border border-line px-4 py-3 text-sm text-ink focus:border-brand focus:ring-2 focus:ring-brand/20" placeholder="I'm interested in this property..."></textarea>
                            </div>
                            <x-button variant="primary" type="submit" block>Send inquiry</x-button>
                        </form>
                    </div>
                </div>
            </aside>
        </div>

        @if($relatedProperties->count())
            <div class="mt-16">
                <h2 class="text-xl font-bold text-ink">Related properties</h2>
                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($relatedProperties as $related)
                        <x-property-card :property="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('inquiry-form')?.addEventListener('submit', function (e) {
    e.preventDefault();
    var form = e.target;
    var data = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: data,
        credentials: 'same-origin'
    }).then(function (r) { return r.json().then(function (j) { return { ok: r.ok, j: j }; }); })
      .then(function (res) {
          alert(res.j.message || (res.ok ? 'Sent!' : 'Please check your details.'));
          if (res.ok) form.reset();
      }).catch(function () { alert('Something went wrong.'); });
});
</script>
@endpush
