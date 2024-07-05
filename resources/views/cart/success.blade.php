@extends('layouts.app')

@section('title', $metaTitle = getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::CART))
@section('description', $metaDescription = getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::CART))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)

@section('content')

<section class="cart-page" style="margin-top: 40px">
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
                                <div class="chars__value"><span>{{ $order->num }}</span></div>
                            </div>
                            <div class="chars__item">
                                <div class="chars__name"><span>Ваше имя</span></div>
                                <div class="chars__value"><span>{{ $order->full_name }}</span></div>
                            </div>
                            <div class="chars__item">
                                <div class="chars__name"><span>Телефон</span></div>
                                <div class="chars__value"><span>{{ $order->phone }}</span></div>
                            </div>
                            <div class="chars__item">
                                <div class="chars__name"><span>E-mail</span></div>
                                <div class="chars__value"><span>{{ $order->user->email }}</span></div>
                            </div>
                            <div class="chars__item">
                                <div class="chars__name"><span>Способ доставки</span></div>
                                <div class="chars__value"><span>{{ \App\Models\Order::ALL_DELIVERIES[$order->delivery_type] ?? "???" }}</span></div>
                            </div>
                            <div class="chars__item">
                                <div class="chars__name"><span>Адресс доставки</span></div>
                                <div class="chars__value"><span>{{ $order->address }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('cart.includes.cabinet_list')

				<a href="{{ route('home') }}" class="btn btn--accent">Вернутся в  каталог</a>


			</div>
		</div>
	</div>
</section>

@endsection
