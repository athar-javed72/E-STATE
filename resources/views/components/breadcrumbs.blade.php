@props(['items' => []])

@if(count($items))
<nav {{ $attributes->merge(['class' => 'mb-4']) }} aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-2 text-xs text-ink-muted">
        @foreach($items as $index => $item)
            <li class="inline-flex items-center gap-2">
                @if($index > 0)
                    <span aria-hidden="true" class="text-ink-muted">/</span>
                @endif
                @if(!empty($item['url']) && ! $loop->last)
                    <a href="{{ $item['url'] }}" class="font-medium text-ink-secondary transition-ui hover:text-brand focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="font-semibold text-ink" @if($loop->last) aria-current="page" @endif>{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
