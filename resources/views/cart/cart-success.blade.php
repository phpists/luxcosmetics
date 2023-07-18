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
			<div class="col-lg-12 typography">
				<h1 class="title-h1">Оформление покупки завершено</h1>
				<p>Ваш заказ принят. Все детали о заказе отправлены на ваш e-mail, указанный при оформлении заказа. <br>В ближайшее время с вами свяжется наш менеджер для подтверждения заказа</p>
				<p></p>
				<div class="cabinet-page__group">
					<h3 class="cabinet-page__subheading subheading">Информация о заказе</h3>
					<div class="cabinet-page__item cabinet-page__item--justify">
						<div class="chars">
							<div class="chars__item">
								<div class="chars__name"><span>Номер заказа</span></div>
								<div class="chars__value"><span>45566</span></div>
							</div>
							<div class="chars__item">
								<div class="chars__name"><span>Ваше имя</span></div>
								<div class="chars__value"><span>Иван Петров</span></div>
							</div>
							<div class="chars__item">
								<div class="chars__name"><span>Телефон</span></div>
								<div class="chars__value"><span>+7 495 456 78 96</span></div>
							</div>
							<div class="chars__item">
								<div class="chars__name"><span>E-mail</span></div>
								<div class="chars__value"><span>info@domen.ru</span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="cabinet-page__group">
					<h3 class="cabinet-page__subheading subheading">Состав заказа</h3>
					<div class="cart-table">
						<div class="cart-table__thead">
							<div class="cart-table__th cart-table__th--name">Наименование</div>
							<div class="cart-table__th cart-table__th--count-and-price">Цена и кол-во</div>
							<div class="cart-table__th cart-table__th--sum">Сумма</div>
						</div>
						<div class="cart-table__body">
							<div class="cart-table__item cart-product">
        <div class="cart-product__image">
                <a href=""><img src="images/dist/tmp-product2.jpg" alt=""></a>
        </div>
        <div class="cart-product__desc">
                <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                <div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>
                <div class="cart-product__options">
                        <div class="cart-product__option">Выбранный цвет: <b>Red</b></div>
                        <div class="cart-product__option">Выбранный размер: <b>90ml</b></div>
                </div>
        </div>

        <div class="cart-product__prices-and-count" data-title="Цена и кол-во">
                <div class="cart-product__price">2 x 10 073 ₽  </div>
                <div class="cart-product__oldprice">12 650 ₽ </div>
        </div>
        <div class="cart-product__sum" data-title="Сумма">20 146 ₽</div>
</div>
							<div class="cart-table__item cart-product">
        <div class="cart-product__image">
                <a href=""><img src="images/dist/tmp-product2.jpg" alt=""></a>
        </div>
        <div class="cart-product__desc">
                <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                <div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>
                <div class="cart-product__options">
                        <div class="cart-product__option">Выбранный цвет: <b>Red</b></div>
                        <div class="cart-product__option">Выбранный размер: <b>90ml</b></div>
                </div>
        </div>

        <div class="cart-product__prices-and-count" data-title="Цена и кол-во">
                <div class="cart-product__price">2 x 10 073 ₽  </div>
                <div class="cart-product__oldprice">12 650 ₽ </div>
        </div>
        <div class="cart-product__sum" data-title="Сумма">20 146 ₽</div>
</div>
							<div class="cart-table__item  cart-product cart-product--gift">
								<div class="cart-product__image">
									<a href=""><img src="images/dist/tmp-product2.jpg" alt=""></a>
								</div>
								<div class="cart-product__desc">
									<div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
									<div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>
								</div>
								<div class="cart-product__sum cart-product__sum--free">Бесплатно</div>
							</div>
						</div>
					</div>
					<div class="cabinet-page__total">Итого с НДС <b>40 292 ₽</b></div>
				</div>
				<a href="" class="btn btn--accent">Вернутся в  каталог</a>


			</div>
		</div>
	</div>
</section>

@endsection
