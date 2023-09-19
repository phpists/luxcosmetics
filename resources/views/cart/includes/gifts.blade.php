<input type="hidden" id="giftsUrl" value="{{ route('cart.gifts') }}">
@if($gift_products->isNotEmpty())
    <div class="cart-page__gifts">
        <h3 class="cart-page__subheading subheading">Ваши подарки</h3>
        @foreach($gift_products as $gift_product)
            <div class="cart-product cart-product--gift">
                <div class="cart-product__image">
                    <img src="{{ $gift_product->getImgSrc() }}" alt="">
                </div>
                <div class="cart-product__desc">
                    <div class="cart-product__title">{{ $gift_product->brand->name ?? 'UNDEFINED BRAND' }}</div>
                    <div class="cart-product__subtitle">{{ $gift_product->title }}</div>
                </div>
                <div class="cart-product__sum cart-product__sum--free">Бесплатно</div>
            </div>
        @endforeach
    </div>
@endif
