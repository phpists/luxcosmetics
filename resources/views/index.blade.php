@extends('layouts.app')

@section('title', 'Главная')
@section('content')
    <section class="mainaction">
        <div class="container">
            @php
                $item = \App\Services\BannerService::getBanner();
                $positionIds = [];
                foreach ($item as $banner) {
                    $position = $banner->position;
                    if (!isset($positionIds[$position])) {
                        $positionIds[$position] = [];
                    }
                    $positionIds[$position][] = $banner->id;
                }
            @endphp
            <div class="row">
                @if (isset($positionIds['first'][0]) && $selectedItem = $item->find($positionIds['first'][0]))
                <div class="col-lg-12">
                    <div class="mainaction__one">
                        <a href="{{ route('index.banner', $selectedItem->link) }}">
                            <picture>
                                <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 576px)">
                                <source srcset="{{asset('images/dist/banners/banner-big@320.jpg')}}" media="(max-width: 575px)" >
                                <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                            </picture>
                        </a>
                    </div>
                </div>
                @endif
            </div>

            @if (isset($positionIds['second'][0]) && $selectedItem = $item->find($positionIds['second'][0]))
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="article">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-medium@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-medium@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ Str::limit(strip_tags($selectedItem->text), $limit = 130, $end = '...') }}</div>
                        </div>
                        <a href="{{ route('index.banner', $selectedItem->link) }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['second'][1]) && $selectedItem = $item->find($positionIds['second'][1]))
                <div class="col-lg-6 col-md-6">
                    <div class="article">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-medium2@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-medium2@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ Str::limit(strip_tags($selectedItem->text), $limit = 130, $end = '...') }}</div>
                        </div>
                        <a href="{{ route('index.banner', $selectedItem->link) }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                @if(isset($positionIds['third'][0]) && $selectedItem = $item->find($positionIds['third'][0]))
                <div class="col-lg-4 col-md-4">
                    <div class="article article--threecol">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-small@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-small@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ Str::limit(strip_tags($selectedItem->text), $limit = 150, $end = '...') }}</div>
                        </div>
                        <a href="{{ route('index.banner', $selectedItem->link) }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['third'][1]) && $selectedItem = $item->find($positionIds['third'][1]))
                <div class="col-lg-4 col-md-4">
                    <div class="article article--threecol">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-small2@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-small2@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ Str::limit(strip_tags($selectedItem->text), $limit = 150, $end = '...') }}</div>
                        </div>
                        <a href="{{ route('index.banner', $selectedItem->link) }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['third'][2]) && $selectedItem = $item->find($positionIds['third'][2]))
                <div class="col-lg-4 col-md-4">
                    <div class="article article--threecol">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-small3@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-small3@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ Str::limit(strip_tags($selectedItem->text), $limit = 150, $end = '...') }}</div>
                        </div>
                        <a href="{{ route('index.banner', $selectedItem->link) }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Новинки</h2>
                    <div class="products-slider">
                        @foreach($new_products as $new_product)
                            @php
                                $selected_variation = $new_product->product_variations->first();
                            @endphp
                            <div class="products-slider__item">
                                <div class="product">
                                    <div class="product__top">
                                        <div class="product__image">
                                            <div class="product__labels">
                                                <div class="product__label product__label--brown">-50%</div>
                                                @if($new_product->show_in_popular)
                                                    <div class="product__label product__label--green">Хит продаж</div>
                                                @endif
                                            </div>
                                            <a href="/p/{{$new_product->alias}}{{$selected_variation !== null?'/'.$selected_variation->id:''}}"><img src="{{asset('images/uploads/products/'.$new_product->image)}}" alt=""></a>
                                            <button class="product__fav product_favourite" data-label=@if($new_product->is_favourite && \App\Services\FavoriteProductsService::checkByIdForAnonym($new_product->id)) "1" @else "0" @endif data-value="{{$new_product->id}}"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
                                        </div>
                                        <div class="product__title"><a href="">{{$new_product->brand->name}}</a></div>
                                        <div class="product__subtitle">{{$new_product->title}}</div>
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
                                                    <div class="product__price">{{$new_product->discount_price??$new_product->price}} ₽</div>
                                                    @isset($new_product->discount_price)
                                                        <del class="product__oldprice">{{$new_product->price}} ₽</del>
                                                    @endisset
                                                @endif
                                            </div>
                                            <button class="product__mobile-btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg></button>
                                        </div>
                                        <div class="product__sizesinfo">Еще два размера</div>


                                        <div class="product__pnl">
                                            <div class="product__optionsblock">
                                                <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                                <div class="product__options product__colors">
                                                    <label class="color">
                                                        <input type="radio" name="color"  checked/>
                                                        <div class="color__text" style="background-color: #880B0B"></div>
                                                    </label>
                                                    <label class="color">
                                                        <input type="radio" name="color" />
                                                        <div class="color__text" style="background-color: #188299"></div>
                                                    </label>
                                                    <label class="color">
                                                        <input type="radio" name="color" />
                                                        <div class="color__text" style="background-color: #AE3A80"></div>
                                                    </label>
                                                    <label class="color">
                                                        <input type="radio" name="color" />
                                                        <div class="color__text" style="background-color: #99CB47"></div>
                                                    </label>
                                                </div>
                                            </div>
                                            <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="videoblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="videoblock__wrapper">
                        <h2 class="videoblock__title">Мастер-класс от&nbsp;эксперта</h2>
                        <p>Приобретите косметические продукты на сумму свыше 7000 рублей и получите доступ к эксклюзивному видео-мастер-классу от известного визажиста!</p>
                        <p>Узнайте секреты профессионалов и научитесь создавать неповторимые образы с помощью наших качественных средств. Ваша красота – в ваших руках!</p>
                    </div>

                </div>
            </div>
        </div>
        <a href="https://www.youtube.com/watch?v=m-4XcLUMYQ4" class="videoblock__video popup-youtube" style="background-image: url(images/dist/video-cover.jpg);"></a>
    </section>
    <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Популярные</h2>
                    <div class="products-slider">
                        @foreach($new_products as $new_product)
                            @php
                                $selected_variation = $new_product->product_variations->first();
                            @endphp
                            <div class="products-slider__item">
                                <div class="product">
                                    <div class="product__top">
                                        <div class="product__image">
                                            <div class="product__labels">
                                                <div class="product__label product__label--brown">-50%</div>
                                                @if($new_product->show_in_popular)
                                                    <div class="product__label product__label--green">Хит продаж</div>
                                                @endif
                                            </div>
                                            <a href="/p/{{$new_product->alias}}{{$selected_variation !== null?'/'.$selected_variation->id:''}}"><img src="{{asset('images/uploads/products/'.$new_product->image)}}" alt=""></a>
                                            <button class="product__fav product_favourite" data-label=@if($new_product->is_favourite && \App\Services\FavoriteProductsService::checkByIdForAnonym($new_product->id)) "1" @else "0" @endif data-value="{{$new_product->id}}"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
                                        </div>
                                        <div class="product__title"><a href="">{{$new_product->brand->name}}</a></div>
                                        <div class="product__subtitle">{{$new_product->title}}</div>
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
                                                    <div class="product__price">{{$new_product->discount_price??$new_product->price}} ₽</div>
                                                    @isset($new_product->discount_price)
                                                        <del class="product__oldprice">{{$new_product->price}} ₽</del>
                                                    @endisset
                                                @endif
                                            </div>
                                            <button class="product__mobile-btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg></button>
                                        </div>
                                        <div class="product__sizesinfo">Еще два размера</div>


                                        <div class="product__pnl">
                                            <div class="product__optionsblock">
                                                <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                                <div class="product__options product__colors">
                                                    <label class="color">
                                                        <input type="radio" name="color"  checked/>
                                                        <div class="color__text" style="background-color: #880B0B"></div>
                                                    </label>
                                                    <label class="color">
                                                        <input type="radio" name="color" />
                                                        <div class="color__text" style="background-color: #188299"></div>
                                                    </label>
                                                    <label class="color">
                                                        <input type="radio" name="color" />
                                                        <div class="color__text" style="background-color: #AE3A80"></div>
                                                    </label>
                                                    <label class="color">
                                                        <input type="radio" name="color" />
                                                        <div class="color__text" style="background-color: #99CB47"></div>
                                                    </label>
                                                </div>
                                            </div>
                                            <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="maincategory">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="maincategory__grid">
                        @if(isset($positionIds['fourth'][0]) && $selectedItem = $item->find($positionIds['fourth'][0]))
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                                <div class="category__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                                <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                            </div>
                        </div>
                        @endif
                        @if(isset($positionIds['fourth'][1]) && $selectedItem = $item->find($positionIds['fourth'][1]))
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                                <div class="category__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                                <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                            </div>
                        </div>
                        @endif
                        @if(isset($positionIds['fourth'][2]) && $selectedItem = $item->find($positionIds['fourth'][2]))
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                                <div class="category__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                                <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                            </div>
                        </div>
                        @endif
                        @if(isset($positionIds['fourth'][3]) && $selectedItem = $item->find($positionIds['fourth'][3]))
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                                <div class="category__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                                <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Товары со скидкой</h2>
                    <div class="products-slider">
                        @foreach($product_discounts  as $product)
                            @php
                                $selected_variation = $product->product_variations->whereNotNull('discount_price')->first();
                            @endphp
                            <div class="products-slider__item">
                                <div class="product">
                                    <div class="product__top">
                                        <div class="product__image">
                                            <div class="product__labels">
                                                <div class="product__label product__label--brown">-50%</div>
                                                @if($product->show_in_popular)
                                                    <div class="product__label product__label--green">Хит продаж</div>
                                                @endif
                                            </div>
                                            <a href="/p/{{$product->alias}}{{$selected_variation !== null?'/'.$selected_variation->id:''}}"><img src="{{asset('images/uploads/products/'.$product->image)}}" alt=""></a>
                                            <button class="product__fav product_favourite" data-label=@if($product->is_favourite && \App\Services\FavoriteProductsService::checkByIdForAnonym($product->id)) "1" @else "0" @endif data-value="{{$product->id}}"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
                                        </div>
                                        <div class="product__title"><a href="">{{$product->brand->name}}</a></div>
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
                                            <div class="product__optionsblock">
                                                <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                                <div class="product__options product__colors">
                                                    <label class="color">
                                                        <input type="radio" name="color"  checked/>
                                                        <div class="color__text" style="background-color: #880B0B"></div>
                                                    </label>
                                                    <label class="color">
                                                        <input type="radio" name="color" />
                                                        <div class="color__text" style="background-color: #188299"></div>
                                                    </label>
                                                    <label class="color">
                                                        <input type="radio" name="color" />
                                                        <div class="color__text" style="background-color: #AE3A80"></div>
                                                    </label>
                                                    <label class="color">
                                                        <input type="radio" name="color" />
                                                        <div class="color__text" style="background-color: #99CB47"></div>
                                                    </label>
                                                </div>
                                            </div>
                                            <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="maincategory maincategory--threecol">
        <div class="container">
            <div class="row">
                @if(isset($positionIds['fifth'][0]) && $selectedItem = $item->find($positionIds['fifth'][0]))
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="category">
                        <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                        <div class="category__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                        <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['fifth'][1]) && $selectedItem = $item->find($positionIds['fifth'][1]))
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="category">
                        <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                        <div class="category__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                        <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['fifth'][2]) && $selectedItem = $item->find($positionIds['fifth'][2]))
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="category">
                        <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                        <div class="category__title"><a href="{{ route('index.banner', $selectedItem->link) }}">{{ $selectedItem->title }}</a></div>
                        <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <section class="newsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Новости</h2>
                </div>
                <div class="newsblock__container">
                @foreach (\App\Services\NewsService::getNews() as $item)
                    <div class="article article--news">
                        <div class="article__image"><a href="{{ route('index.news', $item->link) }}"><img src="{{asset('images/uploads/news/' . $item->image)}}" alt=""></a></div>
                        <div class="article__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg>{{ \Carbon\Carbon::parse($item->published_at)->locale('ru')->isoFormat('D.MMMM.YYYY') }}</div>
                        <div class="article__title"><a href="{{ route('index.news', $item->link) }}">{{ $item->title }}</a></div>
                        <div class="article__intro">{{ Str::limit(strip_tags($item->text), $limit = 90, $end = '...') }}</div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="mailing">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="" class="mailing__form">
                        <div class="mailing__left">
                            <h2 class="mailing__title">Подписаться на&nbsp;рассылку</h2>
                            <div class="mailing__subtitle">Узнавайте первыми о новых поступлениях, акциях и мероприятиях в магазине</div>
                        </div>
                        <div class="mailing__right">
                            <input type="text" class="mailing__input" placeholder="Введите ваш e-mail">
                            <button class="mailing__button"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#circle-arrow')}}"></use></svg></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Бренды</h2>
                    <div class="brands-slider">
                        @foreach(\App\Models\Brand::query()->selectRaw('brands.*')->get() as $item)
                            <div class="brands-slider__item">
                                <a href="{{ route('brands.show', ['link' => strtolower($item->link)]) }}">
                                    <div class="brand">
                                        <img src="{{ asset('images/uploads/brands/' . $item->image) }}" alt="">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('after_content')
    <div class="filters-overlay"></div>
    <div class="hidden">
        <!-- <form action="" class="form" id="callback">
            <h3>Оставить сообщение</h3>

            <input type="text"  name="Имя" placeholder="Ваше имя"  required="required">
            <input type="text"  name="Телефон" placeholder="Номер телефона" required="required">
            <input type="text"  name="E-mail" placeholder="E-mail" required="required">
            <textarea name="Сообщение" placeholder="Сообщение"></textarea>
            <button class="btn btn-feed">Отправить</button>
        </form> -->
        @include('layouts.includes.purchase_modal')
    </div>
    <div class="done-w">
        <div class="done-window">
            <div class="done-window__icn"></div>
            <div class="done-window__title">Ваша заявка принята</div>
            <div class="done-window__subtitle">Наш менеджер свяжется с Вами в течении 15 минут</div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/favourites.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('button.product__addcart').on('click', function () {
                $.magnificPopup.open({
                    items: {
                        src: '#addproduct',
                        type: 'inline'
                    }
                });
            })
        })
    </script>
@endsection



