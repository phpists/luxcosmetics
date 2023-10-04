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
                        <div>
                            <button id="send_I_btn">Send</button>
                        </div>
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
										<input type="radio" name="address_id" value="{{ $address->id }}" @checked($cartService->getProperty(\App\Services\CartService::ADDRESS_KEY) == $address->id)/>
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
							<a href="javascript:;" class="cart-page__subheading subheading subheading--with-form toggle-address">Добавить адрес</a>
                            <div class="toggable" @if($user_has_addresses) style="display: none" @endif>
							@include('layouts.parts.create_address')
                            </div>
						</div>


						@include('cart.includes.products_list_static')



					</main>
					<aside class="cart-page__aside">
                        @include('cart.includes.aside')
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

            document.getElementById('send_I_btn').addEventListener('click', function(ev) {
                let data = {
                    grant_type: 'client_credentials',
                    client_id: 'EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI',
                    client_secret: 'PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG'
                }

                $.ajax({
                    url: 'https://api.edu.cdek.ru/v2/oauth/token',
                    method: 'POST',
                    data: data,
                    success: function (resp) {
                        console.log(resp)
                    },
                    error: function (resp) {
                        console.log(resp)
                    }
                })

            })
        })
    </script>
@endsection
