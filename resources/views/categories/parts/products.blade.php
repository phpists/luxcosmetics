@foreach($products as $product)
    <div class="category-page__product">

        @include('products._card', ['is_favourite_page' => $is_favourite_page?? false])

    </div>
@endforeach
