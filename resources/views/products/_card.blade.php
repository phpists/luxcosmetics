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
            <button class="product__fav product_favourite"
                    data-label=@if($product->is_favourite && \App\Services\FavoriteProductsService::checkByIdForAnonym($product->id)) "1" @else
                "0"
            @endif data-value="{{$product->id}}">
            <svg class="icon">
                <use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use>
            </svg>
            </button>
        </div>
        <div class="product__title"><a
                href="{{ route('products.product', ['alias' => $product->alias]) }}">{{$product->brand->name}}</a>
        </div>
        <div class="product__subtitle">{{$product->title}}</div>
    </div>
    <div class="product__btm">
        <div class="product__reviews">
            <div class="stars">
                        <span class="stars__item is-active"><svg class="icon"><use
                                    xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                <span class="stars__item is-active"><svg class="icon"><use
                            xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                <span class="stars__item is-active"><svg class="icon"><use
                            xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                <span class="stars__item"><svg class="icon"><use
                            xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                <span class="stars__item"><svg class="icon"><use
                            xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
            </div>
            <a href="">16 отзывов</a>
        </div>
        <div class="product__ftrwrap">
            <div class="product__prices">
                <div class="product__price">{{ $product->price }} ₽</div>
                @isset($product->old_price)
                    <del class="product__oldprice">{{ $product->old_price }} ₽</del>
                @endisset
            </div>
            <button class="product__mobile-btn">
                <svg class="icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use>
                </svg>
            </button>
        </div>

        @if(isset($product->baseProperty->id))
            @php
                $product_variations = \App\Services\CatalogService::getProductVariations($product->id, $product->base_property_id);
                $product_variations->push($product)
            @endphp
            @if($product->baseProperty->id === \App\Models\Product::TYPE_VOLUME)
                @if($product_variations->count() > 1)
                    <div class="product__sizesinfo">Еще {{ ($product_variations->count() - 1) }} варианта</div>
                    <div class="product__pnl">
                        <div class="product__optionsblock">
                            <div class="product__optionstitle">Выбранный {{ mb_strtolower($product->baseProperty->name) }}:
                                <b>{{ ($product->baseValue->value ?? '') . ($product->baseProperty->measure ?? '') }}</b>
                            </div>
                            <div class="product__options product__volume">
                                @foreach($product_variations->sortBy('baseValue.value') as $product_variation)
                                    <label class="volume changeModification" data-url="{{ route('product.card', $product_variation->id) }}">
                                        <input type="radio" name="volume" @checked($product->id == $product_variation->id)/>
                                        <div class="volume__text"><b>{{ ($product_variation->baseValue->value ?? '') . ($product_variation->baseProperty->measure ?? '') }}</b>
                                            {{ $product_variation->price }} ₽
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif" data-product="{{ $product->id }}"><span>Добавить в корзину {{ $product->price }} ₽</span>
                        </button>
                    </div>
                @else
                    <div class="product__pnl">
                        <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif" data-product="{{ $product->id }}"><span>Добавить в корзину {{ $product->price }} ₽</span>
                        </button>
                    </div>
                @endif
            @elseif($product->baseProperty->id === \App\Models\Product::TYPE_COLOR)
                @if($product_variations->count() > 1)
                <div class="product__sizesinfo">Еще {{ ($product_variations->count() - 1) }} варианта</div>
                <div class="product__pnl">
                    <div class="product__optionsblock">
                        <div class="product__optionstitle">Выбранный цвет:
                            <b>{{ ($product->baseValue->value ?? '') }}</b></div>
                        <div class="product__options product__colors">
                            @foreach($product_variations->sortBy('baseValue.value') as $product_variation)
                            <label class="color changeModification" data-url="{{ route('product.card', $product_variation->id) }}">
                                <input type="radio" name="color" @checked($product->id == $product_variation->id)/>
                                <div class="color__text" style="background-color: {{ $product_variation->baseValue->color }}"></div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif" data-product="{{ $product->id }}">
                        <span>Добавить в корзину {{ $product->price }} ₽</span>
                    </button>
                </div>
                    @endif
            @else
                <div class="product__pnl">
                    <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif" data-product="{{ $product->id }}"><span>Добавить в корзину {{ $product->price }} ₽</span>
                    </button>
                </div>
            @endif
        @else
            <div class="product__pnl">
                <button class="product__addcart addToCart @if($cartService->check($product->id)) isInCart @endif" data-product="{{ $product->id }}"><span>Добавить в корзину {{ $product->price }} ₽</span>
                </button>
            </div>
        @endif
    </div>

</div>
