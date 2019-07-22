@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="pull-right pagination">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link"><i class="fa fa-angle-double-left"> Previous</i></span>
                </li>
            @else
                <li class="page-item ">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                        <span><i class="fa fa-angle-double-left"> Previous</i></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item  active"><span class="page-link">{{ $page }}</span></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li class="page-item "><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li class="page-item  disabled"><span class="page-link"><i class="fa fa-ellipsis-h"></i></span></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item ">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        <span>Next <i class="fa fa-angle-double-right"></i></span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next <i class="fa fa-angle-double-right"></i></span>
                </li>
            @endif
        </ul>
    </div>
    <!-- Pagination -->
@endif