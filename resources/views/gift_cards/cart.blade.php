@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <input type="hidden" id="min_sum" value="{{ \App\Services\SiteConfigService::getParamValue('min_checkout_sum') }}">

    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="">Главная</a></li>
                        <li class="crumbs__item">Категория</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="cart-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title-h1">Корзина</h1>
                    <div class="cart-page__container">
                        <main class="cart-page__main">
                            <div class="cart-table">
                                <div class="cart-table__thead">
                                    <div class="cart-table__th cart-table__th--name">Наименование</div>
                                    <div class="cart-table__th cart-table__th--sum">Сумма</div>
                                </div>
                                <div id="cartProductsContainer" class="cart-table__body">
                                        <div class="cart-table__item cart-product">
                                            <div class="swiper-slide">
                                                <div class="giftcard-page__section">
                                                    <div class="giftcard-page__cards">
                                                        <label class="giftcardradio giftcard-page__card">
                                                            <div class="giftcardradio__text" style="background-color: {{ $giftCard->color }}"></div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cart-product__desc">
                                                <div class="cart-product__title">
                                                    <p>Подарочная карта</p>
                                                </div>
                                            </div>
                                            <div class="cart-product__prices">
                                                <div class="cart-product__price">{{ $giftCard->sum }} ₽ </div>
                                            </div>
                                            <a href="{{ route('gift_card.cart.clear') }}" class="cart-product__delete">
                                                <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg>
                                            </a>
                                        </div>
                                </div>
                                    <div class="cart-table__ftr">
                                        <a href="{{ route('gift_card.cart.clear') }}" class="btn btn--border-main cart-page__clearcart">Очистить корзину</a>
                                    </div>
                            </div>



                        </main>
                        <aside class="cart-page__aside">
                            <div class="cart-aside">
                                <div class="cart-aside__total">
                                    <div class="cart-aside__sum">Итого с НДС <span id="totalSum">{{ $giftCard->sum }}</span> ₽</div>
                                </div>
                                <a href="{{ route('gift_card.cart.store') }}" id="submitButton" class="btn btn--accent cart-aside__buy">Оформить заказ</a>
                                <div class="cart-aside__paymethods">
                                    <img src="{{asset('images/dist/ico-visa.png')}}" alt="">
                                    <img src="{{asset('images/dist/ico-mir.png')}}" alt="">
                                    <img src="{{asset('images/dist/ico-youmoney.png')}}" alt="">
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
