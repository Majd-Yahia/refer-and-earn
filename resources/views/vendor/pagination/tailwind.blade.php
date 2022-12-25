@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="pagination pagination-circle pagination-outline">
            @if ($paginator->onFirstPage())
                <li class="page-item previous disabled m-1">
                    <a href="#" class="page-link">
                        <i class="previous"></i>
                    </a>
                </li>
            @else
                <li class="page-item previous m-1">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link">
                        <i class="previous"></i>
                    </a>
                </li>
            @endif



            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active m-1">
                                <a href="{{ $url }}" class="page-link"> {{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item m-1">
                                <a href="{{ $url }}" class="page-link"> {{ $page }} </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach


            @if ($paginator->hasMorePages())
                <li class="page-item next m-1">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
                        <i class="next"></i>
                    </a>
                </li>
            @else
                <li class="page-item next disabled m-1">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
                        <i class="next"></i>
                    </a>
                </li>
            @endif
    </nav>
@endif
