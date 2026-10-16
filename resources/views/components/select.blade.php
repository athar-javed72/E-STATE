@props([
    'label' => null,
    'name',
    'required' => false,
])

<div {{ $attributes->only('class')->merge(['class' => 'w-full']) }}>
    @if($label)
        <label for="{{ $name }}" class="mb-1 block text-left text-xs font-semibold text-ink">{{ $label }}@if($required) <span class="text-danger">*</span>@endif</label>
    @endif
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @if($required) required @endif
        {{ $attributes->except('class')->merge([
            'class' => 'h-12 w-full rounded-sm border border-line bg-white px-4 text-sm text-ink transition-ui focus:border-brand focus:ring-2 focus:ring-brand/20 ' . ($errors->has($name) ? 'border-danger' : ''),
        ]) }}
    >
        {{ $slot }}
    </select>
    @error($name)
        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
    @enderror
</div>
