@php
    if (! isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView({behavior:'smooth'})
        JS
        : '';
@endphp

@if ($paginator->hasPages())
<div class="category-page__pagination pagination">

    @if ($paginator->hasMorePages())
    <button class="pagination__more" wire:click="loadMore">Показать  еще <span>12 {{ $moreItemName ?? 'товаров' }}</span> <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use></svg></button>
    @endif

    <ul class="pagination__list" style="display: flex">

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
            <a href="javascript:;" wire:click="gotoPage(1, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use></svg></a>
        </li>
        <li class="pagination__item pagination__item--prev">
            <a href="javascript:;" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">
                <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use></svg>
            </a>
        </li>
        @endif
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
        <li class="pagination__item pagination__item--active" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" data-label="{{$page}}" aria-current="{{ $page }}"><span>{{ $page }}</span></li>
        @else
        <li class="pagination__item" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" data-label="{{$page}}"><a href="javascript:;" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="pagination__item pagination__item--next" aria-disabled="false">
            <a href="javascript:;" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use></svg></a>
        </li>
            <li class="pagination__item pagination__item--last">
                <a href="javascript:;" wire:click="gotoPage('{{ $paginator->lastPage() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use></svg></a>
            </li>
        @else
        <li class="disabled pagination__item pagination__item--next" aria-disabled="true">
            <a href="#"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use></svg></a>
        </li>
            <li class="pagination__item pagination__item--last">
                <a href="#"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use></svg></a>
            </li>
        @endif
    </ul>
</div>
@endif
