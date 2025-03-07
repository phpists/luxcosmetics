<div>
    <form id="filterForm" wire:change.throttle.prevent="dispatchTo('catalog', 'filterCatalog')">
        <input type="hidden" id="search_needle" name="search" wire:model="search">
        {{--                <input type="hidden" id="filterPropertyCounts" value='@json($filterWeights)'>--}}
        {{--                <input type="hidden" id="filterPrices" value='@json($filterPrices)'>--}}

        <div class="filters__close">
            <svg class="icon">
                <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
            </svg>
        </div>
        <div class="filters__hdr">
            <div class="filters__title">Сортировать по</div>
            @if(isset($category))
                <a href="{{ route('categories.show', ['alias' => $category->alias]) }}"
                   class="filters__btn">Сбросить все</a>
            @endif
        </div>

        <div class="filters__wrapper">
            @if($allProducts->isNotEmpty())
                <div class="filters__item filter">
                    <div class="filter__title">Цена
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                        </svg>
                    </div>
                    <div class="filter__block">
                        <div class="filter__wrap">
                            <div class="filter__range" id="slider-range" data-min="{{ $productsMinPrice }}"
                                 data-max="{{ $productsMaxPrice }}" wire:ignore></div>
                            <div class="filter__row">
                                <div class="filter__col">
                                    <span>от</span>
                                    <input type="number" wire:model="minPrice"
                                           class="filter__input" id="filterCurrentMinPrice">
                                </div>
                                <div class="filter__col">
                                    <span>до</span>
                                    <input type="number" class="filter__input"
                                           id="filterCurrentMaxPrice" wire:model="maxPrice">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($isNotBrands && (isset($filterBrands) && $filterBrands->isNotEmpty()))
                <div class="filters__item filter" data-property="brands">
                    <div class="filter__title">Бренд
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                        </svg>
                    </div>
                    <div class="filter__block">
                        <div class="filter__wrap filter__scroll">
                            @foreach($filterBrands as $brand)
                                <label class="checkbox">
                                    <input type="checkbox" wire:model="brands"
                                           value="{{ $brand->id }}"
                                        @checked(in_array($brand->id, $brands))/>
                                    <div
                                        class="checkbox__text">{{ $brand->name }}</div>
                                </label>
                            @endforeach
                        </div>
                        <button type="button" class="filter__all">Показать все</button>
                    </div>
                </div>
            @endif

            @foreach($properties as $categoryProperty)
                @continue($categoryProperty->values->isEmpty())
                <div class="filters__item filter" data-property="{{ $categoryProperty->id }}">
                    <div
                        class="filter__title @if($isNotBrands || !$loop->first) is-close @endif">{{ $categoryProperty->name }} {{ isset($categoryProperty->measure) ? '('.$categoryProperty->measure.')' : '' }}
                        <svg class="icon">
                            <use
                                xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                        </svg>
                    </div>
                    <div class="filter__block"
                         @if($isNotBrands || !$loop->first) style="display: none" @endif>
                        <div class="filter__wrap filter__scroll">
                            @foreach($categoryProperty->values as $propertyValue)
                                <label class="checkbox">
                                    <input type="checkbox" wire:model.live="properties"
                                           value="{{ $propertyValue->id }}"
                                        @checked(in_array($propertyValue->id, $properties))/>
                                    <div class="checkbox__text">{{ $propertyValue->value }}</div>
                                </label>
                            @endforeach
                        </div>
                        <button type="button" class="filter__all">Показать все</button>
                    </div>
                </div>
            @endforeach
        </div>
        {{--                <div class="filters__ftr">--}}
        {{--                    <button type="submit" class="filters__btn" id="btn_show_selected">Показать</button>--}}
        {{--                    @if($isNotBrands && isset($category))--}}
        {{--                        <a href="{{ route('categories.show', ['alias' => $category->alias]) }}"--}}
        {{--                           class="filters__btn">Сбросить</a>--}}
        {{--                    @elseif(Route::is('show_search'))--}}
        {{--                        <a href="{{ route('show_search', ['search' => request('search')]) }}"--}}
        {{--                           class="filters__btn">Сбросить</a>--}}
        {{--                    @else--}}
        {{--                        <a href="{{ route('brands.show', ['link' => $brands->link]) }}"--}}
        {{--                           class="filters__btn">Сбросить</a>--}}
        {{--                    @endif--}}
        {{--                </div>--}}

    </form>
</div>
