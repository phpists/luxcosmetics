@extends('layouts.app')

@section('title', $metaTitle = getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::CART))
@section('description', $metaDescription = getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::CART))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)

@section('content')
<section class="cart-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="cart-page__steps">
					<div class="cart-page__step">1. Авторизация</div>
					<div class="cart-page__step">2. Доставка</div>
					<div class="cart-page__step is-active">3. Оплата </div>
				</div>
				<div class="cart-page__container">
					<main class="cart-page__main">
                        <div class="cartsteps__title">Оплата</div>
                        <form action="{{ route('cart.checkout.store') }}" method="POST" id="orderForm">
                            @csrf
                        <div class="cartsteps__item cartstep">
                            <div class="cartstep__item">
                                <div class="cartstep__title">Выбрать способ оплаты</div>
                                <div class="cartstep__paymethods">
                                    @foreach(\App\Models\Order::ALL_PAYMENTS as $value => $title)
                                    <label class="radio">
                                        <input type="radio" name="payment_type" value="{{ $value }}" required/>
                                        <div class="radio__text">{{ $title }}</div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                        </div>

{{--                        <div class="cart-page__group">--}}
{{--                            <h3 class="cart-page__subheading subheading">Адрес для выставления счета</h3>--}}
{{--                            <label class="checkbox">--}}
{{--                                <input type="checkbox" name="as_delivery_address" @checked($cartService->getProperty(\App\Services\CartService::AS_DELIVERY_ADDRESS_KEY))/>--}}
{{--                                <div class="checkbox__text">Использовать как адрес доставки</div>--}}
{{--                            </label>--}}
{{--                            <div class="typography addressblock">--}}
{{--                                <p>{{ $address->full_name }}</p>--}}
{{--                                <p>{{ $address->phone }}</p>--}}
{{--                                <p>{{ $address->full_address }}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                            @if($user_has_cards = auth()->user()->cards->isNotEmpty())--}}
{{--						<h3 class="cart-page__heading subheading subheading--with-form">Выберите свою карту</h3>--}}
{{--                        <div class="cart-page__addresses">--}}
{{--                            @foreach(auth()->user()->cards as $card)--}}
{{--                                <div class="cart-page__address my-add">--}}
{{--                                    <div class="my-add__title">{{ $card->full_name }}</div>--}}
{{--                                    <div class="my-add__wrap">--}}
{{--                                        <label class="radio">--}}
{{--                                            <input type="radio" name="card_id" value="{{ $card->id }}" @checked($cartService->getProperty(\App\Services\CartService::CARD_KEY) == $card->id)/>--}}
{{--                                            <div class="radio__text">{{ \App\Services\SiteService::displayCardNumber($card->card_number) }}--}}
{{--                                                <br>{{ $card->valid_date }}</div>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                            @endif--}}

                        </form>


{{--						<div class="cart-page__group">--}}
{{--                            <a href="javascript:;" class="cart-page__subheading subheading subheading--with-form toggle-card">Добавить новую карту</a>--}}
{{--                            <div class="toggable" @if($user_has_cards) style="display: none" @endif>--}}
{{--                            @include('layouts.parts.create_payment')--}}
{{--                            </div>--}}
{{--						</div>--}}

                        @include('cart.includes.products_list_static')

						<div class="cart-page__group">
							<h3 class="cart-page__subheading subheading">Адрес доставки</h3>
							<div class="typography addressblock">
                                <p>{{ $address }}</p>
							</div>
						</div>
					</main>
					<aside class="cart-page__aside">
                        @include('cart.includes.aside', ['custom_btn_text' => 'Перейти к оплате'])
					</aside>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
