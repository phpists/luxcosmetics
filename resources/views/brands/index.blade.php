@extends('layouts.app')

@section('title', 'Бренд')

@section('styles')
    <style>
        .loading:after {
            content: '';
            background: url({{ asset('images/loading.gif') }}) center;
            height: 256px;
            width: 256px;
            display: block;
            position: absolute;
            left: 50%;
            top: 40%;
            z-index: 999;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none; // Yeah, yeah everybody write about it
        }

        input[type='number'],
        input[type="number"]:hover,
        input[type="number"]:focus {
            appearance: none;
            -moz-appearance: textfield;
        }
    </style>
@endsection


@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="{{ route('home') }}">Главная</a></li>
                        <li class="crumbs__item"><a href="{{ route('brands') }}">Бренды</a></li>
                        <li class="crumbs__item">{{$brands->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="category-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">{{$brands->name}}</div>
                    <div class="category-page__container">
                        <aside class="category-page__aside">
                            <div class="filters" id="filters">

                                <form id="filterForm" action="{{ route('brands.show', ['link' => $brands->link]) }}">

                                    <input type="hidden" name="sort">

                                <div class="filters__close"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg></div>
                                <div class="filters__hdr">
                                    <div class="filters__title">Сортировать по</div>
                                    <a href="{{ route('brands.show', ['link' => $brands->link]) }}" class="filters__btn">Сбросить все</a>
                                </div>
                                <div class="filters__wrapper">
                                    <div class="filters__item filter">
                                        <div class="filter__title">Цена <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></div>
                                        <div class="filter__block">
                                            <div class="filter__wrap">
                                                <div class="filter__range" id="slider-range"></div>
                                                <div class="filter__row">
                                                    <div class="filter__col">
                                                        <span>от</span>
                                                        <input type="number" name="price[from]" class="filter__input" id="amount" value="{{ request()->input('price.from') ?? \App\Services\CatalogService::PRICE_FROM }}">
                                                    </div>
                                                    <div class="filter__col">
                                                        <span>до</span>
                                                        <input type="number" name="price[to]" class="filter__input" id="amount2" value="{{ request()->input('price.to') ?? \App\Services\CatalogService::PRICE_TO }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($category->filter_properties as $category_property)
                                    <div class="filters__item filter">
                                        <div class="filter__title">{{ $category_property->name }} ({{ $category_property->measure }}) <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></div>
                                        <div class="filter__block">
                                            <div class="filter__wrap filter__scroll">
                                                @foreach($category_property->values as $property_value)
                                                <label class="checkbox">
                                                    <input type="checkbox" name="properties[{{ $category_property->id }}][]" value="{{ $property_value->id }}" @if(is_array(request()->input("properties.".$category_property->id)) && in_array($property_value->id, request()->input("properties.".$category_property->id))) checked @endif/>
                                                    <div class="checkbox__text">{{ $property_value->value }}</div>
                                                </label>
                                                @endforeach
                                            </div>
                                            @if($category_property->values->count() > 3)
                                                <button class="filter__all">Показать все</button>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="filters__ftr">
                                    <button type="submit" class="filters__btn">Показать</button>
                                    <a href="{{ route('brands.show', ['link' => $brands->link]) }}" class="filters__btn">Сбросить</a>
                                </div>
                                </form>
                            </div>
                            <div class="category-page__image"><img src="" alt=""></div>
                        </aside>
                        <main class="category-page__main">
                            <ul class="category-page__subcategories">
                                @foreach($category->tags as $tag)
                                    <li>
                                        <a href="/{{$tag->link}}" class="category-page__subcategory">
                                            <span class="category-page__subcategory-image"><img src="{{$tag->getImageSrcAttribute()}}" alt=""></span>
                                            <span class="category-page__subcategory-title">{{$tag->name}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div id="catalog">
                                {!! $products_list !!}
                            </div>

                           {{-- <div class="category-page__pagination pagination">--}}
                               {{-- <button class="pagination__more">Показать  еще <span>12 товаров</span> <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use></svg></button>--}}
                               {{-- <ul class="pagination__list">--}}
{{--                                    <li class="pagination__item pagination__item--first"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use></svg></a></li>--}}
{{--                                    <li class="pagination__item pagination__item--prev"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use></svg></a></li>--}}
{{--                                    <li class="pagination__item pagination__item--active"><span>1</span></li>--}}
{{--                                    <li class="pagination__item"><a href="">2</a></li>--}}
{{--                                    <li class="pagination__item"><a href="">3</a></li>--}}
{{--                                    <li class="pagination__item pagination__item--dots">...</li>--}}
{{--                                    <li class="pagination__item"><a href="">36</a></li>--}}
{{--                                    <li class="pagination__item pagination__item--next"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use></svg></a></li>--}}
{{--                                    <li class="pagination__item pagination__item--last"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use></svg></a></li>--}}
{{--                                </ul>--}}
{{--                            </div> --}}
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="seoblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="seoblock__wrapper">
                        <h1 class="seoblock__title">Уход за телом: натуральная косметика для красоты и здоровья</h1>
                        <div class="seoblock__content">Забота о красоте и здоровье вашей кожи становится приятным и эффективным с нашим широким ассортиментом продуктов для ухода за телом. В нашем интернет-магазине косметики вы найдете все необходимые средства для ежедневного ухода и специальных процедур, которые подарят вашей коже мягкость, увлажнение и сияние. Откройте для себя мир натуральной косметики, разработанной с использованием последних инноваций и проверенных временем рецептов.</div>
                        <div class="seoblock__content is-hidden" id="seohidden">Забота о красоте и здоровье вашей кожи становится приятным и эффективным с нашим широким ассортиментом продуктов для ухода за телом. В нашем интернет-магазине косметики вы найдете все необходимые средства для ежедневного ухода и специальных процедур, которые подарят вашей коже мягкость, увлажнение и сияние. Откройте для себя мир натуральной косметики, разработанной с использованием последних инноваций и проверенных временем рецептов.</div>
                        <div class="seoblock__morecontent">Показать еще</div>
                        <div class="seoblock__tags">
                            <a href="" class="seoblock__tag">кремы для тела</a>
                            <a href="" class="seoblock__tag">гели для душа</a>
                            <a href="" class="seoblock__tag">скрабы для тела</a>
                            <a href="" class="seoblock__tag">масла для тела</a>
                            <a href="" class="seoblock__tag">борьба с растяжками</a>
                            <a href="" class="seoblock__tag">кремы для тела</a>
                            <a href="" class="seoblock__tag">гели для душа</a>
                            <a href="" class="seoblock__tag">скрабы для тела</a>
                            <a href="" class="seoblock__tag">масла для тела</a>
                            <a href="" class="seoblock__tag">борьба с растяжками</a>
                            <a href="" class="seoblock__tag">кремы для тела</a>
                            <a href="" class="seoblock__tag">гели для душа</a>
                            <a href="" class="seoblock__tag">скрабы для тела</a>
                            <a href="" class="seoblock__tag">масла для тела</a>
                            <a href="" class="seoblock__tag">борьба с растяжками</a>
                        </div>
                        <div class="seoblock__moretags">Развернуть</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="sortmobile">
        <div class="sortmobile__close"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg></div>
        <div class="sortmobile__title">Сортировать</div>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">По убыванию цены</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">По возрастанию цены</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">По популярности</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">По новизне</div>
        </label>
    </div>
@endsection

@section('after_content')
    <div class="filters-overlay"></div>
    <div class="hidden">
        <!-- <form action="" class="form" id="callback">
            <h3>Оставить сообщение</h3>

            <input type="text"  name="Имя" placeholder="Ваше имя"  required="required">
            <input type="text"  name="Телефон" placeholder="Номер телефона" required="required">
            <input type="text"  name="E-mail" placeholder="E-mail" required="required">
            <textarea name="Сообщение" placeholder="Сообщение"></textarea>
            <button class="btn btn-feed">Отправить</button>
        </form> -->
        @include('layouts.includes.purchase_modal')
    </div>
    <div class="done-w">
        <div class="done-window">
            <div class="done-window__icn"></div>
            <div class="done-window__title">Ваша заявка принята</div>
            <div class="done-window__subtitle">Наш менеджер свяжется с Вами в течении 15 минут</div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/app.min.js')}}"></script>
    <script src="{{asset('/js/favourites.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.pagination__more', function () {
                let is_disabled = $('.pagination__item--next').attr('aria-disabled')
                if(is_disabled === 'false') {
                    let url = this.dataset.url
                    $.ajax({
                        url: url,
                        data: {
                            load_more: true
                        },
                        success: function (response) {
                            $('#catalog div.category-page__products').append(response.products)
                            $('#catalog div.category-page__pagination').remove()
                            $('#catalog').append(response.pagination)
                            let currentlyShowedCount = parseInt($('#currentlyShowedCount').text());
                            $('#currentlyShowedCount').text(currentlyShowedCount + response.new_count)
                        },
                        error: function (response) {
                            console.log(response)
                        }
                    })
                }
            })

            $(document).on('click', '.pagination__item', function(e) {
                e.preventDefault();
                let url = $(this).find('a').attr('href');

                if (url !== '#') {
                    $.ajax({
                        url: url,
                        data: {
                            change_page: true
                        },
                        beforeSend: function () {
                            $('#catalog').addClass('loading')
                        },
                        success: function (response) {
                            $('#catalog').html(response.html)
                        },
                        error: function (response) {
                            console.log(response)
                        },
                        complete: function () {
                            $('#catalog').removeClass('loading')
                        }
                    })
                }

                return false
            })

            $(document).on('change', '#select_sort_preview', function(e) {
                $('#filterForm input[name="sort"]').val(this.value)
                $('#filterForm').trigger('change')
            })

            $(document).on('slidechange', '#slider-range', function(e) {
                $('#filterForm').trigger('change')
            })
            $(document).on('change', '#amount', function(e) {
                $('#filterForm').trigger('change')
                $('#slider-range').slider( "values", 0, this.value);
            })
            $(document).on('change', '#amount2', function(e) {
                $('#filterForm').trigger('change')
                $('#slider-range').slider( "values", 1, this.value);
            })

            $(document).on('change', '#filterForm', function(e) {
                let data = $(this).serializeArray();
                data.push({
                    name: "load", value: true
                });

                const uri_data = new FormData(this);
                const queryString = new URLSearchParams(uri_data).toString();

                let uri = location.pathname + '?' + queryString

                $.ajax({
                    type: 'GET',
                    data: data,
                    beforeSend: function () {
                        $('#catalog').addClass('loading')
                    },
                    success: function (response) {
                        $('#catalog').html(response.html)
                    },
                    complete: function () {
                        $('#catalog').removeClass('loading')
                        history.replaceState(null, null, uri)
                    }
                })
            })

            $(document).on('submit', '#filterForm', function(e) {
                e.preventDefault()
                $(this).trigger('change')
                return false
            })

        })
    </script>
@endsection
