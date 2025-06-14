@if ($paginator->hasPages())
    <nav aria-label="Page navigation" class="pagination-container">
        <ul class="pagination shadow-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link border-0" aria-hidden="true">&lt;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link border-0 text-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lt;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link border-0">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link border-0">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link border-0 text-primary hover-effect" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link border-0 text-primary" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&gt;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link border-0" aria-hidden="true">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        .pagination-container {
            margin: 2rem 0;
        }

        .pagination {
            display: flex;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .page-link {
            padding: 0.6rem 1rem;
            transition: all 0.2s ease;
            background-color: #fff;
        }

        .page-item.active .page-link {
            background-color: #4299e1;
            color: white;
            font-weight: 500;
        }

        .page-item.disabled .page-link {
            color: #a0aec0;
        }

        .hover-effect:hover {
            background-color: #ebf4ff;
            transform: translateY(-1px);
        }

        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
    </style>
@endif
