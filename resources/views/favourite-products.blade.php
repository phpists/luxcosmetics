@extends('layouts.app')
@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="crumbs__item">Избраное</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="category-page favorite-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">Избранное</div>
                    <div class="category-page__container">

                        <main class="category-page__main">

                            <div class="category-page__sortblock sortblock">
                                <div class="sortblock__sort sort">
                                    <span class="sort__title">Выберите категорию </span>
                                    <select name="" id="" class="sort__select">
                                        <option value="">Все товары</option>
                                        <option value="">Уход за кожей</option>
                                        <option value="">Уход за волосами</option>
                                    </select>
                                </div>
                            </div>
                            <div class="category-page__mobilenav">
                                <button class="category-page__mobilebtn btnsort">
                                    <svg class="icon">
                                        <use xlink:href="{{asset('images/dist/sprite.svg#arrows')}}"></use>
                                    </svg>
                                    Сортировать по
                                </button>
                            </div>
                            <div class="category-page__products">
                                @include('categories.parts.products', ['products' => $products, 'variations' => $variations])
                            </div>
                            @include('categories.parts.pagination')
{{--                            <div class="category-page__pagination pagination">--}}
{{--                                <button class="pagination__more">Показать еще <span>12 товаров</span>--}}
{{--                                    <svg class="icon">--}}
{{--                                        <use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use>--}}
{{--                                    </svg>--}}
{{--                                </button>--}}
{{--                                <ul class="pagination__list">--}}
{{--                                    <li class="pagination__item pagination__item--first"><a href="">--}}
{{--                                            <svg class="icon">--}}
{{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use>--}}
{{--                                            </svg>--}}
{{--                                        </a></li>--}}
{{--                                    <li class="pagination__item pagination__item--prev"><a href="">--}}
{{--                                            <svg class="icon">--}}
{{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use>--}}
{{--                                            </svg>--}}
{{--                                        </a></li>--}}
{{--                                    <li class="pagination__item pagination__item--active"><span>1</span></li>--}}
{{--                                    <li class="pagination__item"><a href="">2</a></li>--}}
{{--                                    <li class="pagination__item"><a href="">3</a></li>--}}
{{--                                    <li class="pagination__item pagination__item--dots">...</li>--}}
{{--                                    <li class="pagination__item"><a href="">36</a></li>--}}
{{--                                    <li class="pagination__item pagination__item--next"><a href="">--}}
{{--                                            <svg class="icon">--}}
{{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use>--}}
{{--                                            </svg>--}}
{{--                                        </a></li>--}}
{{--                                    <li class="pagination__item pagination__item--last"><a href="">--}}
{{--                                            <svg class="icon">--}}
{{--                                                <use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use>--}}
{{--                                            </svg>--}}
{{--                                        </a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="sortmobile">
        <div class="sortmobile__close">
            <svg class="icon">
                <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
            </svg>
        </div>
        <div class="sortmobile__title">Выберите категорию</div>
        <label class="radio">
            <input type="radio" name="sort"/>
            <div class="radio__text">Уход за кожей</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort"/>
            <div class="radio__text">Уход за телом</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort"/>
            <div class="radio__text">Уход за волосами</div>
        </label>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/app.min.js')}}"></script>
    <script src="{{asset('/js/favourites.js')}}"></script>
@endsection
