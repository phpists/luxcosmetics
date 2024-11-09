@if(isset($gridItems) && !empty($gridItems))
@foreach($gridItems as $row => $items)
    @foreach($items as $item)
        @if($item instanceof \App\Models\Product)
            <div class="category-page__product">
                @include('products._card', ['product' => $item, 'is_favourite_page' => $is_favourite_page?? false])
            </div>
        @elseif($item instanceof \App\Models\CatalogBanner)
            @include("catalog.banners.{$item->type}", ['catalogBanner' => $item])
        @endif
    @endforeach
@endforeach
@else
    @foreach($products as $product)
        <div class="category-page__product">
            @include('products._card', ['is_favourite_page' => $is_favourite_page ?? false])
        </div>
    @endforeach
@endif
