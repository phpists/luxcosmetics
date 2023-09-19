@extends('layouts.app')
@section('title', $product->title)
@section('description', $product->description_meta ?? '')
@section('keywords', $product->keywords_meta ?? '')
@section('og:title', $product->og_title_meta ?? '')
@section('og:description', $product->og_description_meta ?? '')
@section('og:url', request()->url())

@section('content')
    <style>
        .like_btn.checked {
            color: #cc9755;
        }

        .typography > h3 {
            margin-top: 20px;
        }
    </style>
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="{{ route('home') }}">Главная</a></li>
                        @include('categories.parts.parent_category', ['category' => $product->category])
                        <li class="crumbs__item"><a href="{{ route('categories.show', ['alias' => $product->category->alias]) }}">
                                {{ $product->category->name }}</a></li>
                        <li class="crumbs__item">{{ $product->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="product-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="for-mobile">
                        <div class="product-page__article">Артикул: {{$product->code}}</div>
                        <div class="product-page__title">{{$product->brand?->name}}</div>
                        <div class="product-page__subtitle">{{$product->title}}</div>
                        <div class="product-page__reviewsblock">
                            <div class="product-page__reviews">
                                <div class="stars">
                                    <span class="stars__item is-active"><svg class="icon"><use
                                                xlink:href="{{asset('/images/dist/sprite.svg#star')}}"></use></svg></span>
                                    <span class="stars__item is-active"><svg class="icon"><use
                                                xlink:href="{{asset('/images/dist/sprite.svg#star')}}"></use></svg></span>
                                    <span class="stars__item is-active"><svg class="icon"><use
                                                xlink:href="{{asset('/images/dist/sprite.svg#star')}}"></use></svg></span>
                                    <span class="stars__item"><svg class="icon"><use
                                                xlink:href="{{asset('/images/dist/sprite.svg#star')}}"></use></svg></span>
                                    <span class="stars__item"><svg class="icon"><use
                                                xlink:href="{{asset('/images/dist/sprite.svg#star')}}"></use></svg></span>
                                </div>
                                <a href="#reviews" class="reviews-link">отзывы ({{$countComments}})</a>
                            </div>
                            <div class="product-page__available">
                                <svg class="icon">
                                    @if(\App\Enums\AvailableOptions::AVAILABLE->value === $product->availability)
                                        <use xlink:href="{{asset('images/dist/sprite.svg#check')}}"></use>
                                    @else
                                        <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
                                    @endif
                                </svg>
                                {{\App\Services\SiteService::getProductStatus($product->availability)}}</div>
                        </div>
                    </div>
                    @php
                        $images = $product->getImages();
                    @endphp
                    <div class="product-page__galleryblock">
                        <div class="product-page__gallery">
                            <div class="gallery" id="product_gallery">
                                @foreach($images as $image)
                                    <div class="gallery__item"><a
                                            href="{{asset('images/uploads/products/'.$image->path)}}"><img
                                                src="{{asset('images/uploads/products/'.$image->path)}}" alt=""></a>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="product-page__gallerythumb">
                            <button class="btn-gallery btn-gallery__up" id="gallery-up">
                                <svg class="icon">
                                    <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                                </svg>
                            </button>
                            <div class="gallerythumb">
                                @foreach($images as $image)
                                    <div class="gallerythumb__item"><img
                                            src="{{asset('images/uploads/products/'.$image->path)}}" alt=""></div>
                                @endforeach
                            </div>
                            <button class="btn-gallery btn-gallery__down" id="gallery-down">
                                <svg class="icon">
                                    <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="for-desktop">
                        <div class="product-page__article">Артикул: {{$product->code}}</div>
                        <div class="product-page__title">{{$product->brand?->name}}</div>
                        <div class="product-page__subtitle">{{$product->title}}</div>
                        <div class="product-page__reviewsblock">
                            <div class="product-page__reviews">
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
                                <a href="#reviews" class="reviews-link">отзывы ({{$countComments}})</a>
                            </div>
                            <div class="product-page__available">
                                <svg class="icon">
                                    @if(\App\Enums\AvailableOptions::AVAILABLE->value === $product->availability)
                                        <use xlink:href="{{asset('images/dist/sprite.svg#check')}}"></use>
                                    @else
                                        <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
                                    @endif
                                </svg>
                                {{\App\Services\SiteService::getProductStatus($product->availability)}}</div>
                        </div>
                    </div>

                    @php($product_variations->push($product))
                    @if(isset($product->baseProperty->id))
                        @if($product_variations->count() > 1)
                            @if($product->baseProperty->id === \App\Models\Product::TYPE_VOLUME)
                                <div class="product-page__options">
                                    <div class="product-page__options-title">
                                        Выбранный {{ mb_strtolower($product->baseProperty->name) }}:
                                        <b>{{ ($product->baseValue->value ?? '') . ($product->baseProperty->measure ?? '') }}</b>
                                    </div>
                                    @foreach($product_variations->sortBy('baseValue.value') as $product_variation)
                                        <label class="volume"
                                               onclick="window.location.href = '{{ route('products.product', ['alias' => $product_variation->alias]) }}'">
                                            <input class="variation__select" type="radio"
                                                   value="{{$product_variation->alias}}"
                                                   name="volume" @checked($product->id === $product_variation->id)/>
                                            <div class="volume__text">
                                                <b>{{ ($product_variation->baseValue->value ?? '') . ($product_variation->baseProperty->measure ?? '') }}</b>
                                                {{ $product_variation->price }} ₽
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            @elseif($product->baseProperty->id === \App\Models\Product::TYPE_COLOR)
                                <div class="product-page__options">
                                    <div class="product-page__options-title">
                                        Выбранный {{ mb_strtolower($product->baseProperty->name) }}:
                                        <b>{{ ($product->baseValue->value ?? '') . ($product->baseProperty->measure ?? '') }}</b>
                                    </div>
                                    @foreach($product_variations->sortBy('baseValue.value') as $product_variation)
                                        <label class="color"
                                               onclick="window.location.href = '{{ route('products.product', ['alias' => $product_variation->alias]) }}'">
                                            <input type="radio"
                                                   name="color" @checked($product->id === $product_variation->id)/>
                                            <div class="color__text"
                                                 style="background-color: {{ $product_variation->baseValue->color ?? '' }}"></div>
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    @endif

                    <div class="product-page__priceblock" @if($product->availability == \App\Enums\AvailableOptions::NOT_AVAILABLE->value) style="opacity: 0.4" @endif>
                        <div class="product-page__prices">
                            <div class="product-page__price">{{ $product->price }} ₽</div>
                            @isset($product->old_price)
                                <del class="product-page__oldprice">{{ $product->old_price }} ₽</del>
                            @endisset
                        </div>
                        @if($product->availability == \App\Enums\AvailableOptions::AVAILABLE->value)
                            @if($product->hasBonuses())
                            <div class="product-page__points">
                                <svg class="icon">
                                    <use xlink:href="{{asset('images/dist/sprite.svg#warning')}}"></use>
                                </svg>
                                <span> Заработайте {{ $product->points }} баллов</span>
                            </div>
                            @endif
                        @endif
                    </div>
                    @if($product->availability == \App\Enums\AvailableOptions::AVAILABLE->value)
                        <button class="btn btn--accent product-page__addcart addToCart @if(isset($product->baseValue->id)) @if($cartService->check($product->id, $product->baseValue->id)) isInCart @endif @endif" data-product="{{ $product->id }}" data-property="{{ $product->baseValue->id ?? '' }}">
                            <span>
                            <svg class="icon">
                                <use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use>
                            </svg>
                            Добавить в корзину
                            </span>
                        </button>
                    @endif
                    <div class="product-page__deliveryinfo">
                        <p>Доставка в тот же день: заказ до 13:00 в Москве и <a href="">других городах.</a></p>
                        <p>Бесплатная экспресс-доставка для всех заказов на сумму свыше 10 000 ₽ </p>
                    </div>
                    @if(sizeof($articles) > 0)
                        <div class="product-page__actions">
                            @foreach($articles->sortBy('position') as $article)
                                <div class="product-page__action productaction">
                                    @if($article->image)
                                    <div class="productaction__image">
                                        <a href="{{ $article->link }}">
                                            <img src="{{ $article->getImageSrcAttribute() }}" alt="" style="width: 40px; height: 40px">
                                        </a>
                                    </div>
                                    @endif
                                    <div class="productaction__wrap">
                                        <div class="productaction__title">
                                            <a href="{{ $article->link }}">{{ $article->title }}</a>
                                        </div>
                                        <div class="productaction__intro">{{ strip_tags(\Illuminate\Support\Str::limit($article->description)) }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="product-page__description">
                        <div class="accordeon product-page__accordeon typography">
                            <dl>
                                <dt class="active">Информация о продукте
                                    <svg class="icon">
                                        <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                                    </svg>
                                </dt>
                                <dd>
                                    <div class="typography">
                                        <h3>Описание товара</h3>
                                        {!! $product->description_1 !!}
                                    </div>
                                    <div class="typography">
                                        <h3>Способ применения</h3>
                                        {!! $product->description_2 !!}
                                        @if($product->description_3)
                                            <h3>Состав/комплектация продукта</h3>
                                            {!! $product->description_3 !!}
                                        @endif
                                        @if($product->description_4)
                                            <h3>Меры предосторожности</h3>
                                            {!! $product->description_4 !!}
                                        @endif
                                    </div>
                                </dd>
                            </dl>
                            <dl>
                                <dt>Характеристики</dt>
                                <dd style="display: none;">
                                    @forelse($product->values as $value)
                                        @if($value->property->show_in_product)
                                            <p style="padding: 0 15px">{{ $value->property->name ?? 'UNDEFINED' }}: <b
                                                    style="font-weight: bolder">{{ $value->value . ' ' . $value->property->measure }}</b>
                                            </p>
                                            <hr>
                                        @endif
                                    @empty
                                        <h4>Нету характеристик</h4>
                                    @endforelse
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-tabs">
        @if($product->brand->hide !== 'on')
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-tabs__header">
                        <h2 class="title-h2">Рейтинги и обзоры</h2>
                        <div class="product-tabs__rating">
                            {{ number_format($averageRating, 1) }}
                            <div class="starsrating">
                                <div class="starsrating__span" style="width: {{$averageRating * 20}}%"></div>
                            </div>
{{--                            <div class="stars">--}}
{{--                                @for ($i = 1; $i <= 5; $i++)--}}
{{--                                    @if ($i <= round($averageRating))--}}
{{--                                        <span class="stars__item is-active">--}}
{{--                                            <svg class="icon"><use xlink:href="{{ asset('images/dist/sprite.svg#star') }}"></use></svg>--}}
{{--                                        </span>--}}
{{--                                    @else--}}
{{--                                        <span class="stars__item">--}}
{{--                                            <svg class="icon"><use xlink:href="{{ asset('images/dist/sprite.svg#star') }}"></use></svg>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
{{--                                @endfor--}}
{{--                            </div>--}}

                        </div>
                        {{--                        <div class="product-tabs__info">58 отзывов, 4 вопроса и ответа</div>--}}
{{--                        <div class="product-tabs__results">--}}
{{--                            <div class="product-tabs__result reviewresult">--}}
{{--                                <div class="reviewresult__title">Долголетие</div>--}}
{{--                                <div class="reviewresult__spans">--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span"></span>--}}
{{--                                    <span class="reviewresult__span"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="product-tabs__result reviewresult">--}}
{{--                                <div class="reviewresult__title">Силос(ароматный след)</div>--}}
{{--                                <div class="reviewresult__spans">--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span"></span>--}}
{{--                                    <span class="reviewresult__span"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="product-tabs__result reviewresult">--}}
{{--                                <div class="reviewresult__title">Поглощение</div>--}}
{{--                                <div class="reviewresult__spans">--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                    <span class="reviewresult__span is-active"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="product-tabs__btns">
                            <button class="product-tabs__btn" id="new-review">Написать отзыв</button>
                            <button class="product-tabs__btn" id="new-ask">Задать вопрос</button>
                        </div>
                    </div>

                    <div class="product-tabs__forms">
                        <form action="{{route('send.comment')}}" class="product-tabs__form form" id="newreview-form" method="post">
                            @csrf
                            <input type="hidden" id='product_id' name="product_id" value="{{ $product->id }}">
                            <div class="form__title">Написать отзыв</div>
                            <div class="form__fieldset">
                                <legend class="form__label">Рейтинг</legend>
                                <div class="form__rating ">
                                    <div class="rating-area">
                                        <input type="radio" id="star-5" name="rating" value="5" required>
                                        <label for="star-5" title="Оценка «5»">
                                            <svg>
                                                <use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use>
                                            </svg>
                                        </label>
                                        <input type="radio" id="star-4" name="rating" value="4">
                                        <label for="star-4" title="Оценка «4»">
                                            <svg>
                                                <use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use>
                                            </svg>
                                        </label>
                                        <input type="radio" id="star-3" name="rating" value="3">
                                        <label for="star-3" title="Оценка «3»">
                                            <svg>
                                                <use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use>
                                            </svg>
                                        </label>
                                        <input type="radio" id="star-2" name="rating" value="2">
                                        <label for="star-2" title="Оценка «2»">
                                            <svg>
                                                <use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use>
                                            </svg>
                                        </label>
                                        <input type="radio" id="star-1" name="rating" value="1">
                                        <label for="star-1" title="Оценка «1»">
                                            <svg>
                                                <use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use>
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form__fieldset">
                                <legend class="form__label">Текст отзыва</legend>
                                <textarea class="form__textarea" name="description" required></textarea>
                            </div>
{{--                            <div class="form__fieldset">--}}
{{--                                <legend class="form__label">Как быстро он усваивается?</legend>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_1"/>--}}
{{--                                    <div class="radio__text">Совсем не быстро</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_1"/>--}}
{{--                                    <div class="radio__text">Не так быстро</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_1"/>--}}
{{--                                    <div class="radio__text">Несколько быстро</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_1"/>--}}
{{--                                    <div class="radio__text">Быстрый</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_1"/>--}}
{{--                                    <div class="radio__text">Сверх быстрый</div>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="form__fieldset">--}}
{{--                                <legend class="form__label">Как долго он держится на коже и/или волосах?</legend>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_2"/>--}}
{{--                                    <div class="radio__text">2 часа или меньше</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_2"/>--}}
{{--                                    <div class="radio__text">3 - 4 часа</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_2"/>--}}
{{--                                    <div class="radio__text">5 - 6 часов</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_2"/>--}}
{{--                                    <div class="radio__text">7 - 8 часов</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_2"/>--}}
{{--                                    <div class="radio__text">Долгоиграющий; 12+ часов</div>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="form__fieldset">--}}
{{--                                <legend class="form__label">Как вы оцениваете проекцию или силос (ароматный шлейф,--}}
{{--                                    возникающий в результате движения)?--}}
{{--                                </legend>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_3"/>--}}
{{--                                    <div class="radio__text">Слабый</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_3"/>--}}
{{--                                    <div class="radio__text">Мягкий</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_3"/>--}}
{{--                                    <div class="radio__text">Умеренный</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_3"/>--}}
{{--                                    <div class="radio__text">Сильный</div>--}}
{{--                                </label>--}}
{{--                                <label class="radio">--}}
{{--                                    <input type="radio" name="radio_3"/>--}}
{{--                                    <div class="radio__text">Очень сильный</div>--}}
{{--                                </label>--}}
{{--                            </div>--}}
                            <div class="form__row">
                            @auth()
                                    <div class="form__col form__col--50">
                                        <div class="form__fieldset">
                                            <legend class="form__label">Ваше имя</legend>
                                            <input type="text" class="form__input" name="name" value="{{ auth()->user()->name }}" required>
                                        </div>
                                    </div>
                                    <div class="form__col form__col--50">
                                        <div class="form__fieldset">
                                            <legend class="form__label">Электронная почта: {{ auth()->user()->email }}</legend>
                                            <input type="email" class="form__input" name="email" value="{{ auth()->user()->email }}" required>
                                        </div>
                                    </div>
                            @endauth
                                @guest()
                                    <div class="form__col form__col--50">
                                        <div class="form__fieldset">
                                            <legend class="form__label">Ваше имя</legend>
                                            <input type="text" class="form__input" name="name" required>
                                        </div>
                                    </div>
                                    <div class="form__col form__col--50">
                                        <div class="form__fieldset">
                                            <legend class="form__label">Электронная почта</legend>
                                            <input type="email" class="form__input" name="email" required>
                                        </div>
                                    </div>
                                @endguest
                            </div>
                            <button class="btn btn--accent">Отправить</button>
                            <div class="product-tabs__formclose">Закрыть</div>
                        </form>
                        <form action="{{route('product_question.create')}}" class="product-tabs__form form" id="newask-form" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                            <div class="form__title">Задать вопрос</div>
                            <div class="form__fieldset">
                                <legend class="form__label">Ваш вопрос</legend>
                                <textarea name="message" required class="form__textarea"></textarea>
                            </div>
                            <div class="form__row">
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Ваше имя</legend>
                                        <input type="text" name="username" class="form__input" required value="{{$user? ($user->name." ".$user->surname): null}}" @if($user) readonly @endif>
                                    </div>
                                </div>
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Электронная почта</legend>
                                        <input type="email" name="email" class="form__input" required value="{{$user?->email}}" @if($user) readonly @endif>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn--accent">Отправить</button>
                            <div class="product-tabs__formclose">Закрыть</div>
                        </form>

                    </div>
                    <div class="product-tabs__tabsheader tabs" id="reviews">
                        <div class="product-tabs__tab tab">Отзывы</div>
                        <div class="product-tabs__tab tab active">Вопросы</div>
                    </div>

                    <div class="product-tabs__tabscontent">
                        <div class="product-tabs__tabsitem">
                            <div class="product-tabs__filters">
                                {{--                                <h4 class="reviewsfilters__title">Фильтр отзывов</h4>--}}
                                {{--                                <form action="" class="reviewsfilters__search search">--}}
                                {{--                                    <input type="text" class="search__input" placeholder="Поиск отзывов">--}}
                                {{--                                    <button class="search__btn">--}}
                                {{--                                        <svg class="icon">--}}
                                {{--                                            <use xlink:href="{{asset('images/dist/sprite.svg#search')}}"></use>--}}
                                {{--                                        </svg>--}}
                                {{--                                    </button>--}}
                                {{--                                </form>--}}
                                {{--                                <div class="reviewsfilters__selects">--}}
                                {{--                                    <div class="reviewsfilters__select">--}}
                                {{--                                        <select name="" class="selectCustom">--}}
                                {{--                                            <option value="">Рейтинг</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="reviewsfilters__select">--}}
                                {{--                                        <select name="" class="selectCustom">--}}
                                {{--                                            <option value="">Изображения и видео</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="reviewsfilters__select">--}}
                                {{--                                        <select name="" class="selectCustom">--}}
                                {{--                                            <option value="">Поглощение</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="reviewsfilters__select">--}}
                                {{--                                        <select name="" class="selectCustom">--}}
                                {{--                                            <option value="">Долголетие</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="reviewsfilters__select">--}}
                                {{--                                        <select name="" class="selectCustom">--}}
                                {{--                                            <option value="">Силос</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                            </div>
                            <div id="commentsBlock" class="product-tabs__sortblock sortblock">
                                <div class="sortblock__total">отзывы ({{$countComments}})</div>
                                <div class="sortblock__sort sort">
                                    <span class="sort__title">Сортировать по</span>
                                    <select name="sort_option" id="sort_option" class="sort__select">
                                        <option value="newest">Самые новые</option>
                                        <option value="oldest">Самые старые</option>
                                        <option value="highest_rating">Самыый высокий рейтинг</option>
                                        <option value="down_rating">Самые низкий рейтинг</option>
                                    </select>
                                </div>
                            </div>
                            <div class="product-tabs__reviews comment-container" id="comment-container">
                                @include('products.product_comments', compact('comments'))
                            </div>
                            @if($has_more_comments)
                                <div class="pagination" id="pagination_comment" aria-disabled="{{$has_more_comments? "false": "true"}}">
                                    <input type="hidden" id="comment_page" value="2">
                                    <button class="pagination__more" id="show_more_comments">Показать еще <span>{{\App\Models\Comments::ITEMS_PER_PAGE}} отзыва</span>
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use>
                                        </svg>
                                    </button>
                                    {{--                                <ul class="pagination__list">--}}
                                    {{--                                    <li class="pagination__item pagination__item--first"><a href="">--}}
                                    {{--                                            <svg class="icon">--}}
                                    {{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--prev"><a href="">--}}
                                    {{--                                            <svg class="icon">--}}
                                    {{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--active"><span>1</span></li>--}}
                                    {{--                                    <li class="pagination__item"><a href="">2</a></li>--}}
                                    {{--                                    <li class="pagination__item"><a href="">3</a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--dots">...</li>--}}
                                    {{--                                    <li class="pagination__item"><a href="">36</a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--next"><a href="">--}}
                                    {{--                                            <svg class="icon">--}}
                                    {{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--last"><a href="">--}}
                                    {{--                                            <svg class="icon">--}}
                                    {{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </a></li>--}}
                                    {{--                                </ul>--}}
                                </div>
                            @endif
                        </div>
                        <div class="product-tabs__tabsitem">
                            <div class="product-tabs__asks" id="ask_wrapper">
                                @include('products.product_questions', compact('questions'))
                            </div>
                            @if($has_more_questions)
                                <div class="pagination" id="pagination_question" aria-disabled="{{$has_more_questions? "false": "true"}}">
                                    <input type="hidden" id="question_page" value="2">
                                    <button class="pagination__more" id="show_more_questions">Показать еще <span>{{\App\Models\ProductQuestion::ITEMS_PER_PAGE}} отзыва</span>
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use>
                                        </svg>
                                    </button>
                                    {{--                                <ul class="pagination__list">--}}
                                    {{--                                    <li class="pagination__item pagination__item--first"><a href="">--}}
                                    {{--                                            <svg class="icon">--}}
                                    {{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--prev"><a href="">--}}
                                    {{--                                            <svg class="icon">--}}
                                    {{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--active"><span>1</span></li>--}}
                                    {{--                                    <li class="pagination__item"><a href="">2</a></li>--}}
                                    {{--                                    <li class="pagination__item"><a href="">3</a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--dots">...</li>--}}
                                    {{--                                    <li class="pagination__item"><a href="">36</a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--next"><a href="">--}}
                                    {{--                                            <svg class="icon">--}}
                                    {{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </a></li>--}}
                                    {{--                                    <li class="pagination__item pagination__item--last"><a href="">--}}
                                    {{--                                            <svg class="icon">--}}
                                    {{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </a></li>--}}
                                    {{--                                </ul>--}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            @endif
    </section>
    <section class="products-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper">
                        <div class="tabs">
                            @if(sizeof($relative_products->where('relation_type', \App\Models\RelatedProduct::SUPPORT_ITEMS)) > 0)
                                <span class="tab">Выбрано для вас</span>
                            @endif
                            @if(sizeof($relative_products->where('relation_type', \App\Models\RelatedProduct::SIMILAR_ITEMS)) > 0)
                                <span class="tab">Вам также может понравиться</span>
                            @endif
                            @if(sizeof($random_products) > 0)
                                <span class="tab">Клиенты также просмотрели</span>
                            @endif
                        </div>
                        <div class="tab_content">
                            @if(sizeof($relative_products->where('relation_type', \App\Models\RelatedProduct::SUPPORT_ITEMS)) > 0)
                                <div class="tab_item">
                                    <div class="otherproducts-slider">
                                        @foreach($relative_products->where('relation_type', \App\Models\RelatedProduct::SUPPORT_ITEMS) as $rel_product)
                                            <div class="products-slider__item">
                                                @include('products._card', ['product' => $rel_product])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(sizeof($relative_products->where('relation_type', \App\Models\RelatedProduct::SIMILAR_ITEMS)) > 0)
                                <div class="tab_item">
                                    <div class="otherproducts-slider">
                                        @foreach($relative_products->where('relation_type', \App\Models\RelatedProduct::SIMILAR_ITEMS) as $rel_product)
                                            <div class="products-slider__item">
                                                @include('products._card', ['product' => $rel_product])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(sizeof($random_products) > 0)
                                <div class="tab_item">
                                    <div class="otherproducts-slider">
                                        @foreach($random_products as $related_product)
                                            <div class="products-slider__item">
                                                @include('products._card', ['product' => $related_product])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
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
        document.querySelectorAll('.variation__select').forEach(function (el) {
            el.addEventListener('change', function () {
                window.location = '/p/' + el.value;
                {{--fetch('/p/'+el.value, {--}}
                {{--    method: 'GET',--}}
                {{--    headers: {--}}
                {{--        'credentials': 'same-origin',--}}
                {{--        'X-Requested-With': 'XMLHttpRequest',--}}
                {{--        'Content-Type': 'application/json'--}}
                {{--    },--}}
                {{--}).then(async (resp) => {--}}
                {{--    let data = await resp.json();--}}
                {{--    let images = '';--}}
                {{--    for (const id in data['images']) {--}}
                {{--        images += '<div class="gallerythumb__item"><img src="{{asset('images/uploads/products/')}}/'+data['images'][id]['image_path']+'" alt=""></div>';--}}
                {{--    }--}}
                {{--    console.log(images)--}}
                {{--    document.getElementById('product_gallery').innerHTML = images;--}}

                {{--})--}}
            })
        })
        function likeEventStarter() {
            $('.like_btn.like_init').each(function (idx, el) {
                el.classList.remove('like_init');
                el.addEventListener('click', (ev) => {
                    handleLike(ev.currentTarget)
                })
            })
        }
        likeEventStarter();
        $(document).on('click', '#show_more_questions', function () {
            let is_disabled = $('#pagination_question').attr('aria-disabled')
            let question_page = $('#question_page').val();
            if(is_disabled === 'false') {
                $.ajax({
                    url: '/load_questions',
                    data: {
                        load_more: true,
                        page: question_page,
                        product_id: $('#product_id').val()
                    },
                    success: function (response) {
                        $('#ask_wrapper').append(response.htmlBody);
                        $('#question_page').val(question_page + 1);
                        let hasMore = response.hasMore? "false": "true";
                        $('#pagination_question').attr('aria-disabled', hasMore);
                        if (!response.hasMore) {
                            $('#pagination_question').hide();
                        }
                        likeEventStarter();
                    },
                    error: function (response) {
                        console.log(response)
                    }
                })
            }
        })

        $(document).on('click', '#show_more_comments', function () {
            let is_disabled = $('#pagination_comment').attr('aria-disabled')
            let comment_page = $('#comment_page').val();
            if(is_disabled === 'false') {
                $.ajax({
                    url: '/load_comments',
                    data: {
                        load_more: true,
                        page: comment_page,
                        product_id: $('#product_id').val()
                    },
                    success: function (response) {
                        console.log(response)
                        $('#comment-container').append(response.htmlBody);
                        $('#comment_page').val(comment_page + 1);
                        let hasMore = response.hasMore? "false": "true";
                        $('#pagination_comment').attr('aria-disabled', hasMore);
                        if (!response.hasMore) {
                            $('#pagination_comment').hide();
                        }
                        likeEventStarter();
                    },
                    error: function (response) {
                        console.log(response)
                    }
                })
            }
        })

        function handleLike(button) {
            var recordId = button.getAttribute('data-id');
            var isLiked = button.getAttribute('data-value') === '1'; // Значение true или false

            $.ajax({
                type: 'POST',
                url: '{{ route('send.like') }}',
                data: {
                    record_id: recordId,
                    isLiked: isLiked ? 1 : 0,
                    _token: '{{ csrf_token() }}',
                    table_name: button.getAttribute('data-table')
                },
                success: function(response) {
                    let prev_count = parseInt(button.children[1].innerText);
                    let dislike_button = button.parentNode.querySelector('button.like_btn.dislike_btn');
                    let like_button = button.parentNode.querySelector('button.like_btn.on_like_btn');
                    dislike_button.children[1].innerText = response.dislike;
                    dislike_button.classList.remove('checked');
                    like_button.children[1].innerText = response.like;
                    like_button.classList.remove('checked');
                    if (prev_count < response.like && isLiked) {
                        button.classList.add('checked');
                    }

                    if (prev_count < response.dislike && !isLiked) {
                        button.classList.add('checked');
                    }
                }
            });
        }
        $(document).ready(function() {
            $('#sort_option').change(function() {
                var selectedOption = $(this).val();
                var alias = '{{ $product->alias }}';
                var url = '/sort_comments/' + alias;

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        sort_option: selectedOption
                    },
                    success: function(response) {
                        $('#comment-container').html(response.comments);
                        likeEventStarter();
                    }
                });
            });
        });
    </script>
@endsection


