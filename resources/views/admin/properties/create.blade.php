@extends('admin.layouts.app')

@section('title', 'Add Property')

@section('content')
<x-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Properties', 'url' => route('admin.properties.index')],
    ['label' => 'Add'],
]" />

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Add Property</h1>
    <x-button variant="ghost" href="{{ route('admin.properties.index') }}">Back to list</x-button>
</div>

<div class="rounded-md border border-line bg-white p-6 shadow-sm">
    <p class="mb-6 text-sm font-semibold text-ink-secondary">New Property</p>

    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-input label="Title" name="title" :value="old('title')" required class="md:col-span-2" />

            <x-select label="Agent" name="agent_id">
                <option value="">— None —</option>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}" @selected(old('agent_id') == $agent->id)>{{ $agent->name }}</option>
                @endforeach
            </x-select>

            <div class="w-full md:col-span-2">
                <label for="description" class="mb-1 block text-xs font-semibold text-ink">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full rounded-sm border border-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-muted transition-ui focus:border-brand focus:ring-2 focus:ring-brand/20 @error('description') border-danger @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <x-input label="Address" name="address" :value="old('address')" />
            <x-input label="City" name="city" :value="old('city')" />
            <x-input label="State" name="state" :value="old('state')" />
            <x-input label="ZIP" name="zip" :value="old('zip')" />

            <x-select label="Type" name="type" required>
                @foreach(\App\Models\Property::TYPES as $t)
                    <option value="{{ $t }}" @selected(old('type') === $t)>{{ ucfirst($t) }}</option>
                @endforeach
            </x-select>

            <x-select label="Listing type" name="listing_type" required>
                <option value="for_sale" @selected(old('listing_type') === 'for_sale')>For Sale</option>
                <option value="for_rent" @selected(old('listing_type') === 'for_rent')>For Rent</option>
            </x-select>

            <x-input label="Price" name="price" type="number" :value="old('price')" required min="0" step="0.01" />

            <x-input label="Bedrooms" name="bedrooms" type="number" :value="old('bedrooms')" min="0" />
            <x-input label="Bathrooms" name="bathrooms" type="number" :value="old('bathrooms')" min="0" />
            <x-input label="Area (sqft)" name="area" type="number" :value="old('area')" min="0" />
            <x-input label="Parking" name="parking" type="number" :value="old('parking')" min="0" />

            <div class="w-full">
                <label for="featured_image" class="mb-1 block text-xs font-semibold text-ink">Featured image</label>
                <input id="featured_image" type="file" name="featured_image" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="block w-full text-sm text-ink-secondary file:mr-4 file:inline-flex file:h-11 file:items-center file:rounded-sm file:border-0 file:bg-brand-light file:px-4 file:text-sm file:font-semibold file:text-brand @error('featured_image') border-danger @enderror">
                <p class="mt-1 text-xs text-ink-muted">JPEG, PNG, GIF, WebP. Max 2MB.</p>
                @error('featured_image')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <x-select label="Status" name="status">
                <option value="active" @selected(old('status', 'active') === 'active')>Active</option>
                <option value="sold" @selected(old('status') === 'sold')>Sold</option>
                <option value="pending" @selected(old('status') === 'pending')>Pending</option>
                <option value="inactive" @selected(old('status') === 'inactive')>Inactive</option>
            </x-select>

            <div class="flex items-end">
                <label class="inline-flex h-11 items-center gap-2">
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" name="featured" value="1" class="h-4 w-4 rounded-sm border-line text-brand focus:ring-brand/20" @checked(old('featured'))>
                    <span class="text-sm font-medium text-ink">Featured</span>
                </label>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-3 border-t border-line pt-6">
            <x-button type="submit">Create Property</x-button>
            <x-button variant="ghost" href="{{ route('admin.properties.index') }}">Back to list</x-button>
        </div>
    </form>
</div>
@endsection
