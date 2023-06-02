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
				<h1 class="title-h1">Корзина</h1>
				<div class="cart-page__container">
					<main class="cart-page__main">
						<div class="cart-table">
							<div class="cart-table__thead">
								<div class="cart-table__th cart-table__th--name">Наименование</div>
								<div class="cart-table__th cart-table__th--count">Количество</div>
								<div class="cart-table__th cart-table__th--price">Цена</div>
								<div class="cart-table__th cart-table__th--sum">Сумма</div>
							</div>
							<div class="cart-table__body">
								<div class="cart-table__item cart-product">
        <div class="cart-product__image">
                <a href=""><img src="{{asset('images/dist/tmp-product2.jpg')}}" alt=""></a>
        </div>
        <div class="cart-product__desc">
                <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                <div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>
                <div class="cart-product__options">
                        <div class="cart-product__option">Выбранный цвет: <b>Red</b></div>
                        <div class="cart-product__option">Выбранный размер: <b>90ml</b></div>
                </div>
        </div>
        <div class="cart-product__numbers">
                <div class="numbers">
                        <div class="numbers__minus minus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#minus')}}"></use></svg></div>
                        <input type="text" class="numbers__input" value="1">
                        <div class="numbers__plus plus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#plus')}}"></use></svg></div>
                </div>
        </div>
        <div class="cart-product__prices">
                <div class="cart-product__price">10 073 ₽ </div>
                <div class="cart-product__oldprice">12 650 ₽ </div>
        </div>
        <div class="cart-product__sum">20 146 ₽</div>
        <button class="cart-product__delete"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg></button>
</div>
								<div class="cart-table__item cart-product">
        <div class="cart-product__image">
                <a href=""><img src="{{asset('images/dist/tmp-product2.jpg')}}" alt=""></a>
        </div>
        <div class="cart-product__desc">
                <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                <div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>
                <div class="cart-product__options">
                        <div class="cart-product__option">Выбранный цвет: <b>Red</b></div>
                        <div class="cart-product__option">Выбранный размер: <b>90ml</b></div>
                </div>
        </div>
        <div class="cart-product__numbers">
                <div class="numbers">
                        <div class="numbers__minus minus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#minus')}}"></use></svg></div>
                        <input type="text" class="numbers__input" value="1">
                        <div class="numbers__plus plus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#plus')}}"></use></svg></div>
                </div>
        </div>
        <div class="cart-product__prices">
                <div class="cart-product__price">10 073 ₽ </div>
                <div class="cart-product__oldprice">12 650 ₽ </div>
        </div>
        <div class="cart-product__sum">20 146 ₽</div>
        <button class="cart-product__delete"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg></button>
</div>
							</div>
							<div class="cart-table__ftr">
								<button class="btn btn--border-main cart-page__clearcart">Очистить корзину</button>
							</div>
						</div>
						<div class="cart-page__gifts">
							<h3 class="cart-page__subheading subheading"> Ваши подарки</h3>
							<div class="cart-product cart-product--gift">
								<div class="cart-product__image">
									<a href=""><img src="{{asset('images/dist/tmp-product2.jpg')}}" alt=""></a>
								</div>
								<div class="cart-product__desc">
									<div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
									<div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>
								</div>
								<div class="cart-product__sum cart-product__sum--free">Бесплатно</div>
							</div>
						</div>
						<div class="cart-page__giftbox">
							<h3 class="cart-page__subheading subheading"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#gift')}}"></use></svg> Подарочная коробка</h3>
							<label class="checkbox">
								<input type="checkbox" />
								<div class="checkbox__text">Добавить подарочную коробку</div>
							</label>
							<p><em>Подарочная коробка доступна только для заказов, которые доставляются на&nbsp;месте. Ваш счет будет отправлен вам по электронной почте.</em></p>
						</div>
					</main>
					<aside class="cart-page__aside">
						<div class="cart-aside">
        <div class="cart-aside__accordeon">
                <dl>
                        <dt>Использовать промокод <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                        <dd>
                                <form action="" class="form">
                                        <input type="text" class="form__input" placeholder="Введите промокод">
                                        <button class="btn btn--accent">Применить</button>
                                </form>
                        </dd>
                </dl>
                <dl>
                        <dt>Подарочная карта <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                        <dd>
                                <form action="" class="form">
                                        <input type="text" class="form__input" placeholder="Введите номер подарочной карты">
                                        <button class="btn btn--accent">Применить</button>
                                </form>
                        </dd>
                </dl>
                <dl>
                        <dt>Использовать баллы <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                        <dd>
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
                <div class="cart-aside__points"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#warning')}}"></use></svg> Вы получите 820 баллов</div>
                <div class="cart-aside__sum">Итого с НДС <span>40 292 ₽</span></div>
        </div>
        <a href="{{route('cart.step1')}}" class="btn btn--accent cart-aside__buy">Перейти к оплате</a>
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
