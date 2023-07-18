<div class="addprod__image"><img src="{{ asset('images/uploads/products/'.$product->main_image) }}" alt=""></div>
<div class="addprod__wrap">
    <div class="addprod__title">
        <a href="{{ route('products.product', ['alias' => $product->alias]) }}">{{ $product->brand->name }}</a>
    </div>
    <div class="addprod__subtitle">{{ $product->title }}</div>
    <div class="addprod__options">
        <div class="addprod__option">Выбранный {{ mb_strtolower($product->baseProperty->name) }}:
            <b>{{ ($product->baseValue->value ?? '') . ($product->baseProperty->measure ?? '') }}</b></div>
    </div>
    <div class="addprod__price">{{ $product->price }} ₽ </div>
</div>
