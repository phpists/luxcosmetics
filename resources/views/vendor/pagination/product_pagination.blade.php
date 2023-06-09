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
            <div class="d-flex align-items-center py-3">
                    <select id="paginate" form="product_form" name="paginate" class="form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary pagination_select"
                            style="width: 75px;">
                        <option @if(request()->get('paginate') == 10) selected @endif value="10">10</option>
                        <option @if(request()->get('paginate') == 20) selected @endif value="20">20</option>
                        <option @if(request()->get('paginate') == 30) selected @endif value="30">30</option>
                        <option @if(request()->get('paginate') == 50) selected @endif value="50">50</option>
                        <option @if(request()->get('paginate') == 100) selected @endif value="100">100</option>
                    </select>
                <span class="text-muted">Показано: {{ $paginator->lastItem() }} из {{ $paginator->total() }}</span>
            </div>
        </div>
    </div>
@endif
