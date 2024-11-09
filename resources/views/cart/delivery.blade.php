@extends('layouts.app')

@section('title', $metaTitle = getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::CART))
@section('description', $metaDescription = getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::CART))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)

@section('styles')
    <link rel="stylesheet" href="{{asset('css/maps.css')}}">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=e2bf7398-9509-44ac-8c19-e3f3fc7832aa&lang=en_US" type="text/javascript"></script>
@endsection

@section('title', 'Доставка')

@section('content')
    <style>
        #orderForm {
            visibility: visible;
            height: inherit;

        }
    </style>
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
                    <input type="hidden" id="search_borders" data-center="">

					<main class="cart-page__main cartsteps">

                        <div class="cartsteps__title">Адрес и пункт выдачи</div>

                        <form id="orderForm" action="{{ route('cart.delivery.store') }}" method="post">
                            @csrf
                            <input class="live-updatable" id="orderFormDeliveryType" type="hidden" name="{{ \App\Services\CartService::DELIVERY_KEY }}" value="{{ old(\App\Services\CartService::DELIVERY_KEY, $cartService->getProperty(\App\Services\CartService::DELIVERY_KEY)) }}" required>
                        <div class="cartsteps__item cartstep">
                            <div></div>
                            <div class="cartstep__item">
                                <div class="cartstep__title">Населённый пункт</div>
                                <div class="cartstep__add" id="area">Выберите населенный пункт</div>
                                <a href="#changecity" id="changecity_init" class="btn btn--accent popup-with-form"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use></svg> Изменить адрес</a>
                            </div>
                            <div id="delivery_contaniner">
                                <input class="live-updatable" type="hidden" id="delivery_state" name="{{ \App\Services\CartService::ADDRESS_STATE }}" value="{{ old(\App\Services\CartService::ADDRESS_STATE, $cartService->getProperty(\App\Services\CartService::ADDRESS_STATE)) }}" required>
                                <input class="live-updatable" type="hidden" id="delivery_city" name="{{ \App\Services\CartService::ADDRESS_CITY }}" value="{{ old(\App\Services\CartService::ADDRESS_CITY, $cartService->getProperty(\App\Services\CartService::ADDRESS_CITY)) }}" required>
                                <input class="live-updatable" type="hidden" id="delivery_street" name="{{ \App\Services\CartService::ADDRESS_STREET }}" value="{{ old(\App\Services\CartService::ADDRESS_STREET, $cartService->getProperty(\App\Services\CartService::ADDRESS_STREET)) }}" required>
                                <input class="live-updatable" type="hidden" id="delivery_house" name="{{ \App\Services\CartService::ADDRESS_HOUSE }}" value="{{ old(\App\Services\CartService::ADDRESS_HOUSE, $cartService->getProperty(\App\Services\CartService::ADDRESS_HOUSE)) }}" required>
                                <input class="live-updatable" type="hidden" id="delivery_building" name="{{ \App\Services\CartService::ADDRESS_BUILDING }}" value="{{ old(\App\Services\CartService::ADDRESS_BUILDING, $cartService->getProperty(\App\Services\CartService::ADDRESS_BUILDING)) }}">
                                <input class="live-updatable" type="hidden" id="delivery_apartment" name="{{ \App\Services\CartService::ADDRESS_APARTMENT }}" value="{{ old(\App\Services\CartService::ADDRESS_APARTMENT, $cartService->getProperty(\App\Services\CartService::ADDRESS_APARTMENT)) }}">
                                <input class="live-updatable" type="hidden" id="delivery_intercom" name="{{ \App\Services\CartService::ADDRESS_INTERCOM }}" value="{{ old(\App\Services\CartService::ADDRESS_INTERCOM, $cartService->getProperty(\App\Services\CartService::ADDRESS_INTERCOM)) }}">
                                <input class="live-updatable" type="hidden" id="delivery_entrance" name="{{ \App\Services\CartService::ADDRESS_ENTRANCE }}" value="{{ old(\App\Services\CartService::ADDRESS_ENTRANCE, $cartService->getProperty(\App\Services\CartService::ADDRESS_ENTRANCE)) }}">
                                <input class="live-updatable" type="hidden" id="delivery_over" name="{{ \App\Services\CartService::ADDRESS_OVER }}" value="{{ old(\App\Services\CartService::ADDRESS_OVER, $cartService->getProperty(\App\Services\CartService::ADDRESS_OVER)) }}">
                                <input class="live-updatable" type="hidden" id="delivery_service" name="{{ \App\Services\CartService::ADDRESS_SERVICE }}" value="{{ old(\App\Services\CartService::ADDRESS_SERVICE, $cartService->getProperty(\App\Services\CartService::ADDRESS_SERVICE)) }}" required>
                                <input class="live-updatable" type="hidden" id="delivery_zip" name="{{ \App\Services\CartService::ADDRESS_ZIP }}" value="{{ old(\App\Services\CartService::ADDRESS_ZIP, $cartService->getProperty(\App\Services\CartService::ADDRESS_ZIP)) }}" required>
                                <input class="live-updatable" type="hidden" id="final_addr" name="{{ \App\Services\CartService::ADDRESS_KEY }}" value="{{ old(\App\Services\CartService::ADDRESS_KEY, $cartService->getProperty(\App\Services\CartService::ADDRESS_KEY)) }}" required>
                                <input class="live-updatable" type="hidden" id="local_delivery_point_id" name="{{ \App\Services\CartService::DELIVERY_POINT_ID }}" value="{{ old(\App\Services\CartService::DELIVERY_POINT_ID, $cartService->getProperty(\App\Services\CartService::DELIVERY_POINT_ID)) }}">
                                <div class="cartstep__item">
                                    <div class="cartstep__title">Выберите способ доставки</div>
                                    <div class="cartstep__delivery">
                                        <a href="#addmodal" style="text-decoration: none" class="radio popup-with-form cartstep__link" data-tab="coruier_tab">
                                            <input type="radio" name="delivery" value="{{ \App\Models\Order::DELIVERY_COURIER }}" @checked(old(\App\Services\CartService::DELIVERY_KEY, $cartService->getProperty(\App\Services\CartService::DELIVERY_KEY)) == \App\Models\Order::DELIVERY_COURIER)/>
                                            <div class="radio__text">Курьер <small>Курьерская доставка <span>Бесплатно</span></small></div>
                                        </a>
                                        <a href="#pick-up-point" id="show_map_link" style="text-decoration: none" class="radio popup-with-form cartstep__link" data-tab="pickup_delivery_tab">
                                            <input type="radio" name="delivery" value="{{ \App\Models\Order::DELIVERY_SELF_PICKUP }}" @checked(old(\App\Services\CartService::DELIVERY_KEY, $cartService->getProperty(\App\Services\CartService::DELIVERY_KEY)) == \App\Models\Order::DELIVERY_SELF_PICKUP)/>
                                            <div class="radio__text">Самовывоз <small>Самовывоз ПВЗ <span>Бесплатно</span></small></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="cartstep__tab" id="coruier_tab">
                                    <div class="cartstep__item">
                                        <div class="cartstep__title">Адрес доставки товара</div>
                                        <div class="cartstep__add" id="courier_addr">г. Москва, улица , дом, Название пункта выдачи</div>
                                        <a href="#addmodal" class="btn btn--accent popup-with-form">Изменить адрес доставки</a>
                                    </div>
                                </div>
                                <div class="cartstep__tab" id="pickup_delivery_tab">
                                    <div class="cartstep__item">
                                        <div class="cartstep__title">Пункт выдачи заказа</div>
                                        <div class="cartstep__add" id="pickup_addr">г. Москва, улица , дом, Название пункта выдачи</div>
                                        <a href="#pick-up-point" id="map_init_btn" class="btn btn--accent popup-with-form"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use></svg> Выбрать другой</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="cartsteps__title">Получатель <small>для получения предоплаченного заказа возможно потребуется  паспорт</small></div>
                            <div class="cartsteps__item cartstep">
                            <div class="cartstep__item">
                                <div class="cartstep__title">Ваши данные</div>
                                    <div class="form__row">
                                        <div class="form__col form__col--50">
                                            <div class="form__fieldset">
                                                <legend class="form__label">Ваше имя *</legend>
                                                <input type="text" class="form__input" name="first_name" value="{{ old('first_name', $cartService->getProperty(\App\Services\CartService::FIRST_NAME_KEY) ?? auth()->user()->name) }}" required>
                                            </div>
                                        </div>
                                        <div class="form__col form__col--50">
                                            <div class="form__fieldset">
                                                <legend class="form__label">Фамилия *</legend>
                                                <input type="text" class="form__input" name="last_name" value="{{ old('last_name', $cartService->getProperty(\App\Services\CartService::LAST_NAME_KEY) ?? auth()->user()->surname) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__col form__col--50">
                                            <div class="form__fieldset">
                                                <legend class="form__label">Номер телефона</legend>
                                                <input id="phone_inp" type="text" class="form__input" name="phone" value="{{ old('phone', $cartService->getProperty(\App\Services\CartService::PHONE_KEY) ?? auth()->user()->phone) }}" style="pointer-events: none;">
                                            </div>
                                        </div>
                                        <div class="form__col form__col--50">
                                            <div class="form__fieldset">
                                                <legend class="form__label">Электронная почта</legend>
                                                <input type="email" class="form__input" name="email" value="{{ old('email', $cartService->getProperty(\App\Services\CartService::EMAIL_KEY) ?? auth()->user()->email) }}" style="pointer-events: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__fieldset">
                                        <label class="checkbox">
                                            <input type="checkbox" checked required/>
                                            <div class="checkbox__text">Я ознакомился и согласен с <a href="/pages/policy">политикой обработки персональных данных</a> и <a href="/pages/policy">пользовательским соглашением</a></div>
                                        </label>
                                    </div>

                            </div>
                        </div>
                        </form>

						@include('cart.includes.products_list_static')
					</main>
					<aside class="cart-page__aside">
                        @include('cart.includes.aside', ['custom_btn_text' => 'Перейти к выбору способа оплаты'])
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
        let address_additional = {
            kvartira: null,
            domofon: null,
            podiezd: null,
            etaj: null
        }
        $(document).ready(function () {

            $(document).on('click', 'a.radio', function (e) {
                $(this).find('input:radio').prop('checked', true)
            })


            $(document).on('submit', '#orderForm', function (e) {
                let address = $('#final_addr').val();

                if (!address) {
                    toastr.error('Укажите адрес доставки!');
                    e.preventDefault();
                    return false;
                }
            })

            $(document).on('click', '.cartstep__delivery a', function (e) {
                let deliveryType = $(this).find('input').val();
                $('#orderFormDeliveryType').val(deliveryType).change()

                if (deliveryType == 'courier') {
                    $('#delivery_service').val('').prop('required', false)
                } else if(deliveryType == 'pickup') {
                    $('#delivery_service').prop('required', true)
                }
            })

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

            document.getElementById('send_I_btn')?.addEventListener('click', function(ev) {
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


            $(document).on('change', '#address_additional input', function (e) {
                let currentAddressOutput = $('#' + ADDRESS_OUTPUT_ID),
                    currentAddressString = currentAddressOutput.text();

                let newAddressAdditional = [];
                address_additional[this.name] = this.value;
                for (let additinal in address_additional) {
                    if (address_additional[additinal]) {
                        newAddressAdditional
                            .push($('#address_additional').find(`input[name="${additinal}"]`).prev().text()
                            + ` - ${address_additional[additinal]}`)
                    }
                }

                let output = '';
                if (newAddressAdditional.length > 0) {
                    let baseAddress = currentAddressString.split('|')[0];
                    output = ' | ' + newAddressAdditional.join(', ')
                    output = baseAddress + output;

                    currentAddressOutput.text(output)
                }
            })

            $(document).on('change', '.live-updatable', function (e) {
                const name = $(this).attr('name'),
                    value = $(this).val();

                if (name) {
                    $.ajax({
                        url: '{{ route('cart.update-session-value') }}',
                        type: 'PUT',
                        data: {
                            name: name,
                            value: value,
                        }
                    })
                }
            })
        })
    </script>
@endsection
