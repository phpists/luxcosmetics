@foreach($products as $product)
    <div class="category-page__product">
        <div class="product">
            <div class="product__top">
                <div class="product__image">
                    <div class="product__labels">
                        <div class="product__label product__label--brown">-50%</div>
                        <div class="product__label product__label--green">Хит продаж</div>
                    </div>
                    <a href="/products/{{$product->alias}}">
                        <img src="{{asset('images/uploads/products/'.$product->main_image)}}" alt="">
                    </a>
                    <button class="product__fav product_favourite" data-label=@if($product->is_favourite && \App\Services\FavoriteProductsService::checkByIdForAnonym($product->id)) "1" @else "0" @endif data-value="{{$product->id}}"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
                </div>
                <div class="product__title"><a href="/products/{{$product->alias}}">{{$product->brand->name}}</a></div>
                <div class="product__subtitle">{{$product->title}}</div>
            </div>
            <div class="product__btm">
                <div class="product__reviews">
                    <div class="stars">
                        <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                        <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                        <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                        <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                        <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                    </div>
                    <a href="">16 отзывов</a>
                </div>
                <div class="product__ftrwrap">
                    <div class="product__prices">
                        <div class="product__price">{{$product->discount_price??$product->price}} ₽</div>
                        @isset($product->discount_price)
                            <del class="product__oldprice">{{$product->price}} ₽</del>
                        @endisset
                    </div>
                    <button class="product__mobile-btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg></button>
                </div>
                @php
                    $filtered_variations = $product->filterVariations($variations)
                @endphp
                    <div class="product__sizesinfo">Еще два размера</div>
                    <div class="product__pnl">
                        @if(sizeof($filtered_variations))
                        <div class="product__optionsblock">
                            <div class="product__optionstitle">Выбранный объем: <b>{{$product->size}}</b></div>
                            <div class="product__options product__volume">
                                <label class="volume">
                                    <input type="radio" name="volume"  checked/>
                                    <div class="volume__text"><b>{{$product->size}}</b>
                                        {{$product->discount_price??$product->price}} ₽ </div>
                                </label>
                                @foreach($product->filterVariations($variations) as $variation)
                                    <label class="volume">
                                        <input type="radio" name="volume"  checked/>
                                        <div class="volume__text"><b>{{$variation->size}}</b>
                                            {{$variation->discount_price??$variation->price}} ₽ </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <button class="product__addcart">Добавить в корзину <span>{{$product->discount_price??$product->price}} ₽</span></button>
                    </div>
            </div>

        </div>
    </div>
@endforeach
