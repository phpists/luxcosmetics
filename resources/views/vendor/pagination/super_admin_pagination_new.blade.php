@if ($paginator->hasPages())
    <div class="example-preview">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex flex-wrap py-2 mr-3">
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light mr-2 my-1">
                    <i class="ki ki-bold-arrow-back icon-xs"></i>
                </a>

                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-light btn-hover-primary active mr-2 my-1">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-icon btn-sm btn-light mr-2 my-1">
                    <i class="ki ki-bold-arrow-next icon-xs"></i>
                </a>
            </div>
        </div>
    </div>
@endif
