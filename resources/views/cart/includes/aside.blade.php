<div class="cart-aside">
    <div class="cart-aside__accordeon">
        <dl>
            <dt>Использовать промокод
                <svg class="icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                </svg>
            </dt>
            <dd>
                <form action="{{ route('cart.use-promo') }}" method="POST" class="form">
                    @csrf
                    <input type="text" class="form__input" placeholder="Введите промокод" name="code" @if($cartService->isUsedPromo()) value="{{ $cartService->getPromoCode() }}" @endif>
                    <button type="submit" class="btn btn--accent">Применить</button>
                </form>
            </dd>
        </dl>
        <dl>
            <dt>Подарочная карта
                <svg class="icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                </svg>
            </dt>
            <dd>
                <form action="{{ route('profile.gift-cards.activate') }}" method="POST" class="form">
                    @csrf
                    <input type="text" class="form__input" name="code" placeholder="Введите номер подарочной карты">
                    <button class="btn btn--accent">Применить</button>
                </form>
            </dd>
        </dl>
        <dl>
            <dt>Использовать баллы
                <svg class="icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                </svg>
            </dt>
            <dd>
                @if(auth()->check())
                <div class="formsuccess">{!! $cartService->getUserBonusesMessage() !!}</div>
                @endif
                <form action="{{ route('cart.use-bonuses') }}" method="POST" class="form">
                    @csrf
                    <input type="text" class="form__input" placeholder="Введите количество баллов" name="amount" @if($cartService->isUsedBonuses()) value="{{ $cartService->getUsedBonusesDiscount() }}" @endif>
                    <button type="submit" class="btn btn--accent">Применить</button>
                </form>
            </dd>
        </dl>
    </div>

    <div class="cart-aside__total">
        <div class="cart-aside__delivery">
            <span class="cart-aside__delivery-name">Доставка
                <small>{{ \App\Services\SiteConfigService::getParamValue('cart_delivery_label') }}</small>
            </span>
            <span class="cart-aside__delivery-value">Бесплатно</span>
        </div>

        <div id="cartTotalBlock">
            @include('cart.includes.total_sum')
        </div>

    </div>

    @if(!$cartService->canCheckout())
        <div class="formerror">{{ $cartService->canNotCheckoutMessage() }}</div>
    @endif
    <button type="submit" form="orderForm" class="btn btn--accent cart-aside__buy cartSubmit" @disabled(!$cartService->canCheckout())>
        Перейти к оплате</button>

    <div class="cart-aside__paymethods">
        <img src="{{asset('images/dist/ico-visa.png')}}" alt="visa">
        <img src="{{asset('images/dist/ico-mir.png')}}" alt="mir">
        <img src="{{asset('images/dist/ico-youmoney.png')}}" alt="youmoney">
    </div>
</div>
