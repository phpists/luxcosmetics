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
                        <form id="orderForm" action="{{ route('cart.store') }}" method="post">
                            @csrf
                        <div class="cart-page__group">
                            <h3 class="cart-page__subheading subheading">Способ доставки</h3>
                            <div class="cart-page__deliverymethods">
                                <label class="radio">
                                    <input type="radio" name="delivery_type" value="{{ \App\Models\Order::DELIVERY_TYPE_STANDARD }}" required/>
                                    <div class="radio__text">Стандартная доставка <small>2-3 дня в ваш город</small></div>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="delivery_type" value="{{ \App\Models\Order::DELIVERY_TYPE_EXPRESS }}" required/>
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
										<input type="radio" name="address_id" value="{{ $address->id }}" required/>
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


						<div class="cart-page__group">
							<h3 class="cart-page__subheading subheading">Состав заказа</h3>
							<div class="cart-table">
								<div class="cart-table__thead">
									<div class="cart-table__th cart-table__th--name">Наименование</div>
									<div class="cart-table__th cart-table__th--count-and-price">Цена и кол-во</div>
									<div class="cart-table__th cart-table__th--sum">Сумма</div>
								</div>
								<div class="cart-table__body">
                                    @foreach($cartService->getAllProducts() as $product)
									<div class="cart-table__item cart-product">
                                        <div class="cart-product__image">
                                                <a href="{{ route('products.product', ['alias' => $product->alias]) }}">
                                                    <img src="{{ asset('images/uploads/products/' . $product->main_image) }}" alt=""></a>
                                        </div>
                                        <div class="cart-product__desc">
                                                <div class="cart-product__title">
                                                    <a href="{{ route('products.product', ['alias' => $product->alias]) }}">{{ $product->brand->name }}</a>
                                                </div>
                                                <div class="cart-product__subtitle">{{ $product->title }}</div>
                                                <div class="cart-product__options">
                                                        <div class="cart-product__option">Выбранный {{ mb_strtolower($product->baseProperty->name) }}:
                                                            <b>{{ ($product->baseValue->value ?? '') . ($product->baseProperty->measure ?? '') }}</b></div>
                                                </div>
                                        </div>

                                        <div class="cart-product__prices-and-count">
                                                <div class="cart-product__price">{{ $product->quantity }} x {{ $product->price }} ₽  </div>
                                            @if($product->old_price)
                                                <div class="cart-product__oldprice">{{ $product->old_price }} ₽ </div>
                                            @endif
                                        </div>
                                        <div class="cart-product__sum">{{ round($product->price * $product->quantity, 2) }} ₽</div>
                                    </div>
                                    @endforeach
{{--									<div class="cart-table__item  cart-product cart-product--gift">--}}
{{--										<div class="cart-product__image">--}}
{{--											<a href=""><img src="{{asset('images/dist/tmp-product2.jpg')}}" alt=""></a>--}}
{{--										</div>--}}
{{--										<div class="cart-product__desc">--}}
{{--											<div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>--}}
{{--											<div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>--}}
{{--										</div>--}}
{{--										<div class="cart-product__sum cart-product__sum--free">Бесплатно</div>--}}
{{--									</div>--}}
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
