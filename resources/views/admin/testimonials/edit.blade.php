@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Edit Testimonial</h1>
    <x-button variant="ghost" href="{{ route('admin.testimonials.index') }}">Back to list</x-button>
</div>

<div class="rounded-md border border-line bg-white p-6 shadow-sm">
    <p class="mb-6 text-sm font-semibold text-ink-secondary">Edit: {{ $testimonial->name }}</p>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-input label="Name" name="name" :value="old('name', $testimonial->name)" required />
            <x-input label="Designation" name="designation" :value="old('designation', $testimonial->designation)" />
            <x-input label="Location" name="location" :value="old('location', $testimonial->location)" />

            <x-select label="Rating" name="rating">
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" @selected((int) old('rating', $testimonial->rating) === $i)>{{ $i }}</option>
                @endfor
            </x-select>

            <x-select label="Status" name="status">
                <option value="active" @selected(old('status', $testimonial->status) === 'active')>Active</option>
                <option value="inactive" @selected(old('status', $testimonial->status) === 'inactive')>Inactive</option>
            </x-select>

            <div class="w-full md:col-span-2">
                <label for="content" class="mb-1 block text-xs font-semibold text-ink">Content <span class="text-danger">*</span></label>
                <textarea id="content" name="content" rows="4" required class="w-full rounded-sm border border-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-muted transition-ui focus:border-brand focus:ring-2 focus:ring-brand/20 @error('content') border-danger @enderror">{{ old('content', $testimonial->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full">
                <label for="image" class="mb-1 block text-xs font-semibold text-ink">Image</label>
                @if($testimonial->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="" class="max-h-20 rounded-sm object-cover">
                    </div>
                @endif
                <input id="image" type="file" name="image" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="block w-full text-sm text-ink-secondary file:mr-4 file:inline-flex file:h-11 file:items-center file:rounded-sm file:border-0 file:bg-brand-light file:px-4 file:text-sm file:font-semibold file:text-brand @error('image') border-danger @enderror">
                <p class="mt-1 text-xs text-ink-muted">Leave empty to keep current image.</p>
                @error('image')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-3 border-t border-line pt-6">
            <x-button type="submit">Update Testimonial</x-button>
            <x-button variant="ghost" href="{{ route('admin.testimonials.index') }}">Back to list</x-button>
        </div>
    </form>
</div>
@endsection
