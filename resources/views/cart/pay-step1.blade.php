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
					<div class="cart-page__step is-active">1. Авторизация</div>
					<div class="cart-page__step">2. Доставка</div>
					<div class="cart-page__step">3. Оплата </div>
				</div>
				<div class="cart-page__auth cart-auth">
					<div class="cart-auth__col">
						<div class="cart-auth__title">Авторизация через соцсети</div>
						<div class="cart-auth__providers">
							<button class="cart-auth__provider">
								<img src="{{asset('images/dist/icons/google.svg')}}" alt="">
								<span>Google</span>
							</button>
							<button class="cart-auth__provider">
								<img src="{{asset('images/dist/icons/fb.svg')}}" alt="">
								<span>Facebook</span>
							</button>
						</div>
						<div class="cart-auth__or">или</div>
						<form action="" class="form form--box">
							<div class="form__fieldset">
								<legend class="form__label">Электронная почта *</legend>
								<input type="text" class="form__input" placeholder="Введите ваш email">
							</div>
							<div class="form__fieldset">
								<legend class="form__label">Пароль *</legend>
								<input type="password" class="form__input" placeholder="Введите ваш пароль">
							</div>
							<div class="form__fieldset form__ftr">
								<label class="checkbox">
									<input type="checkbox" />
									<div class="checkbox__text">Запомнить меня</div>
								</label>
								<a href="">Забыли пароль?</a>
							</div>
							<button class="btn btn--accent">Авторизоваться</button>
						</form>
					</div>
					<div class="cart-auth__col">
						<div class="cart-auth__title">Продолжить как гость</div>
						<div class="cart-auth__subtitle">Продолжить оформление заказа в качестве гостя и создать учетную запись позже</div>
						<form action="" class="form form--box">
							<div class="form__fieldset">
								<legend class="form__label">Электронная почта *</legend>
								<input type="text" class="form__input" placeholder="Введите ваш email">
							</div>
							<div class="form__fieldset">
								<label class="checkbox">
									<input type="checkbox" />
									<div class="checkbox__text small">Подпишитесь, чтобы получить эксклюзивне предложения, анонсы новых брендов и советы экспетов по красоте</div>
								</label>
							</div>
							<button class="btn btn--accent btn--full">Продолжить оформление заказа</button>
						</form>
					</div>
				</div>
				<div class="cart-page__contacts">
					<div class="cart-page__paymethods">
						<img src="{{asset('images/dist/ico-visa.png')}}" alt="">
						<img src="{{asset('images/dist/ico-mir.png')}}" alt="">
						<img src="{{asset('images/dist/ico-youmoney.png')}}" alt="">
					</div>
					<h3>Нужна помощь? <a href="tel:+74951528544">+7 495 152 85 44</a></h3>
					<p>Служба поддержки клиентов открыта: с 10:00 до 22:00 (с понедельника по пятницу)</p>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
