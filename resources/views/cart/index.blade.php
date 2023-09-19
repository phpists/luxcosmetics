@extends('layouts.app')

@section('title', 'Корзина')

@php($cartService->getGiftProducts())

@section('content')
    <input type="hidden" id="min_sum" value="{{ \App\Services\SiteConfigService::getParamValue('min_checkout_sum') }}">

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
				<h1 class="title-h1">Корзина</h1>
				<div class="cart-page__container">
					<main class="cart-page__main">
						<div class="cart-table">
							<div class="cart-table__thead">
								<div class="cart-table__th cart-table__th--name">Наименование</div>
								<div class="cart-table__th cart-table__th--count">Количество</div>
								<div class="cart-table__th cart-table__th--price">Цена</div>
								<div class="cart-table__th cart-table__th--sum">Сумма</div>
							</div>
							<div id="cartProductsContainer" class="cart-table__body">
                                @forelse($cart_products as $product)
                                    <div class="cart-table__item cart-product @if(!$product->isAvailable()) unavailable @endif" data-product="{{ $product->id }}" data-property="{{ $product->baseValue->id ?? '' }}">
                                        <div class="cart-product__image">
                                            <a href="{{ route('products.product', ['alias' => $product->alias]) }}">
                                                <img src="{{ asset('images/uploads/products/' . $product->main_image) }}" alt=""></a>
                                        </div>
                                        <div class="cart-product__desc">
                                            <div class="cart-product__title">
                                                <a href="{{ route('products.product', ['alias' => $product->alias]) }}">{{ $product->brand?->name }}</a>
                                            </div>
                                            <div class="cart-product__subtitle">{{ $product->title }}</div>
                                            @if($product->baseProperty)
                                            <div class="cart-product__options">
                                                <div class="cart-product__option">Выбранный {{ mb_strtolower($product->baseProperty->name) }}:
                                                    <b>{{ ($product->baseValue->value ?? '') . ($product->baseProperty->measure ?? '') }}</b></div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="cart-product__numbers">
                                            <div class="numbers">
                                                <div class="numbers__minus minusQuantity" data-element="div.cart-product:first">
                                                    <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#minus')}}"></use></svg></div>
                                                <input type="text" class="numbers__input currentQuantity" value="{{ $product->quantity }}">
                                                <div class="numbers__plus plusQuantity" data-element="div.cart-product:first">
                                                    <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#plus')}}"></use></svg></div>
                                            </div>
                                        </div>
                                        <div class="cart-product__prices">
                                            <div class="cart-product__price">{{ $product->price }} ₽ </div>
                                            @if($product->old_price)
                                                <div class="cart-product__oldprice">{{ $product->old_price }} ₽ </div>
                                            @endif
                                        </div>
                                        <div class="cart-product__sum"><span class="currentSum">{{ round($product->price * $product->quantity, 2) }}</span> ₽</div>
                                        <button class="cart-product__delete removeFromCart" data-element="div.cart-product:first" data-product="{{ $product->id }}" data-property="{{ $product->baseValue->id ?? '' }}">
                                            <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg>
                                        </button>
                                    </div>
                                @empty
                                    <p>Корзина пустая</p>
                                @endforelse
							</div>
                            @if($cartService->isNotEmpty())
							<div class="cart-table__ftr">
								<a href="{{ route('cart.clear') }}" class="btn btn--border-main cart-page__clearcart">Очистить корзину</a>
							</div>
                            @endif
						</div>


                        @php($gift_products = $cartService->getGiftProducts())
                        <div id="giftsContainer">
                            @include('cart.includes.gifts')
                        </div>

                        <form action="{{ route('cart.store') }}" method="POST" id="orderForm">
                            @csrf
                            <div class="cart-page__giftbox">
                                <h3 class="cart-page__subheading subheading"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#gift')}}"></use></svg> Подарочная коробка</h3>
                                <label class="checkbox">
                                    <input type="checkbox" name="gift_box" @checked($cartService->getProperty(\App\Services\CartService::GIFT_BOX_KEY))/>
                                    <div class="checkbox__text">Добавить подарочную коробку</div>
                                </label>
                                <p><em>Подарочная коробка доступна только для заказов, которые доставляются на&nbsp;месте. Ваш счет будет отправлен вам по электронной почте.</em></p>
                            </div>
                        </form>



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
