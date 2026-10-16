@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex flex-wrap items-center justify-center gap-2">
        @if ($paginator->onFirstPage())
            <span class="inline-flex h-11 items-center rounded-sm border border-line px-4 text-sm text-ink-muted">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex h-11 items-center rounded-sm border border-line bg-white px-4 text-sm font-semibold text-ink transition-ui hover:shadow-sm">Previous</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-2 text-sm text-ink-muted">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="inline-flex h-11 min-w-11 items-center justify-center rounded-sm bg-brand px-3 text-sm font-semibold text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="inline-flex h-11 min-w-11 items-center justify-center rounded-sm border border-line bg-white px-3 text-sm font-semibold text-ink transition-ui hover:shadow-sm">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex h-11 items-center rounded-sm border border-line bg-white px-4 text-sm font-semibold text-ink transition-ui hover:shadow-sm">Next</a>
        @else
            <span class="inline-flex h-11 items-center rounded-sm border border-line px-4 text-sm text-ink-muted">Next</span>
        @endif
    </nav>
@endif
