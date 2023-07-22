@extends('layouts.app')

@section('title', 'Доставка')

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
                        <form id="orderForm" action="{{ route('cart.delivery.store') }}" method="post">
                            @csrf
                        <div class="cart-page__group">
                            <h3 class="cart-page__subheading subheading">Способ доставки</h3>
                            <div class="cart-page__deliverymethods">
                                <label class="radio">
                                    <input type="radio" name="delivery_type" value="{{ \App\Models\Order::DELIVERY_TYPE_STANDARD }}" @checked($cartService->getProperty(\App\Services\CartService::DELIVERY_KEY) == \App\Models\Order::DELIVERY_TYPE_STANDARD) required/>
                                    <div class="radio__text">Стандартная доставка <small>2-3 дня в ваш город</small></div>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="delivery_type" value="{{ \App\Models\Order::DELIVERY_TYPE_EXPRESS }}" @checked($cartService->getProperty(\App\Services\CartService::DELIVERY_KEY) == \App\Models\Order::DELIVERY_TYPE_EXPRESS) required/>
                                    <div class="radio__text">Экспресс доставка</div>
                                </label>
                            </div>
                        </div>

                        @if(auth()->check() && $user_has_addresses = auth()->user()->addresses->isNotEmpty())
						<h3 class="cart-page__heading subheading subheading--with-form">Мои адреса</h3>
						<div class="cart-page__addresses">
                            @foreach(auth()->user()->addresses as $address)
							<div class="cart-page__address my-add">
								<div class="my-add__title">{{ $address->name . ' ' . $address->surname }}</div>
								<div class="my-add__wrap">
									<label class="radio">
										<input type="radio" name="address_id" value="{{ $address->id }}" @checked($cartService->getProperty(\App\Services\CartService::ADDRESS_KEY) == $address->id) required/>
										<div class="radio__text">{{ $address->region . ', ' . $address->city . ', ' . $address->address }}
                                            <br>{{ $address->phone }}</div>
									</label>
									<button class="btn-edit btn_edit_address popup-with-form" data-value="{{$address->id}}" href="#updateAddressModal">
                                        <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use></svg> Редактировать</button>
								</div>
							</div>
                            @endforeach
						</div>
                        @endif
                        </form>


                        @include('layouts.parts.edit_address_modal')

						<div class="cart-page__group">
							<h3 class="cart-page__subheading subheading subheading--with-form">Добавить адрес</h3>
							@include('layouts.parts.create_address')
						</div>


						@include('cart.includes.products_list_static')



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
                <div class="cart-aside__sum">Итого с НДС <span>{{ $cartService->getTotalSum() }}</span> ₽</div>
        </div>
        <button type="submit" form="orderForm" class="btn btn--accent cart-aside__buy cartSubmit" @disabled(!$user_has_addresses)>Перейти к оплате</button>
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

@section('scripts')
    <script>
        $(document).ready(function () {
            Inputmask("+7 (999) 999-99-99").mask('#phone_inp');
            Inputmask("+7 (999) 999-99-99").mask('#updPhone');

            $('.btn_edit_address').on('click', function(ev) {
                $.ajax({
                    url: '{{route('profile.addresses.show')}}',
                    data: {
                        id: ev.target.getAttribute('data-value')
                    },
                    success: function (response) {
                        $('#updAddress').val(response.address);
                        $('#updId').val(response.id);
                        $('#updName').val(response.name);
                        $('#updEmail').val(response.email);
                        $('#updSurName').val(response.surname);
                        $('#updPhone').val(response.phone);
                        $('#updCity').val(response.city);
                        $('#updRegion').val(response.region);
                    },
                    error: function (resp) {
                        console.log(resp)
                    }
                })
            })
        })
    </script>
@endsection
