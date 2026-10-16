@props([
    'label' => null,
    'name',
    'type' => 'text',
    'value' => null,
    'required' => false,
])

<div {{ $attributes->only('class')->merge(['class' => 'w-full']) }}>
    @if($label)
        <label for="{{ $name }}" class="mb-1 block text-left text-xs font-semibold text-ink">{{ $label }}@if($required) <span class="text-danger">*</span>@endif</label>
    @endif
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        @if($required) required @endif
        {{ $attributes->except('class')->merge([
            'class' => 'h-12 w-full rounded-sm border border-line bg-white px-4 text-sm text-ink placeholder:text-ink-muted transition-ui focus:border-brand focus:ring-2 focus:ring-brand/20 ' . ($errors->has($name) ? 'border-danger' : ''),
        ]) }}
    >
    @error($name)
        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
    @enderror
</div>
