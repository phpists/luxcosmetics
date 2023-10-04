@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/maps.css')}}">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=e2bf7398-9509-44ac-8c19-e3f3fc7832aa&lang=en_US" type="text/javascript"></script>
@endsection

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
					<main class="cart-page__main cartsteps">
                        <div class="cartsteps__item cartstep">
                            <div></div>
                            <div class="cartstep__item">
                                <div class="cartstep__title">Населённый пункт</div>
                                <div class="cartstep__add" data-value="Москва" id="area">г. Москва</div>
                                <a href="#changecity" id="changecity_init" class="btn btn--accent popup-with-form"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use></svg> Изменить адрес</a>
                            </div>
                            <div class="cartstep__item">
                                <div class="cartstep__title">Способ доставки</div>
                                <div class="cartstep__delivery">
                                    <a href="#addmodal" style="text-decoration: none" class="radio popup-with-form cartstep__link" data-tab="coruier_tab">
                                        <input type="radio" name="delivery" />
                                        <div class="radio__text">Курьер <small>Курьерская доставка <span>Бесплатно</span></small></div>
                                    </a>
                                    <a href="#pick-up-point" id="show_map_link" style="text-decoration: none" class="radio popup-with-form cartstep__link" data-tab="pickup_delivery_tab">
                                        <input type="radio" name="delivery" />
                                        <div class="radio__text">Самовывоз <small>Самовывоз ПВЗ <span>Бесплатно</span></small></div>
                                    </a>
                                </div>
                            </div>
                            <div class="cartstep__tab" id="coruier_tab">
                                <div class="cartstep__item">
                                    <div class="cartstep__title">Выберите куда доставить товар</div>
                                    <a href="#addmodal" class="btn btn--accent popup-with-form">Модалка для адреса</a>
                                </div>
                            </div>
                            <div class="cartstep__tab" id="pickup_delivery_tab">
                                <div class="cartsteps__title">Адрес и пункт выдачи</div>
                                <div class="cartstep__item">
                                    <div class="cartstep__title">Пункт выдачи заказа</div>
                                    <div class="cartstep__add" id="pickup_addr">г. Москва, улица , дом, Название пункта выдачи</div>
                                    <a href="#pick-up-point" id="map_init_btn" class="btn btn--accent popup-with-form"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use></svg> Выбрать другой</a>
                                </div>
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

@section('hidden-content')
    @include('cart.modals.pickup_modal')
    @include('cart.modals.change-city')
    @include('cart.modals.coruier-delivery-modal')
@endsection

@section('scripts')
    <script src="{{asset('js/yandex.js')}}"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"
        defer
    ></script>
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
