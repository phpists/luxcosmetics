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
    <div class="numbers addprod__numbers">
        <div class="numbers__minus minus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#minus')}}"></use></svg></div>
        <input type="text" class="numbers__input" value="1">
        <div class="numbers__plus plus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#plus')}}"></use></svg></div>
    </div>
    <div class="addprod__price">{{ $product->price }} ₽ </div>
</div>
