@extends('layouts.app')

@section('content')

<section class="cart-page" style="margin-top: 40px">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 typography">
				<h1 class="title-h1">Оформление покупки завершено</h1>
                <p>Подарочная карта отправлена на почту получателя</p>
                <p></p>
                <div class="cabinet-page__group">
                    <h3 class="cabinet-page__subheading subheading">Информация о заказе</h3>
                    <div class="cabinet-page__item cabinet-page__item--justify">
                        <div class="chars">
                            <div class="chars__item">
                                <div class="chars__name"><span>Ваше имя</span></div>
                                <div class="chars__value"><span>{{ $data['from_whom'] }}</span></div>
                            </div>
                            <div class="chars__item">
                                <div class="chars__name"><span>Получатель</span></div>
                                <div class="chars__value"><span>{{ $data['receiver'] }}</span></div>
                            </div>
                            <div class="chars__item">
                                <div class="chars__name"><span>E-mail получателя</span></div>
                                <div class="chars__value"><span>{{ $data['receiver_email'] }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cabinet-page__group">
                    <div class="cart-table">
                        <div class="cart-table__thead">
                            <div class="cart-table__th cart-table__th--name">Наименование</div>
                            <div class="cart-table__th cart-table__th--sum">Стоимость</div>
                        </div>
                        <div class="cart-table__body">

                            <div class="cart-table__item  cart-product cart-product--gift">
                                <div class="cart-product__image">
                                    <div class="giftcardbox" style="background-color: {{ $data['color'] }}"></div>
                                </div>
                                <div class="cart-product__desc">
                                    <div class="cart-product__title">Подарочная карта на {{ $data['sum'] }} ₽</div>
                                    <div class="cart-product__subtitle">от: {{ $data['from_whom'] }}
                                        <br> для: {{ $data['receiver'] }}</div>
                                </div>
                                <div class="cart-product__sum cart-product__sum--free">{{ $data['sum'] }} ₽</div>
                            </div>
                        </div>
                    </div>
                    <div class="cabinet-page__total">Итого с НДС <b>{{ $data['sum'] }} ₽</b></div>

                </div>


                <a href="{{ route('home') }}" class="btn btn--accent">Вернутся в  каталог</a>


			</div>
		</div>
	</div>
</section>

@endsection
