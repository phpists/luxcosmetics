@extends('layouts.app')

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
				<div class="cart-page__steps">
					<div class="cart-page__step">1. Авторизация</div>
					<div class="cart-page__step">2. Доставка</div>
					<div class="cart-page__step is-active">3. Оплата </div>
				</div>
				<div class="cart-page__container">
					<main class="cart-page__main">

                        <form action="{{ route('cart.checkout.store') }}" method="POST" id="checkoutForm">
                            @csrf
                        <div class="cart-page__group">
                            <h3 class="cart-page__subheading subheading">Адрес для выставления счета</h3>
                            <label class="checkbox">
                                <input type="checkbox" name="as_delivery_address" />
                                <div class="checkbox__text">Использовать как адрес доставки</div>
                            </label>
                            <div class="typography addressblock">
                                <p>{{ $address->full_name }}</p>
                                <p>{{ $address->phone }}</p>
                                <p>{{ $address->full_address }}</p>
                            </div>
                        </div>

						<h3 class="cart-page__heading subheading subheading--with-form">Выберите способ оплаты</h3>
                        <div class="cart-page__addresses">
                            @foreach(auth()->user()->cards as $card)
                                <div class="cart-page__address my-add">
                                    <div class="my-add__title">{{ $card->full_name }}</div>
                                    <div class="my-add__wrap">
                                        <label class="radio">
                                            <input type="radio" name="card_id" value="{{ $card->id }}" required/>
                                            <div class="radio__text">{{ \App\Services\SiteService::displayCardNumber($card->card_number) }}
                                                <br>{{ $card->valid_date }}</div>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        </form>


						<div class="cart-page__group">
                            <h3 class="cart-page__subheading subheading subheading--with-form">Добавить новую карту</h3>
                            @include('layouts.parts.create_payment')
						</div>


                        @include('cart.includes.products_list_static')


						<div class="cart-page__group">
							<h3 class="cart-page__subheading subheading">Адрес доставки</h3>
							<div class="typography addressblock">
                                <p>{{ $address->full_name }}</p>
                                <p>{{ $address->phone }}</p>
                                <p>{{ $address->full_address }}</p>
							</div>
						</div>
					</main>
					<aside class="cart-page__aside">
						<div class="cart-aside">
        <div class="cart-aside__accordeon">
                <dl>
                        <dt>Использовать промокод <svg class="icon"><use xlink:href="images/dist/sprite.svg#arrow"></use></svg></dt>
                        <dd>
                                <div class="formsuccess">Вы применили промокод на  скидку <b>30%</b></div>
                                <div class="formerror">Какой-то текст ошибки</div>
                                <form action="" class="form">
                                        <input type="text" class="form__input form__input--error" placeholder="Введите промокод">
                                        <button class="btn btn--accent">Применить</button>
                                </form>
                        </dd>
                </dl>
                <dl>
                        <dt>Подарочная карта <svg class="icon"><use xlink:href="images/dist/sprite.svg#arrow"></use></svg></dt>
                        <dd>
                                <div class="formsuccess">Вы использовали подарочную карту </div>
                                <div class="formerror">Какой-то текст ошибки</div>
                                <form action="" class="form">
                                        <input type="text" class="form__input" placeholder="Введите номер подарочной карты">
                                        <button class="btn btn--accent">Применить</button>
                                </form>
                        </dd>
                </dl>
                <dl>
                        <dt>Использовать баллы <svg class="icon"><use xlink:href="images/dist/sprite.svg#arrow"></use></svg></dt>
                        <dd>
                                <div class="formsuccess">Вы использовали <b>350 баллов</b> </div>
                                <div class="formerror">Какой-то текст ошибки</div>
                                <form action="" class="form">
                                        <input type="text" class="form__input" placeholder="Введите количество баллов">
                                        <button class="btn btn--accent">Применить</button>
                                </form>
                        </dd>
                </dl>
        </div>
        <div class="cart-aside__total">
                <div class="cart-aside__delivery">
                        <span class="cart-aside__delivery-name">Доставка <small>Бесплатная доставка
                                в течении 1-2 дней</small></span>
                        <span class="cart-aside__delivery-value">Бесплатно</span>
                </div>
                <div class="cart-aside__points"><svg class="icon"><use xlink:href="images/dist/sprite.svg#warning"></use></svg> Вы получите 820 баллов</div>
                <div class="cart-aside__sum">Итого с НДС <span>{{ $cartService->getTotalSum() }}</span>₽</div>
        </div>
        <button type="submit" form="checkoutForm" class="btn btn--accent cart-aside__buy">Оформить заказ</button>
        <div class="cart-aside__paymethods">
                <img src="images/dist/ico-visa.png" alt="">
                <img src="images/dist/ico-mir.png" alt="">
                <img src="images/dist/ico-youmoney.png" alt="">
        </div>
</div>
					</aside>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
