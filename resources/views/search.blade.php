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
                            <div class="filters" id="filters" style="height: 100%!important;">
                                @include('categories.parts.filter',
                                        ['is_not_brands' => true, 'custom_route' => route('show_search')])
                            </div>

                            <div class="category-page__image"><img src="" alt=""></div>
                        </aside>
                        <main class="category-page__main" id="catalog">
                            {!! $products_list !!}
                        </main>
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
    <script src="{{asset('/js/favourites.js')}}"></script>
    <script src="{{asset('/js/catalog.js')}}"></script>
@endsection
