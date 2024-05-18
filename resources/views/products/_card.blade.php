
<div class="product">
    <div class="product__top">
        <div class="product__image">
            <div class="product__labels">
                @if(isset($product->discount))
                    <div class="product__label product__label--brown">-{{ $product->discount }}%</div>
                @endif
                @if($product->show_in_popular)
                    {{--                            <div class="product__label product__label--green">Хит продаж</div>--}}
                @endif
            </div>
            <a href="{{ route('products.product', ['alias' => $product->alias]) }}">
                <img src="{{asset('images/uploads/products/'.$product->main_image)}}" alt="">
            </a>
            <button class="product__fav product_favourite @if($product->is_favourite && \App\Services\FavoriteProductsService::checkByIdForAnonym($product->id)) active @endif" data-value="{{$product->id}}">
{{--                <svg class="icon">--}}
{{--                    @if(isset($is_favourite_page) && $is_favourite_page)--}}
{{--                        <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>--}}
{{--                    @else--}}
{{--                        <use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use>--}}
{{--                    @endif--}}
{{--                </svg>--}}
                <svg class="active-icon icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>
                </svg>
                <svg class="inactive-icon icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use>
                </svg>
            </button>
        </div>
        <div class="product__title"><a
                href="{{ route('products.product', ['alias' => $product->alias]) }}">{{$product->brand?->name}}</a>
        </div>
        <div class="product__subtitle">{{$product->title}}</div>
    </div>
    <div class="product__btm">
        @php
            $comments = \App\Models\Comments::query()
            ->where('product_id', $product->id)
            ->where('status', 'Опубликовать');

             $ratings = \App\Models\Comments::where('product_id', $product->id)
            ->where('status', 'Опубликовать')
            ->pluck('rating');
            $averageRating = $ratings->avg();
            $countComments = $comments->count() ?? 0;
        @endphp
        <div class="product__reviews">
            @if($countComments !== 0)
                <div class="stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($averageRating))
                            <span class="stars__item is-active">
                                            <svg class="icon"><use xlink:href="{{ asset('images/dist/sprite.svg#star') }}"></use></svg>
                                        </span>
                        @else
                            <span class="stars__item">
                                            <svg class="icon"><use xlink:href="{{ asset('images/dist/sprite.svg#star') }}"></use></svg>
                                        </span>
                        @endif
                    @endfor
                </div>
            @endif
            @if($countComments !== 0)
                <a href="{{ route('products.product', ['alias' => $product->alias]) }}">отзывы ({{$countComments}})</a>
            @endif
        </div>
        <div class="product__ftrwrap">
            <div class="product__prices">
                <div class="product__price">{{ $product->price }} ₽</div>
                @isset($product->old_price)
                    <del class="product__oldprice">{{ $product->old_price }} ₽</del>
                @endisset
            </div>
{{--            <button class="product__mobile-btn">--}}
{{--                <svg class="icon">--}}
{{--                    <use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use>--}}
{{--                </svg>--}}
{{--            </button>--}}
            @if($product->isAvailable())
                <button class="product__mobile-btn addToCart @if(isset($product->basePropertyValue->id)) @if($cartService->check($product->id, $product->basePropertyValue->id)) isInCart @endif @endif" data-product="{{ $product->id }}" data-property="{{ $product->basePropertyValue->id ?? '' }}">
                            <svg class="icon @if($product->is_favourite) favourite_product @endif">
                                <use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use>
                            </svg>
                </button>
            @endif
        </div>

        @if(isset($product->baseProperty->id) && $product->product_variations->isNotEmpty())
            @php
                $product_variations = \App\Services\CatalogService::getProductVariations($product->id, $product->base_property_id);
                $product_variations->push($product)
            @endphp
            @if($product->baseProperty->id === \App\Models\Product::TYPE_VOLUME)
                @if($product_variations->count() > 1)
                    <div class="product__sizesinfo">{{ $product->getVaritationsCountLabel() }}</div>
                    <div class="product__pnl">
                        <div class="product__optionsblock">
                            @if(in_array($product->base_property_id, [1,2]))
                            <div class="product__optionstitle">Выбранный {{ mb_strtolower($product->baseProperty->name) }}:
                                <b>{{ ($product->basePropertyValue->value ?? '') . ($product->baseProperty->measure ?? '') }}</b>
                            </div>
                            @endif
                            <div class="product__options product__volume">
                                @foreach($product_variations->sortBy('basePropertyValue.value') as $product_variation)
                                    <label class="volume changeModification" data-url="{{ route('product.card', $product_variation->id) }}">
                                        <input type="radio" name="volume_{{ md5($product->id . microtime()) }}" @checked($product->id == $product_variation->id)/>
                                        <div class="volume__text">
                                            @if(in_array($product_variation->base_property_id, [1,2]))
                                                <b>{{ ($product_variation->basePropertyValue->value ?? '') . ($product_variation->baseProperty->measure ?? '') }}</b>
                                            @endif
                                            {{ $product_variation->price }} ₽
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @if($product->isAvailable())
                        <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif"
                                data-product="{{ $product->id }}">
                            <span>Добавить в корзину {{ $product->price }} ₽</span>
                        </button>
                        @else
                            <button class="product__addcart" disabled style="cursor:not-allowed; background-color: #b2b2b2">
                                <span>Нет в наличии</span>
                            </button>
                        @endif
                    </div>
                @else
                    <div class="product__pnl">
                        @if($product->isAvailable())
                            <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif"
                                    data-product="{{ $product->id }}">
                                <span>Добавить в корзину {{ $product->price }} ₽</span>
                            </button>
                        @else
                            <button class="product__addcart" disabled style="cursor:not-allowed; background-color: #b2b2b2">
                                <span>Нет в наличии</span>
                            </button>
                        @endif
                    </div>
                @endif
            @elseif($product->baseProperty->id === \App\Models\Product::TYPE_COLOR)
                @if($product_variations->count() > 1)
                <div class="product__sizesinfo">{{ $product->getVaritationsCountLabel() }}</div>
                <div class="product__pnl">
                    <div class="product__optionsblock">
                        <div class="product__optionstitle">Выбранный цвет:
                            <b>{{ ($product->basePropertyValue->value ?? '') }}</b></div>
                        <div class="product__options product__colors">
                            @foreach($product_variations->sortBy('basePropertyValue.value') as $product_variation)
                            <label class="color changeModification" data-url="{{ route('product.card', $product_variation->id) }}">
                                <input type="radio" name="color_{{ md5($product->id . microtime()) }}" @checked($product->id == $product_variation->id)/>
                                <div class="color__text" style="background-color: {{ $product_variation->basePropertyValue->color }}"></div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @if($product->isAvailable())
                        <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif"
                                data-product="{{ $product->id }}">
                            <span>Добавить в корзину {{ $product->price }} ₽</span>
                        </button>
                    @else
                        <button class="product__addcart" disabled style="cursor:not-allowed; background-color: #b2b2b2">
                            <span>Нет в наличии</span>
                        </button>
                    @endif
                </div>
                    @endif
            @else
                <div class="product__pnl">
                    @if($product->isAvailable())
                        <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif"
                                data-product="{{ $product->id }}">
                            <span>Добавить в корзину {{ $product->price }} ₽</span>
                        </button>
                    @else
                        <button class="product__addcart" disabled style="cursor:not-allowed; background-color: #b2b2b2">
                            <span>Нет в наличии</span>
                        </button>
                    @endif
                </div>
            @endif
        @else
            <div class="product__pnl">
                @if($product->isAvailable())
                    <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif"
                            data-product="{{ $product->id }}">
                        <span>Добавить в корзину {{ $product->price }} ₽</span>
                    </button>
                @else
                    <button class="product__addcart" disabled style="cursor:not-allowed; background-color: #b2b2b2">
                        <span>Нет в наличии</span>
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>
