<div class="swiper-slide prodblock-slider__item">
    <article class="product">
        <div class="product__image">
            <a href="{{ route('products.product', ['alias' => $product->alias]) }}">
                <img class="product__front" src="{{asset('images/uploads/products/'.$product->imagePrint->path)}}"
                     alt="">
            </a>
            <div class="product__labels">
                <div class="product__label product__label--red">
                    -4%
                </div>
                <div class="product__label product__label--green">Новинка</div>
                <div class="product__label product__label--yellow">
                    Хит
                </div>
            </div>
            <button class="product__btnbuy">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#cart') }}"></use>
                </svg>
            </button>
            <button class="product__btnfav">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#heart') }}"></use>
                </svg>
            </button>
        </div>
        <div class="product__body">
            <div class="product__wrap">
                <div class="product__prices" data-title="За объем 10 мл.">
                    <div class="product__price">{{ $product->price }} ₽</div>
                    @isset($product->old_price)
                        <div class="product__oldprice">{{ $product->old_price }} ₽</div>
                    @endisset
                </div>
                <div class="product__options">
                    <label class="product__option option">
                        <input class="option__input" type="radio" name="volume">
                        <div class="option__text">10</div>
                    </label>
                    <label class="product__option option">
                        <input class="option__input" type="radio" name="volume">
                        <div class="option__text">50</div>
                    </label>
                </div>
            </div>
            <a class="product__title"
               href="{{ route('products.product', ['alias' => $product->alias]) }}"><span>{{$product->brand?->name}}</span>{{$product->title}}
            </a>
            <div class="product__footer">
                <div class="product__rating">
                    <svg>
                        <use xlink:href="./images/sprite.svg#star"></use>
                    </svg>
                    {{ $product->publishedComments->avg('rating') }}
                </div>
                <div class="product__reviews">
                    {{ $product->publishedComments->count() }} отзыва
                </div>
            </div>
        </div>
    </article>
</div>
