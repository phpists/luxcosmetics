@foreach($products as $product)
    <div class="category-page__product">
        <div class="product">
            <div class="product__top">
                <div class="product__image">
                    <div class="product__labels">
                        <div class="product__label product__label--brown">-50%</div>
                        <div class="product__label product__label--green">Хит продаж</div>
                    </div>
                    @php
                        $selected_variation = $product->product_variations->first();
                    @endphp
                    <a href="/products/{{$product->alias}}{{$selected_variation !== null?'/'.$selected_variation->id:''}}">
                        <img src="{{asset('images/uploads/products/'.$product->image)}}" alt="">
                    </a>
                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
                </div>
                <div class="product__title"><a href="/products/{{$product->alias}}{{$selected_variation !== null?'/'.$selected_variation->id:''}}">{{$product->brand->name}}</a></div>
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
                        @if($selected_variation != null)
                            <div class="product__price">
                                {{$selected_variation->discount_price??$selected_variation->price}} ₽
                            </div>
                            @isset($selected_variation->discount_price)
                                <del class="product__oldprice">{{$selected_variation->price}} ₽</del>
                            @endisset
                        @else
                            <div class="product__price">{{$product->discount_price??$product->price}} ₽</div>
                            @isset($product->discount_price)
                                <del class="product__oldprice">{{$product->price}} ₽</del>
                            @endisset
                        @endif
                    </div>
                    <button class="product__mobile-btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg></button>
                </div>
                <div class="product__sizesinfo">Еще два размера</div>
                <div class="product__pnl">
                    @isset($selected_variation)
                        <div class="product__optionsblock">
                            <div class="product__optionstitle">Выбранный объем: <b>{{$selected_variation->size}}</b></div>
                            <div class="product__options product__volume">
                                @foreach($product->product_variations as $variation)
                                    <label class="volume">
                                        <input type="radio" name="volume"  checked/>
                                        <div class="volume__text"><b>{{$variation->size}}</b>
                                            {{$variation->discount_price??$variation->price}} ₽ </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endisset
                    <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                </div>
            </div>

        </div>
    </div>
@endforeach
