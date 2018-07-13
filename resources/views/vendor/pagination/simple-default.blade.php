@if ($paginator->hasPages())
    <div class="shop_pagination_area wow fadeInUp" data-wow-delay="1.1s">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span>@lang('pagination.previous')</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
                @else
                    <li class="page-item disabled"><span>@lang('pagination.next')</span></li>
                @endif
            </ul>
        </nav>
    </div>
@endif
