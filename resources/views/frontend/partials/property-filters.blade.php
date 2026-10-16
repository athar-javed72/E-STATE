@php $idPrefix = $idPrefix ?? 'f'; @endphp
<form method="GET" action="{{ route('properties.index') }}" class="space-y-4 rounded-md border border-line bg-white p-4 shadow-sm">
    <x-input :label="'Search'" :name="'search'" :value="request('search')" placeholder="Title or address" />
    <x-select label="Type" name="type">
        <option value="">All types</option>
        @foreach($propertyTypes as $t)
            <option value="{{ $t }}" @selected(request('type') == $t)>{{ ucfirst($t) }}</option>
        @endforeach
    </x-select>
    <x-select label="Listing" name="listing_type">
        <option value="">Sale & Rent</option>
        <option value="for_sale" @selected(request('listing_type') === 'for_sale')>For Sale</option>
        <option value="for_rent" @selected(request('listing_type') === 'for_rent')>For Rent</option>
    </x-select>
    <x-input label="Min price" name="min_price" type="number" :value="request('min_price')" placeholder="0" />
    <x-input label="Max price" name="max_price" type="number" :value="request('max_price')" :placeholder="$maxPrice ? (string) $maxPrice : ''" />
    <x-input label="Bedrooms (min)" name="bedrooms" type="number" :value="request('bedrooms')" placeholder="Any" />
    <x-select label="City" name="location">
        <option value="">All cities</option>
        @foreach($cities as $city)
            <option value="{{ $city }}" @selected(request('location') == $city)>{{ $city }}</option>
        @endforeach
    </x-select>
    <input type="hidden" name="sort" value="{{ request('sort', 'latest') }}">
    <x-button variant="primary" type="submit" block>Apply filters</x-button>
    <a href="{{ route('properties.index') }}" class="inline-flex h-11 w-full items-center justify-center text-sm font-semibold text-ink-secondary">Clear</a>
</form>
