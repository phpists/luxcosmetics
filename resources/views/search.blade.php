@extends('layouts.app')

@section('title', 'Поиск')
@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="/">Главная</a></li>
                        <li class="crumbs__item">Поиск</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="category-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">Результаты поиска по запросу {{$search}}</div>
                    <div class="category-page__container">
                        <aside class="category-page__aside">
                            <div class="filters" id="filters">
                                <form id="filterForm"
                                      action="{{ route('show_search') }}">
                                    <input type="hidden" id="search_needle" name="search" value="{{request()->input('search')}}">
                                    <input type="hidden" name="sort">
                                    <input type="hidden" id="filterMinPrice" value="{{ $products->min('price') ?? 1 }}">
                                    <input type="hidden" id="filterMaxPrice"
                                           value="{{ $products->max('price') ?? 99999 }}">

                                    <div class="filters__close">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
                                        </svg>
                                    </div>
                                    <div class="filters__wrapper">
                                        <div class="filters__item filter">
                                            <div class="filter__title">Цена
                                                <svg class="icon">
                                                    <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                                                </svg>
                                            </div>
                                            <div class="filter__block">
                                                <div class="filter__wrap">
                                                    <div class="filter__range" id="slider-range"></div>
                                                    <div class="filter__row">
                                                        <div class="filter__col">
                                                            <span>от</span>
                                                            <input type="number" name="price[from]"
                                                                   class="filter__input" id="amount"
                                                                   value="{{ request()->input('price.from') ?? \App\Services\CatalogService::PRICE_FROM }}">
                                                        </div>
                                                        <div class="filter__col">
                                                            <span>до</span>
                                                            <input type="number" name="price[to]" class="filter__input"
                                                                   id="amount2"
                                                                   value="{{ request()->input('price.to') ?? \App\Services\CatalogService::PRICE_TO }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
{{--                                    <div class="filters__ftr">--}}
{{--                                        <button type="submit" class="filters__btn">Показать</button>--}}
{{--                                        <a href="{{ route('categories.show', ['alias' => $category->alias]) }}"--}}
{{--                                           class="filters__btn">Сбросить</a>--}}
{{--                                    </div>--}}

                                </form>

                            </div>

                            <div class="category-page__image"><img src="" alt=""></div>
                        </aside>
                        <main class="category-page__main">
{{--                            <ul class="category-page__subcategories">--}}
{{--                                @foreach($category->subcategories as $subcategory)--}}
{{--                                    <li>--}}
{{--                                        <a href="/c/{{$subcategory->alias}}" class="category-page__subcategory">--}}
{{--                                            <span class="category-page__subcategory-image"><img src="{{asset('images/uploads/categories/'.$subcategory->image)}}" alt=""></span>--}}
{{--                                            <span class="category-page__subcategory-title">{{$subcategory->name}}</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
                            <div class="category-page__sortblock sortblock">
                                <div class="sortblock__total">Показано <b><span id="current_items_number">{{$shown_count}}</span> из {{$products->total()}}</b></div>
                                <div class="sortblock__sort sort">
                                    <span class="sort__title">Сортировать по</span>
                                    <select name="" id="" class="sort__select">
                                        <option value="">Возрастанию цены</option>
                                        <option value="">Убыванию цены</option>
                                    </select>
                                </div>
                            </div>
                            <div class="category-page__mobilenav">
                                <button class="category-page__mobilebtn btnfilters"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#filters')}}"></use></svg> Показать фильтры</button>
                                <button class="category-page__mobilebtn btnsort"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrows')}}"></use></svg> Сортировать по</button>
                            </div>
                            <div class="category-page__products">
                                {!! $products_list !!}
                            </div>
{{--                            <div class="category-page__pagination pagination">--}}
{{--                                <button class="pagination__more">Показать  еще <span>12 товаров</span> <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use></svg></button>--}}
{{--                                <ul class="pagination__list">--}}
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
{{--                            </div>--}}
                            <div id="paginate-container">
                                {!! $pagination !!}
                            </div>
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
    <script>
        $(document).ready(function () {
            $('.pagination__more').on('click', function () {
                let is_disabled = $('.pagination__item--next').attr('aria-disabled')
                if(is_disabled === 'false') {
                    let nextPage = parseInt($('.pagination__item--active').attr('aria-current')) + 1;
                    let search = document.getElementById('search_needle').value;
                    $.ajax({
                        url: '{{route('show_search')}}?page='+nextPage+'&search='+search,
                        success: function (response) {
                            $('.category-page__products').append(response['data']);
                            let next_link = document.querySelector('.pagination__item--next');
                            if(response['next_link'] !== null) {
                                next_link.children[0].href = response['next_link'];
                            }
                            else {
                                next_link.setAttribute('aria-disabled', 'true');
                                next_link.children[0].href = '#';
                            }
                            document.getElementById('current_items_number').innerHTML = response['shown_count'];
                            let active_class = 'pagination__item--active';
                            document.querySelector(`.${active_class}`).classList.remove(active_class);
                            let curr_item = document.querySelector(`.pagination__item[data-label="${response['current_page']}"]`);
                            curr_item.classList.add(active_class);
                            curr_item.innerHTML = `<span>${nextPage}</span>`;
                        },
                        error: function (response) {
                            console.log(response)
                        }
                    })
                }
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
                    name: "load",
                    value: true
                });
                data.push({
                    name: "full",
                    value: '1'
                })

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
                        document.querySelector('.category-page__products').innerHTML = response['data'];
                        document.getElementById('paginate-container').innerHTML = response['pagination'];

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
