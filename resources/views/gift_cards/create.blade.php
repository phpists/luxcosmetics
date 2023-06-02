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
<section class="giftcard-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="title-h1">Подарочная карта</h1>
				<div class="giftcard-page__section">
					<h2 class="giftcard-page__title">Выберите дизайн карты</h2>
					<div class="giftcard-page__cards">
						<label class="giftcardradio giftcard-page__card">
							<input type="radio"  name="color"/>
							<div class="giftcardradio__text" style="background-color: #06473A"></div>
						</label>
						<label class="giftcardradio giftcard-page__card">
							<input type="radio"  name="color"/>
							<div class="giftcardradio__text" style="background-color: #CA853F"></div>
						</label>
						<label class="giftcardradio giftcard-page__card">
							<input type="radio"  name="color"/>
							<div class="giftcardradio__text" style="background-color: #F1F1F1"></div>
						</label>
					</div>
				</div>
				<div class="giftcard-page__section">
					<h2 class="giftcard-page__title">Выберите стоимость подарочной карты</h2>
					<div class="giftcard-page__row">
						<div class="giftcard-page__col">
							<div class="giftcard-page__sum">
								<h3 class="giftcard-page__subtitle">Выберите сумму</h3>
								<div class="giftcard-page__sumvariants">
									<label class="sumradio">
										<input type="radio"   name="sum"/>
										<div class="sumradio__text">250</div>
									</label>
									<label class="sumradio">
										<input type="radio"   name="sum"/>
										<div class="sumradio__text">500</div>
									</label>
									<label class="sumradio">
										<input type="radio"   name="sum"/>
										<div class="sumradio__text">750</div>
									</label>
									<label class="sumradio">
										<input type="radio" checked  name="sum"/>
										<div class="sumradio__text">1000</div>
									</label>
									<label class="sumradio">
										<input type="radio" name="sum" />
										<div class="sumradio__text">1500</div>
									</label>
									<label class="sumradio">
										<input type="radio" name="sum" />
										<div class="sumradio__text">2500</div>
									</label>
									<label class="sumradio">
										<input type="radio" name="sum" />
										<div class="sumradio__text">5000</div>
									</label>
								</div>
							</div>
						</div>
						<div class="giftcard-page__col">
							<div class="giftcard-page__manualsum">
								<h3 class="giftcard-page__subtitle">Или введите сумму от 1000 до 100 000</h3>
								<input type="number" min="1000" max="100000" value="1000" class="form__input">
							</div>
						</div>
					</div>
				</div>
				<div class="giftcard-page__section">
					<h2 class="giftcard-page__title">Персонализируйте подарочную карту</h2>
					<form action="" class="form form--box">
						<div class="form__fieldset">
							<legend class="form__label">Фамилия и имя получателя*</legend>
							<input type="text" class="form__input">
						</div>
						<div class="form__row">
							<div class="form__col form__col--50">
								<div class="form__fieldset">
									<legend class="form__label">Адрес электронной почты *</legend>
									<input type="text" class="form__input">
								</div>
							</div>
							<div class="form__col form__col--50">
								<div class="form__fieldset">
									<legend class="form__label">Повторите адрес электронной почты*</legend>
									<input type="text" class="form__input">
								</div>
							</div>
						</div>
						<div class="form__fieldset">
							<legend class="form__label">От кого*</legend>
							<input type="text" class="form__input">
						</div>
						<div class="form__fieldset">
							<legend class="form__label">Добавить личное сообщение (необязательно)</legend>
							<textarea name="" class="form__textarea"></textarea>
						</div>
						<button class="btn btn--accent btn--full">Добавить в корзину</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
