<div class="cart-aside">
    <div class="cart-aside__accordeon">
        <dl>
            <dt>Использовать промокод
                <svg class="icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                </svg>
            </dt>
            <dd>
                <form action="" class="form">
                    <input type="text" class="form__input" placeholder="Введите промокод">
                    <button class="btn btn--accent">Применить</button>
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
            <span class="cart-aside__delivery-name">Доставка <small>Бесплатная доставкав течении 1-2 дней</small></span>
            <span class="cart-aside__delivery-value">Бесплатно</span>
        </div>
        @if($cartService->getBonusAmount() > 0)
        <div class="cart-aside__points">
            <svg class="icon">
                <use xlink:href="{{asset('images/dist/sprite.svg#warning')}}"></use>
            </svg>
            Вы получите {{ $cartService->getBonusAmount() }} баллов
        </div>
        @endif
        @if(auth()->check() && auth()->user()->hasGiftCardBalance())
        <div class="cart-aside__points">
            <svg class="icon">
                <use xlink:href="{{asset('images/dist/sprite.svg#warning')}}"></use>
            </svg>
            У вас на счету есть {{ auth()->user()->gift_card_balance }}Р с подарочной карты - которые будут списыватся в первую очередь
        </div>
        @endif
        <div class="cart-aside__sum">Итого с НДС <span>{{ $cartService->getTotalSumWithDiscounts() }}</span> ₽</div>

        @foreach($cartService->discount_reasons as $discount_reason)
            <span>{{ $discount_reason['title'] }}: -{{ $discount_reason['amount'] }}₽</span>
        @endforeach

    </div>
    <button type="submit" form="orderForm" class="btn btn--accent cart-aside__buy cartSubmit">Перейти к оплате</button>
    <div class="cart-aside__paymethods">
        <img src="{{asset('images/dist/ico-visa.png')}}" alt="visa">
        <img src="{{asset('images/dist/ico-mir.png')}}" alt="mir">
        <img src="{{asset('images/dist/ico-youmoney.png')}}" alt="youmoney">
    </div>
</div>
