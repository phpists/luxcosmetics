<form id="filterForm" style="visibility: hidden"
      action="{{ $custom_route ?? route('categories.show', ['alias' => $category->alias]) }}">

    <input type="hidden" name="sort">
    <input type="hidden" id="search_needle" name="search" value="{{request()->input('search')}}">
    <input type="hidden" id="filterMinPrice" value="{{ $filter_prices['filteredMin'] }}">
    <input type="hidden" id="filterMaxPrice" value="{{ $filter_prices['filteredMax'] }}">
    <input type="hidden" id="filterPropertyCounts" value='@json($filters_weight)'>
    <input type="hidden" id="filterPrices" value='@json($filter_prices)'>

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
        @if(isset($filter_prices['min']) || isset($filter_prices['max']))
        <div class="filters__item filter">
            <div class="filter__title">Цена
                <svg class="icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                </svg>
            </div>
            <div class="filter__block">
                <div class="filter__wrap">
                    <div class="filter__range" id="slider-range"></div>
                    <div class="filter__row">
                        <div class="filter__col">
                            <span>от</span>
                            <input type="number" name="price[from]"
                                   class="filter__input" id="filterCurrentMinPrice"
                                   value="{{ request()->input('price.from') ?? $filter_prices['min'] }}">
                        </div>
                        <div class="filter__col">
                            <span>до</span>
                            <input type="number" name="price[to]" class="filter__input"
                                   id="filterCurrentMaxPrice"
                                   value="{{ request()->input('price.to') ?? $filter_prices['max'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($is_not_brands && (isset($brands) && $brands->isNotEmpty()))
        <div class="filters__item filter" data-property="brands">
            <div class="filter__title">Бренд
                <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg>
            </div>
            <div class="filter__block">
                <div class="filter__wrap filter__scroll">
                    @foreach($brands as $brand)
                        <label class="checkbox">
                            <input type="checkbox"
                                   name="brands[]"
                                   value="{{ $brand->id }}"
                                   @checked(is_array(request()->input("brands")) && in_array($brand->id, request()->input("brands")))/>
                            <div
                                class="checkbox__text">{{ $brand->name }}</div>
                        </label>
                    @endforeach
                </div>
                <button type="button" class="filter__all">Показать все</button>
            </div>
        </div>
        @endif

        @foreach($properties as $category_property)
            @continue($category_property->values->isEmpty())
            <div class="filters__item filter" data-property="{{ $category_property->id }}">
                <div
                    class="filter__title @if($is_not_brands || (!$loop->first && !$is_not_brands)) is-close @endif">{{ $category_property->name }} {{ isset($category_property->measure) ? '('.$category_property->measure.')' : '' }}
                    <svg class="icon">
                        <use
                            xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                    </svg>
                </div>
                <div class="filter__block"
                     @if($is_not_brands || (!$loop->first && !$is_not_brands)) style="display: none" @endif>
                    <div class="filter__wrap filter__scroll">
                        @foreach($category_property->values as $property_value)
                            <label class="checkbox">
                                <input type="checkbox"
                                       name="properties[{{ $category_property->id }}][]"
                                       value="{{ $property_value->id }}"
                                       @checked(is_array(request()->input("properties.".$category_property->id)) && in_array($property_value->id, request()->input("properties.".$category_property->id)))/>
                                <div class="checkbox__text">{{ $property_value->value }}</div>
                            </label>
                        @endforeach
                    </div>
                    <button type="button" class="filter__all">Показать все</button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="filters__ftr">
        <button type="submit" class="filters__btn" id="btn_show_selected">Показать</button>
        @if($is_not_brands && isset($category))
        <a href="{{ route('categories.show', ['alias' => $category->alias]) }}"
           class="filters__btn">Сбросить</a>
        @elseif(Route::is('show_search'))
            <a href="{{ route('show_search', ['search' => request('search')]) }}"
               class="filters__btn">Сбросить</a>
        @else
            <a href="{{ route('brands.show', ['link' => $brands->link]) }}"
               class="filters__btn">Сбросить</a>
        @endif
    </div>

</form>
