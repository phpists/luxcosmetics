<div class="category-page__container">
    <div wire:loading.flex class="spinner-overlay"><div class="spinner"></div></div>

    <aside class="category-page__aside">
        <div class="filters" id="filters">
            <form id="filterForm" wire:change.throttle.prevent="$refresh">
                <input type="hidden" id="search_needle" name="search" wire:model="search">

                <div class="filters__close">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
                    </svg>
                </div>
                <div class="filters__hdr">
                    <div class="filters__title">Фильтровать по</div>
                    <a href="javascript:;" wire:click="resetFilters" class="filters__btn">Сбросить все</a>
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
                                    <div class="filter__range" id="slider-range"
                                         data-current-min="{{ $currentProductsMinPrice }}"
                                         data-current-max="{{ $currentProductsMaxPrice }}"
                                         data-filter-min="{{ $filterMinPrice && $filterMinPrice > $currentProductsMinPrice ? $filterMinPrice : $currentProductsMinPrice }}"
                                         data-filter-max="{{ $filterMaxPrice && $filterMaxPrice < $currentProductsMaxPrice ? $filterMaxPrice : $currentProductsMaxPrice }}"></div>
                                    <div class="filter__row">
                                        <div class="filter__col">
                                            <span>от</span>
                                            <input type="number" wire:model.live.debounce="filterMinPrice"
                                                   class="filter__input" id="filterCurrentMinPrice">
                                        </div>
                                        <div class="filter__col">
                                            <span>до</span>
                                            <input type="number" class="filter__input"
                                                   id="filterCurrentMaxPrice" wire:model.live.debounce="filterMaxPrice">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($isNotBrands && (isset($brands) && $brands->isNotEmpty()))
                        <div class="filters__item filter">
                            <div class="filter__title">Бренд
                                <svg class="icon">
                                    <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                                </svg>
                            </div>
                            <div class="filter__block">
                                <div class="filter__wrap filter__scroll">
                                    @foreach($brands as $brand)
                                        <label class="checkbox" wire:key="brands.{{ $brand->id }}">
                                            <input type="checkbox" wire:model.live="filterBrands"
                                                   value="{{ $brand->id }}"
                                                @checked(in_array($brand->id, $filterBrands))/>
                                            <div
                                                class="checkbox__text">{{ $brand->name }}</div>
                                        </label>
                                    @endforeach
                                </div>
                                @if($brands->count() > 3)
                                <button type="button" class="filter__all">Показать все</button>
                                @endif
                            </div>
                        </div>
                    @endif

                    @foreach($properties as $property)
                        @continue($property->values->isEmpty())
                        <div class="filters__item filter" wire:key="properties.{{ $property->id }}">
                            <div class="filter__title @if(empty(array_intersect(array_map('intval', array_keys($filterProperties[$property->id] ?? [])), $property->values->pluck('id')->toArray()))) @if($isNotBrands || !$loop->first) is-close @endif @endif">
                                {{ $property->name }} {{ isset($property->measure) ? '('.$property->measure.')' : '' }}
                                <svg class="icon">
                                    <use
                                        xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                                </svg>
                            </div>
                            <div class="filter__block"
                                 @if(empty(array_intersect(array_map('intval', array_keys($filterProperties[$property->id] ?? [])), $property->values->pluck('id')->toArray()))) @if($isNotBrands || !$loop->first) style="display: none" @endif @endif>
                                <div class="filter__wrap filter__scroll @isset($filterProperties[$property->id]) is-open @endisset">
                                    @foreach($property->values as $propertyValue)
                                        <label class="checkbox" wire:key="property-values.{{ $propertyValue->id }}">
                                            <input type="checkbox" wire:model="filterProperties.{{ $property->id }}.{{ $propertyValue->id }}"
                                                @checked(isset($filterProperties[$property->id][$propertyValue->id]))/>
                                            <div class="checkbox__text">{{ $propertyValue->value }}</div>
                                        </label>
                                    @endforeach
                                </div>
                                @if($property->values->count() > 3)
                                <button type="button" class="filter__all ">
                                    @isset($filterProperties[$property->id])
                                        Свернуть
                                    @else
                                        Показать все
                                    @endisset
                                </button>
                                @endif
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

        <div class="category-page__image"><img src="" alt=""></div>
    </aside>

    <main class="category-page__main">
        @if($category->topTags?->isNotEmpty())
            <ul class="category-page__subcategories">
                @foreach($category->topTags as $tag)
                    <li>
                        <a href="{{ $tag->link }}" class="category-page__subcategory">
                                        <span class="category-page__subcategory-image"><img
                                                src="{{ $tag->image_src }}" alt=""></span>
                            <span class="category-page__subcategory-title">{{ $tag->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif

        <div id="catalog">
            @if($category->posts?->isNotEmpty())
                <div class="category-page__events">
                    @foreach($category->posts as $post)
                        <div class="category-page__event catevent">
                            <div class="catevent__image"><img
                                    src="{{asset('/images/uploads/category_posts/'.$post->image_path)}}"
                                    alt=""></div>
                            <div class="catevent__title">{{$post->title}}</div>
                            <div class="catevent__subtitle">{!! $post->content !!}</div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="category-page__sortblock sortblock">
                    <div class="sortblock__total">Показано <b><span id="currentlyShowedCount">{{ $products->count() }}</span> из {{ $products->total() }}</b></div>
                <div class="sortblock__sort sort">
                    <span class="sort__title">Сортировать по</span>
                    <select name="" id="select_sort_preview" class="sort__select" wire:model.live="sort">
                        <option value="default:desc">По умолчанию</option>
                        <option value="created_at:desc">Новизне</option>
                        <option value="popularity:desc">Популярности</option>
                        <option value="price:asc">Возрастанию цены</option>
                        <option value="price:desc">Убыванию цены</option>
                    </select>
                </div>
            </div>
            <div class="category-page__mobilenav">
                <button class="category-page__mobilebtn btnfilters">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#filters')}}"></use>
                    </svg>
                    Показать фильтры
                </button>
                <button class="category-page__mobilebtn btnsort">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#arrows')}}"></use>
                    </svg>
                    Сортировать по
                </button>
            </div>
            <div class="sortmobile">
                <div class="sortmobile__close">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
                    </svg>
                </div>
                <div class="sortmobile__title">Сортировать</div>
                <label class="radio">
                    <input type="radio" wire:model.live="sort" value="default:desc"/>
                    <div class="radio__text">По умолчанию</div>
                </label>
                <label class="radio">
                    <input type="radio" wire:model.live="sort" value="created_at:desc"/>
                    <div class="radio__text">Новизне</div>
                </label>
                <label class="radio">
                    <input type="radio" wire:model.live="sort" value="popularity:desc"/>
                    <div class="radio__text">Популярности</div>
                </label>
                <label class="radio">
                    <input type="radio" wire:model.live="sort" value="price:asc"/>
                    <div class="radio__text">Возрастанию цены</div>
                </label>
                <label class="radio">
                    <input type="radio" wire:model.live="sort" value="price:desc"/>
                    <div class="radio__text">Убыванию цены</div>
                </label>
            </div>

            <div class="category-page__products">

                @if(isset($gridItems) && !empty($gridItems))
                    @foreach($gridItems as $row => $items)
                        @foreach($items as $item)
                            @if($item instanceof \App\Models\Product)
                                <div class="category-page__product">
{{--                                    <livewire:product-card :product="$item"/>--}}
                                    @include('products._card', ['product' => $item])
                                </div>
                            @elseif($item instanceof \App\Models\CatalogBanner)
                                @include("catalog.banners.{$item->type}", ['catalogBanner' => $item])
                            @endif
                        @endforeach
                    @endforeach
                @else
                    @foreach($products as $product)
                        <div class="category-page__product">
                            @include('products._card')
                        </div>
                    @endforeach
                @endif

            </div>

            {!! $products->links('vendor.livewire.catalog-pagination', data: ['scrollTo' => '#catalog']) !!}
        </div>
    </main>
</div>

@script
<script>
    $wire.on('catalog-rendered', () => {

        $(document).off('click', '.filter__title').on('click', '.filter__title', function() {
            $(this).toggleClass('is-close');
            $(this).parents('.filter').find('.filter__block').slideToggle();
        });

        $(document).off('click', '.filter__all').on('click', '.filter__all', function() {
            $(this).text(function(i, text){
                return text === "Свернуть" ? "Показать все" : "Свернуть";
            })
            $(this).parents(".filter").find(".filter__wrap").toggleClass("is-open");
        });

        $(document).on('click', '.sortmobile label', function (e) {
            $('.sortmobile .sortmobile__close').click()
        })
        $(document).on('change', '#filterForm', function (e) {
            $('#filterForm .filters__close').click()
        })

        setTimeout(function () {
            let $sliderRange = $('#slider-range'),
                sliderRange = document.getElementById('slider-range');

            if ($sliderRange.slider('instance') !== undefined)
                $sliderRange.slider('destroy');

            $sliderRange.slider({
                range: true,
                min: parseInt(sliderRange.dataset.currentMin),
                max: parseInt(sliderRange.dataset.currentMax),
                values: [
                    parseInt(sliderRange.dataset.filterMin),
                    parseInt(sliderRange.dataset.filterMax),
                ],
                slide: function (event, ui) {
                    $("#filterCurrentMinPrice").val(ui.values[0]);
                    $("#filterCurrentMaxPrice").val(ui.values[1]);
                },
                change: function (event, ui) {
                    @this.set('filterMinPrice', ui.values[0]);
                    @this.set('filterMaxPrice', ui.values[1]);
                }
            });

            $('#filterForm .filters__close').click()
        }, 100)

    });
</script>
@endscript

