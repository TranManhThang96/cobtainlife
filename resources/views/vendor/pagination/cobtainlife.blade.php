@if ($paginator->hasPages())
    <nav>
        <ul class="list-unstyled pagination d-flex justify-content-center align-items-end">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled page-link-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" data-type="prev">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @else
                <li class="page-link-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" data-type="prev">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled page-link-item" aria-disabled="true"><a href="javascript:void(0);" class="page-link">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-link-item active" aria-current="page"><a href="javascript:void(0);" class="page-link">{{ $page }}</a></li>
                        @else
                            <li aria-current="page" class="page-link-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-link-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" data-type="next">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-link-item disabled">
                    <a class="page-link" aria-disabled="true" rel="next" aria-label="@lang('pagination.next')" data-type="next">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
