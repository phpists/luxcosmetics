@extends('layouts.app')

@section('title', 'Корзина')

@section('content')

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
                    <h1 class="title-h1">Оплатить подарочную карту</h1>
                    <div class="cabinet-page__group">
                        <div class="cart-table">
                            <div class="cart-table__thead">
                                <div class="cart-table__th cart-table__th--name">Наименование</div>
                                <div class="cart-table__th cart-table__th--sum">Стоимость</div>
                            </div>
                            <div class="cart-table__body">

                                <div class="cart-table__item  cart-product cart-product--gift">
                                    <div class="cart-product__image">
                                        <div class="giftcardbox" style="background-color: {{ $giftCard->color }}"></div>
                                    </div>
                                    <div class="cart-product__desc">
                                        <div class="cart-product__title">Подарочная карта на {{ $giftCard->sum }} ₽</div>
                                        <div class="cart-product__subtitle">от: {{ $giftCard->from_whom }}
                                            <br> для: {{ $giftCard->receiver }}</div>
                                    </div>
                                    <div class="cart-product__sum cart-product__sum--free">{{ $giftCard->sum }} ₽</div>
                                </div>
                            </div>
                        </div>
                        <div class="cabinet-page__total">Итого с НДС <b>{{ $giftCard->sum }} ₽</b></div>

                    </div>

                    <h3 class="cart-page__heading subheading subheading--with-form">Выберите способ оплаты</h3>
                    <form action="{{ route('gift_card.cart.store') }}" method="POST" id="orderForm">
                        @csrf
                        {{--                        <div class="cart-page__group">--}}
                        {{--                            <h3 class="cart-page__subheading subheading">Адрес для выставления счета</h3>--}}
                        {{--                            <label class="checkbox">--}}
                        {{--                                <input type="checkbox" name="as_delivery_address" @checked($cartService->getProperty(\App\Services\CartService::AS_DELIVERY_ADDRESS_KEY))/>--}}
                        {{--                                <div class="checkbox__text">Использовать как адрес доставки</div>--}}
                        {{--                            </label>--}}
                        {{--                            <div class="typography addressblock">--}}
                        {{--                                <p>{{ $address->full_name }}</p>--}}
                        {{--                                <p>{{ $address->phone }}</p>--}}
                        {{--                                <p>{{ $address->full_address }}</p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        @if($user_has_cards = auth()->user()->cards->isNotEmpty())
                            <div class="cart-page__addresses">
                                @foreach(auth()->user()->cards as $card)
                                    <div class="cart-page__address my-add">
                                        <div class="my-add__title">{{ $card->full_name }}</div>
                                        <div class="my-add__wrap">
                                            <label class="radio">
                                                <input type="radio" name="card_id" value="{{ $card->id }}" @checked($cartService->getProperty(\App\Services\CartService::CARD_KEY) == $card->id)/>
                                                <div class="radio__text">{{ \App\Services\SiteService::displayCardNumber($card->card_number) }}
                                                    <br>{{ $card->valid_date }}</div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </form>


                    <div class="cart-page__group">
                        <a href="javascript:;" class="cart-page__subheading subheading subheading--with-form toggle-card">Добавить новую карту</a>
                        <div class="toggable" @if($user_has_cards) style="display: none" @endif>
                            @include('layouts.parts.create_payment')
                        </div>
                    </div>
{{--                    <div class="cart-page__group">--}}
{{--                        <form action="" class="form form--box">--}}
{{--                            <div class="form__row">--}}
{{--                                <div class="form__col form__col--50">--}}
{{--                                    <div class="form__fieldset">--}}
{{--                                        <legend class="form__label">Номер карты</legend>--}}
{{--                                        <input type="text" class="form__input">--}}
{{--                                    </div>--}}
{{--                                    <div class="form__fieldset">--}}
{{--                                        <legend class="form__label">Срок действия</legend>--}}
{{--                                        <div class="form__row">--}}
{{--                                            <div class="form__col form__col--33"><div class="form__fieldset"><input type="text" class="form__input date-mask"></div></div>--}}
{{--                                            <div class="form__col form__col--33"><div class="form__fieldset"><input type="text" class="form__input date-mask"></div></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form__col form__col--50">--}}
{{--                                    <div class="form__fieldset">--}}
{{--                                        <legend class="form__label">Фамилия и имя</legend>--}}
{{--                                        <input type="text" class="form__input">--}}
{{--                                    </div>--}}
{{--                                    <div class="form__fieldset">--}}
{{--                                        <legend class="form__label">CVV</legend>--}}
{{--                                        <div class="form__row">--}}
{{--                                            <div class="form__col form__col--33"><input type="text" class="form__input cvv-mask"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form__fieldset">--}}
{{--                                <label class="checkbox checkbox--mailer">--}}
{{--                                    <input type="checkbox" />--}}
{{--                                    <div class="checkbox__text">Сохранить карту</div>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </form>--}}

{{--                    </div>--}}
                    <button type="submit" form="orderForm" class="btn btn--accent cart-aside__buy">Оплатить</button>



                </div>
            </div>
        </div>
    </section>

@endsection
