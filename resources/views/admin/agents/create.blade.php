@extends('admin.layouts.app')

@section('title', 'Add Agent')

@section('content')
<x-breadcrumbs :items="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Agents', 'url' => route('admin.agents.index')],
    ['label' => 'Add'],
]" />

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-xl font-bold text-ink">Add Agent</h1>
    <x-button variant="ghost" href="{{ route('admin.agents.index') }}">Back to list</x-button>
</div>

<div class="w-full max-w-5xl rounded-md border border-line bg-white p-6 shadow-sm">
    <p class="mb-6 text-sm font-semibold text-ink-secondary">New Agent</p>

    <form action="{{ route('admin.agents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-input label="Name" name="name" :value="old('name')" required />
            <x-input label="Email" name="email" type="email" :value="old('email')" />
            <x-input label="Phone" name="phone" :value="old('phone')" />
            <x-input label="Designation" name="designation" :value="old('designation')" />

            <div class="w-full md:col-span-2">
                <label for="bio" class="mb-1 block text-xs font-semibold text-ink">Bio</label>
                <textarea id="bio" name="bio" rows="3" class="w-full rounded-sm border border-line bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-muted transition-ui focus:border-brand focus:ring-2 focus:ring-brand/20 @error('bio') border-danger @enderror">{{ old('bio') }}</textarea>
                @error('bio')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full">
                <label for="avatar" class="mb-1 block text-xs font-semibold text-ink">Avatar</label>
                <input id="avatar" type="file" name="avatar" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="block w-full text-sm text-ink-secondary file:mr-4 file:inline-flex file:h-11 file:items-center file:rounded-sm file:border-0 file:bg-brand-light file:px-4 file:text-sm file:font-semibold file:text-brand @error('avatar') border-danger @enderror">
                <p class="mt-1 text-xs text-ink-muted">JPEG, PNG, GIF, WebP. Max 2MB.</p>
                @error('avatar')
                    <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                @enderror
            </div>

            <x-input label="Experience (years)" name="experience" type="number" :value="old('experience', 0)" min="0" max="50" />
            <x-input label="Rating (0–5)" name="rating" type="number" :value="old('rating')" min="0" max="5" step="0.01" />

            <x-input label="Facebook URL" name="facebook" :value="old('facebook')" />
            <x-input label="Twitter URL" name="twitter" :value="old('twitter')" />
            <x-input label="LinkedIn" name="linkedin" :value="old('linkedin')" />
            <x-input label="Instagram" name="instagram" :value="old('instagram')" />

            <x-select label="Status" name="status">
                <option value="active" @selected(old('status', 'active') === 'active')>Active</option>
                <option value="inactive" @selected(old('status') === 'inactive')>Inactive</option>
            </x-select>

            <div class="flex items-end">
                <label class="inline-flex h-11 items-center gap-2">
                    <input type="hidden" name="is_online" value="0">
                    <input type="checkbox" name="is_online" value="1" class="h-4 w-4 rounded-sm border-line text-brand focus:ring-brand/20" @checked(old('is_online'))>
                    <span class="text-sm font-medium text-ink">Online</span>
                </label>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-3 border-t border-line pt-6">
            <x-button type="submit">Create Agent</x-button>
            <x-button variant="ghost" href="{{ route('admin.agents.index') }}">Back to list</x-button>
        </div>
    </form>
</div>
@endsection
