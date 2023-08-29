<form id="filterForm"
      action="{{ route('categories.show', ['alias' => $category->alias]) }}">

    <input type="hidden" name="sort">
    <input type="hidden" id="filterMinPrice" value="{{ $products->min('price') ?? 1 }}">
    <input type="hidden" id="filterMaxPrice"
           value="{{ $products->max('price') ?? 99999 }}">

    <div class="filters__close">
        <svg class="icon">
            <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
        </svg>
    </div>
    <div class="filters__hdr">
        <div class="filters__title">Сортировать по</div>
        <a href="{{ route('categories.show', ['alias' => $category->alias]) }}"
           class="filters__btn">Сбросить все</a>
    </div>
    <div class="filters__wrapper">
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
                                   class="filter__input" id="amount"
                                   value="{{ request()->input('price.from') ?? \App\Services\CatalogService::PRICE_FROM }}">
                        </div>
                        <div class="filter__col">
                            <span>до</span>
                            <input type="number" name="price[to]" class="filter__input"
                                   id="amount2"
                                   value="{{ request()->input('price.to') ?? \App\Services\CatalogService::PRICE_TO }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach(\App\Services\CatalogService::getFilters($category) as $category_property)
            <div class="filters__item filter">
                <div
                    class="filter__title @if(!$loop->first) is-close @endif">{{ $category_property->name }} {{ isset($category_property->measure) ? '('.$category_property->measure.')' : '' }}
                    <svg class="icon">
                        <use
                            xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                    </svg>
                </div>
                <div class="filter__block"
                     @if(!$loop->first) style="display: none" @endif>
                    <div class="filter__wrap filter__scroll">
                        @foreach($category_property->values as $property_value)
                            <label class="checkbox">
                                <input type="checkbox"
                                       name="properties[{{ $category_property->id }}][]"
                                       value="{{ $property_value->id }}"
                                       @if(is_array(request()->input("properties.".$category_property->id)) && in_array($property_value->id, request()->input("properties.".$category_property->id))) checked @endif/>
                                <div
                                    class="checkbox__text">{{ $property_value->value }}</div>
                            </label>
                        @endforeach
                    </div>
                    @if($category_property->values->count() > 3)
                        <button class="filter__all">Показать все</button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="filters__ftr">
        <button type="submit" class="filters__btn">Показать</button>
        <a href="{{ route('categories.show', ['alias' => $category->alias]) }}"
           class="filters__btn">Сбросить</a>
    </div>

</form>
