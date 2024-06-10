@extends('layouts.app')

@section('content')
    <div class="container">
        {!! \App\Models\Page::whereLink('403')->first()?->content !!}
    </div>

    @php($popular_products = \App\Models\Product::query()
        ->join('product_images', 'products.image_print_id', 'product_images.id')
        ->with('brand')
        ->with('product_variations')
        ->distinct(['products.id'])
        ->where('show_in_popular', true)
        ->limit(20)
        ->get())
    <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Популярные</h2>
                    <div class="products-slider">
                        @foreach($popular_products as $product)
                            <div class="products-slider__item">
                                @include('products._card')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
