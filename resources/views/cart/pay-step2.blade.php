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
					<div class="cart-page__step is-active">2. Доставка</div>
					<div class="cart-page__step">3. Оплата </div>
				</div>
				<div class="cart-page__container">
					<main class="cart-page__main">
						<h3 class="cart-page__heading subheading subheading--with-form">Мои адреса</h3>
						<div class="cart-page__addresses">
							<div class="cart-page__address my-add">
								<div class="my-add__title">Иван Петров</div>
								<div class="my-add__wrap">
									<label class="radio">
										<input type="radio" name="myadd" />
										<div class="radio__text">г.Москва ул. Пролетарская 24 / 5<br> +7 495 456 78 96</div>
									</label>
									<button class="btn-edit"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use></svg> Редактировать</button>
								</div>
							</div>
							<div class="cart-page__address my-add">
								<div class="my-add__title">Иван Петров</div>
								<div class="my-add__wrap">
									<label class="radio">
										<input type="radio" name="myadd" />
										<div class="radio__text">г.Москва ул. Звездная 10 / 1<br> +7 495 456 78 96</div>
									</label>
									<button class="btn-edit"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use></svg> Редактировать</button>
								</div>
							</div>
						</div>
						<div class="cart-page__group">
							<h3 class="cart-page__subheading subheading subheading--with-form">Добавить адрес</h3>
							<form action="" class="form form--box">
								<div class="form__row">
									<div class="form__col form__col--50">
										<div class="form__fieldset">
											<legend class="form__label">Ваше имя *</legend>
											<input type="text" class="form__input">
										</div>
									</div>
									<div class="form__col form__col--50">
										<div class="form__fieldset">
											<legend class="form__label">Фамилия *</legend>
											<input type="text" class="form__input">
										</div>
									</div>
								</div>
								<div class="form__row">
									<div class="form__col form__col--50">
										<div class="form__fieldset">
											<legend class="form__label">Номер телефона *</legend>
											<input type="text" class="form__input">
										</div>
									</div>
									<div class="form__col form__col--50">
										<div class="form__fieldset">
											<legend class="form__label">Электронная почта *</legend>
											<input type="text" class="form__input">
										</div>
									</div>
								</div>
								<div class="form__row">
									<div class="form__col form__col--50">
										<div class="form__fieldset">
											<legend class="form__label">Город</legend>
											<input type="text" class="form__input">
										</div>
									</div>
									<div class="form__col form__col--50">
										<div class="form__fieldset">
											<legend class="form__label">Область</legend>
											<input type="text" class="form__input">
										</div>
									</div>
								</div>
								<div class="form__row">
									<div class="form__col form__col--100">
										<div class="form__fieldset">
											<legend class="form__label">Адрес</legend>
											<input type="text" class="form__input">
										</div>
									</div>
								</div>
								<div class="form__ftr">
									<label class="checkbox">
										<input type="checkbox" />
										<div class="checkbox__text">Сделать моим адресом по умолчанию</div>
									</label>
									<div class="form__btns">
										<button class="btn btn--border-main">Отмена</button>
										<button class="btn btn--accent">Сохранить</button>
									</div>
								</div>
							</form>
						</div>
						<div class="cart-page__group">
							<h3 class="cart-page__subheading subheading">Способ доставки</h3>
							<div class="cart-page__deliverymethods">
								<label class="radio">
									<input type="radio" name="delivery" />
									<div class="radio__text">Стандартная доставка <small>2-3 дня в ваш город</small></div>
								</label>
								<label class="radio">
									<input type="radio" name="delivery" />
									<div class="radio__text">Экспресс доставка</div>
								</label>
							</div>
						</div>
						<div class="cart-page__group">
							<h3 class="cart-page__subheading subheading">Состав заказа</h3>
							<div class="cart-table">
								<div class="cart-table__thead">
									<div class="cart-table__th cart-table__th--name">Наименование</div>
									<div class="cart-table__th cart-table__th--count-and-price">Цена и кол-во</div>
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

        <div class="cart-product__prices-and-count">
                <div class="cart-product__price">2 x 10 073 ₽  </div>
                <div class="cart-product__oldprice">12 650 ₽ </div>
        </div>
        <div class="cart-product__sum">20 146 ₽</div>
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

        <div class="cart-product__prices-and-count">
                <div class="cart-product__price">2 x 10 073 ₽  </div>
                <div class="cart-product__oldprice">12 650 ₽ </div>
        </div>
        <div class="cart-product__sum">20 146 ₽</div>
</div>
									<div class="cart-table__item  cart-product cart-product--gift">
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
							</div>
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
        <a href="" class="btn btn--accent cart-aside__buy">Перейти к оплате</a>
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
