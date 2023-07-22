<div class="cart-page__group">
    <h3 class="cart-page__subheading subheading">Состав заказа</h3>
    <div class="cart-table">
        <div class="cart-table__thead">
            <div class="cart-table__th cart-table__th--name">Наименование</div>
            <div class="cart-table__th cart-table__th--count-and-price">Цена и кол-во</div>
            <div class="cart-table__th cart-table__th--sum">Сумма</div>
        </div>
        <div class="cart-table__body">
            @foreach($cartService->getAllProducts() as $product)
                <div class="cart-table__item cart-product">
                    <div class="cart-product__image">
                        <a href="{{ route('products.product', ['alias' => $product->alias]) }}">
                            <img src="{{ asset('images/uploads/products/' . $product->main_image) }}" alt=""></a>
                    </div>
                    <div class="cart-product__desc">
                        <div class="cart-product__title">
                            <a href="{{ route('products.product', ['alias' => $product->alias]) }}">{{ $product->brand->name }}</a>
                        </div>
                        <div class="cart-product__subtitle">{{ $product->title }}</div>
                        <div class="cart-product__options">
                            @if($product->baseProperty)
                            <div class="cart-product__option">Выбранный {{ mb_strtolower($product->baseProperty->name) }}:
                                <b>{{ ($product->baseValue->value ?? '') . ($product->baseProperty->measure ?? '') }}</b></div>
                            @endif
                        </div>
                    </div>

                    <div class="cart-product__prices-and-count">
                        <div class="cart-product__price">{{ $product->quantity }} x {{ $product->price }} ₽  </div>
                        @if($product->old_price)
                            <div class="cart-product__oldprice">{{ $product->old_price }} ₽ </div>
                        @endif
                    </div>
                    <div class="cart-product__sum">{{ round($product->price * $product->quantity, 2) }} ₽</div>
                </div>
            @endforeach
            {{--									<div class="cart-table__item  cart-product cart-product--gift">--}}
            {{--										<div class="cart-product__image">--}}
            {{--											<a href=""><img src="{{asset('images/dist/tmp-product2.jpg')}}" alt=""></a>--}}
            {{--										</div>--}}
            {{--										<div class="cart-product__desc">--}}
            {{--											<div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>--}}
            {{--											<div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>--}}
            {{--										</div>--}}
            {{--										<div class="cart-product__sum cart-product__sum--free">Бесплатно</div>--}}
            {{--									</div>--}}
        </div>
    </div>
</div>
