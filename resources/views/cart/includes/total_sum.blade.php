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
        У вас на счету есть {{ auth()->user()->activeGiftCard->balance }}Р с подарочной карты - которые будут списыватся в первую очередь
    </div>
@endif
<div class="cart-aside__sum">Итого с НДС <span>{{ $cartService->getTotalSumWithDiscounts() }}</span> ₽</div>

@if($cartService->discount)
    <span>{{ $cartService->discount['title'] ?? 'UNDEFINED' }}: -{{ $cartService->discount['amount'] ?? 0 }}₽</span>
@endif
