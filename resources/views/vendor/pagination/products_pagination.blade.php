@if ($paginator->hasPages())
    <div class="category-page__pagination pagination">
        <button class="pagination__more">Показать  еще <span>12 товаров</span> <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use></svg></button>
        <ul class="pagination__list">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination__item pagination__item--first">
                    <a href="#"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use></svg></a>
                </li>
                <li class="pagination__item pagination__item--prev">
                    <a href="#"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use></svg></a>
                </li>
            @else
                <li class="pagination__item pagination__item--first">
                    <a href="{{ $paginator->url(1) }}"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use></svg></a>
                </li>
                <li class="pagination__item pagination__item--prev">
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use></svg>
                    </a>
                </li>
            @endif
{{--            <li class="pagination__item pagination__item--active"><span>1</span></li>--}}
{{--            <li class="pagination__item"><a href="">2</a></li>--}}
{{--            <li class="pagination__item"><a href="">3</a></li>--}}
{{--            <li class="pagination__item pagination__item--dots">...</li>--}}
{{--            <li class="pagination__item"><a href="">36</a></li>--}}
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination__item pagination__item--dots">...</li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__item pagination__item--active" data-label="{{$page}}" aria-current="{{ $page }}"><span>{{ $page }}</span></li>
                        @else
                            <li class="pagination__item" data-label="{{$page}}"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination__item pagination__item--next" aria-disabled="false">
                    <a href="{{ $paginator->nextPageUrl() }}"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use></svg></a>
                </li>
            @else
                <li class="disabled pagination__item pagination__item--next" aria-disabled="true">
                    <a href="#"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use></svg></a>
                </li>
            @endif
            <li class="pagination__item pagination__item--last"><a href="{{ $paginator->url($paginator->lastPage()) }}"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use></svg></a></li>
        </ul>
    </div>
@endif
