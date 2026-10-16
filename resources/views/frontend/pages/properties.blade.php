@extends('layouts.app')

@section('title', 'Properties - FindState')
@section('meta_description', 'Browse properties for sale and rent. Filter by type, price, and location.')

@section('content')
<section class="border-b border-line bg-white py-8">
    <div class="container-page">
        <h1 class="text-xl font-bold text-ink sm:text-2xl">Properties</h1>
        <p class="mt-2 text-sm text-ink-secondary">{{ $properties->total() }} listings match your search.</p>
    </div>
</section>

<section class="py-8">
    <div class="container-page">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3 lg:hidden">
            <button type="button" id="filter-open" class="inline-flex h-11 items-center gap-2 rounded-sm border border-line bg-white px-4 text-sm font-semibold text-ink">
                <i class="fas fa-sliders-h" aria-hidden="true"></i> Filters
            </button>
            <form method="GET" class="flex items-center gap-2">
                @foreach(request()->except('sort', 'page') as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
                <label class="sr-only" for="sort-mobile">Sort</label>
                <select id="sort-mobile" name="sort" onchange="this.form.submit()" class="h-11 rounded-sm border border-line bg-white px-3 text-sm">
                    <option value="latest" @selected(request('sort', 'latest') === 'latest')>Latest</option>
                    <option value="price_low" @selected(request('sort') === 'price_low')>Price: Low to High</option>
                    <option value="price_high" @selected(request('sort') === 'price_high')>Price: High to Low</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
            <aside class="hidden lg:col-span-3 lg:block">
                @include('frontend.partials.property-filters', ['idPrefix' => 'desk'])
            </aside>

            <div class="lg:col-span-9">
                <div class="mb-6 hidden items-center justify-between lg:flex">
                    <p class="text-sm text-ink-secondary">Showing {{ $properties->firstItem() ?? 0 }}–{{ $properties->lastItem() ?? 0 }} of {{ $properties->total() }}</p>
                    <form method="GET" class="flex items-center gap-2">
                        @foreach(request()->except('sort', 'page') as $key => $value)
                            @if(!is_array($value))
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <label for="sort-desk" class="text-xs font-semibold text-ink">Sort</label>
                        <select id="sort-desk" name="sort" onchange="this.form.submit()" class="h-11 rounded-sm border border-line bg-white px-3 text-sm">
                            <option value="latest" @selected(request('sort', 'latest') === 'latest')>Latest</option>
                            <option value="price_low" @selected(request('sort') === 'price_low')>Price: Low to High</option>
                            <option value="price_high" @selected(request('sort') === 'price_high')>Price: High to Low</option>
                            <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                        </select>
                    </form>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse($properties as $property)
                        <x-property-card :property="$property" />
                    @empty
                        <p class="col-span-full rounded-md border border-line bg-white p-8 text-center text-sm text-ink-muted">No properties found. Try adjusting filters.</p>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $properties->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mobile filter drawer --}}
<div id="filter-backdrop" class="fixed inset-0 z-40 hidden bg-ink/40 lg:hidden"></div>
<div id="filter-drawer" class="fixed inset-x-0 bottom-0 z-50 hidden max-h-[85vh] overflow-y-auto rounded-t-md bg-white p-4 shadow-lg lg:hidden">
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-base font-semibold text-ink">Filters</h2>
        <button type="button" id="filter-close" class="inline-flex h-11 w-11 items-center justify-center rounded-sm border border-line" aria-label="Close filters">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @include('frontend.partials.property-filters', ['idPrefix' => 'mob'])
</div>
@endsection

@push('scripts')
<script>
(function () {
    var open = document.getElementById('filter-open');
    var close = document.getElementById('filter-close');
    var drawer = document.getElementById('filter-drawer');
    var backdrop = document.getElementById('filter-backdrop');
    function setOpen(v) {
        if (!drawer || !backdrop) return;
        drawer.classList.toggle('hidden', !v);
        backdrop.classList.toggle('hidden', !v);
        document.body.classList.toggle('overflow-hidden', v);
    }
    if (open) open.addEventListener('click', function () { setOpen(true); });
    if (close) close.addEventListener('click', function () { setOpen(false); });
    if (backdrop) backdrop.addEventListener('click', function () { setOpen(false); });
})();
</script>
@endpush
