@extends('layouts.app')
@section('content')
    @php
        $page = \App\Models\Menu::query()->where('link', '/'.$currentRoute)->first();
        $selected_cat = null;
        if (request()->category_id !== null) {
            $selected_cat = $categories->find(request()->category_id);
        }
    @endphp
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="{{route('home')}}">Главная</a></li>
                        @if($selected_cat !== null)
                            <li class="crumbs__item"><a href="{{route($currentRoute)}}">{{$page?->title}}</a></li>
                            <li class="crumbs__item">{{$selected_cat?->name}}</li>
                        @else
                            <li class="crumbs__item">{{$page?->title}}</li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="category-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">{{$page?->title}}</div>
                    <div class="category-page__container">
                        <aside class="category-page__aside">
                            <ul class="cabmenu cabmenu--white">
                                @foreach($categories as $category)
                                    <li @if($selected_cat?->id === $category->id) class="is-active" @endif><a href="{{route($currentRoute, ['category_id' => $category->id])}}">{{$category->name}}</a></li>
                                @endforeach
{{--                                <li class="is-active"><a href="">Уход за кожей</a></li>--}}
{{--                                <li><a href="">Уход за телом</a></li>--}}
{{--                                <li><a href="">Уход за волосами</a></li>--}}
{{--                                <li><a href="">Ароматы для дома</a></li>--}}
                            </ul>
                            <div class="filters" id="filters" style="height: 100%!important;">
                                @include('categories.parts.filter', ['is_not_brands' => true])
                            </div>

                            <div class="category-page__image"><img src="" alt=""></div>
                        </aside>
                        <main class="category-page__main">
                            <ul class="category-page__subcategories">
                                @foreach($categories as $category)
                                    @foreach($category->tags as $tag)
                                        <li>
                                            <a href="/{{$tag->link}}" class="category-page__subcategory">
                                                <span class="category-page__subcategory-image"><img src="{{$tag->getImageSrcAttribute()}}" alt=""></span>
                                                <span class="category-page__subcategory-title">{{$tag->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                            <div id="catalog">
                                {!! $products_list !!}
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
                        <div class="seoblock__content">Забота о красоте и здоровье вашей кожи становится приятным и
                            эффективным с нашим широким ассортиментом продуктов для ухода за телом. В нашем
                            интернет-магазине косметики вы найдете все необходимые средства для ежедневного ухода и
                            специальных процедур, которые подарят вашей коже мягкость, увлажнение и сияние. Откройте для
                            себя мир натуральной косметики, разработанной с использованием последних инноваций и
                            проверенных временем рецептов.
                        </div>
                        <div class="seoblock__content is-hidden" id="seohidden">Забота о красоте и здоровье вашей кожи
                            становится приятным и эффективным с нашим широким ассортиментом продуктов для ухода за
                            телом. В нашем интернет-магазине косметики вы найдете все необходимые средства для
                            ежедневного ухода и специальных процедур, которые подарят вашей коже мягкость, увлажнение и
                            сияние. Откройте для себя мир натуральной косметики, разработанной с использованием
                            последних инноваций и проверенных временем рецептов.
                        </div>
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
        <div class="sortmobile__close">
            <svg class="icon">
                <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
            </svg>
        </div>
        <div class="sortmobile__title">Сортировать</div>
        <label class="radio">
            <input type="radio" name="sort"/>
            <div class="radio__text">По убыванию цены</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort"/>
            <div class="radio__text">По возрастанию цены</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort"/>
            <div class="radio__text">По популярности</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort"/>
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
