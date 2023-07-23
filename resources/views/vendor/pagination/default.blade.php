@if ($paginator->hasPages())
    <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="disabled"><i class="fa-solid fa-angle-left"></i></div>
            @else
                <a style="text-decoration: none" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><div><i class="fa-solid fa-angle-left"></i></div></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a style="text-decoration: none" ><div>{{ $element }}</div></a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <div>{{ $page }}</div>
                        @else
                        <a style="text-decoration: none" href="{{ $url }}"><div>{{ $page }}</div></a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a style="text-decoration: none" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><div><i class="fa-solid fa-angle-right"></i></div></a>
            @else
                <div class="disabled"><i class="fa-solid fa-angle-right"></i></div>
            @endif
    </div>
@endif
