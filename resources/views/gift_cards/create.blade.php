@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
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
                <form action="{{route('gif-card.store')}}" method="post">
                @csrf
				<h1 class="title-h1">Подарочная карта</h1>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($items as $item)
                                @if ($item->color_card !== null)
                                    <div class="swiper-slide">
                                        <div class="giftcard-page__section">
                                            <div class="giftcard-page__cards">
                                                <label class="giftcardradio giftcard-page__card">
                                                    <input type="radio" class="card-radio-sum" name="color" value="{{ $item->sum_card }}" required/>
                                                    <div class="giftcardradio__text" style="background-color: {{ $item->color_card }}"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="giftcard-page__section">
					<h2 class="giftcard-page__title">Выберите стоимость подарочной карты</h2>
					<div class="giftcard-page__row">
						<div class="giftcard-page__col">
							<div class="giftcard-page__sum">
								<h3 class="giftcard-page__subtitle">Выберите сумму</h3>
								<div class="giftcard-page__sumvariants">
                                    @foreach($items as $item)
									<label class="sumradio">
										<input type="radio" name="custom_sum" value="{{$item->fix_price ?? ''}}"/>
										<div class="sumradio__text">{{$item->fix_price ?? ''}}</div>
									</label>
                                    @endforeach
								</div>
							</div>
						</div>
						<div class="giftcard-page__col">
							<div class="giftcard-page__manualsum">
								<h3 class="giftcard-page__subtitle">Или введите сумму от {{$items[0]->min_sum ?? ''}} до {{$items[0]->max_sum ?? ''}}</h3>
								<input type="number" name="sum" min="{{$items[0]->min_sum ?? ''}}" max="{{$items[0]->max_sum ?? ''}}" value="1000" class="form__input" required>
							</div>
						</div>
					</div>
				</div>
				<div class="giftcard-page__section form form--box">
					<h2 class="giftcard-page__title">Персонализируйте подарочную карту</h2>
						<div class="form__fieldset">
							<legend class="form__label">Фамилия и имя получателя*</legend>
							<input type="text" name="receiver" class="form__input" required>
						</div>
						<div class="form__row">
							<div class="form__col form__col--50">
								<div class="form__fieldset">
									<legend class="form__label">Адрес электронной почты *</legend>
									<input type="email" name="receiver_email" class="form__input" required>
								</div>
							</div>
							<div class="form__col form__col--50">
								<div class="form__fieldset">
									<legend class="form__label">Повторите адрес электронной почты*</legend>
									<input type="text" name="receiver_email_confirm" class="form__input" required>
								</div>
							</div>
						</div>
						<div class="form__fieldset">
							<legend class="form__label">От кого*</legend>
							<input type="text" name="from_whom" class="form__input" required>
						</div>
						<div class="form__fieldset">
							<legend class="form__label">Добавить личное сообщение (необязательно)</legend>
							<textarea name="description" class="form__textarea"></textarea>
						</div>
						<button class="btn btn--accent btn--full">Добавить в корзину</button>
				</div>
                </form>
			</div>
		</div>
	</div>
</section>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    const sumRadios = document.querySelectorAll('input[name="custom_sum"]');
    sumRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.checked) {
                const manualSumInput = document.querySelector('input[name="sum"]');
                manualSumInput.value = radio.value;
            }
        });
    });
    const cardRadioSums = document.querySelectorAll('.card-radio-sum');

    // Получаем поле ввода суммы
    const sumInput = document.querySelector('input[name="sum"]');

    cardRadioSums.forEach(radio => {
        radio.addEventListener('click', () => {
            const selectedSum = radio.value;

            sumInput.value = selectedSum;
        });
    });


var swiper = new Swiper('.swiper-container', {
        slidesPerView: 7,
        spaceBetween: 3,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

@endsection
