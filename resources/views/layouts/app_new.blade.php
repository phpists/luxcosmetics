<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">

    <meta property="og:title" content="@yield('og:title')">
    <meta property="og:description" content="@yield('og:description')">
    <meta property="og:image" content="{{ asset('/images/dist/preview.jpg') }}">
    <meta property="og:url" content="@yield('og:url')"/>
    <meta property="og:type" content="website">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#06473A">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="/favicon-16x16.png" sizes="16x16">
    <link rel="icon" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="/android-chrome-192x192.png" sizes="192x192">
    <link rel="stylesheet" href="{{ asset('new_css/main.css?v=1750166320486') }}">
    @yield('styles')
</head>
<body class="indexpage">
<header class="header header--index">
    <div class="header__wrapper">
        <div class="header__social social for-desktop header__el">
            <a class="social__item" href="">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#vk') }}"></use>
                </svg>
            </a>
            <a class="social__item" href="">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#whatsapp') }}"></use>
                </svg>
            </a>
            <a class="social__item" href="">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#tg') }}"></use>
                </svg>
            </a>
        </div>
        <div class="header__logo header__el"><img src="{{ asset('images/logo.svg') }}" alt=""></div>
        <div class="header__nav navpanel header__el"><a class="navpanel__item popup-with-form" href="#search">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#search') }}"></use>
                </svg>
            </a><a class="navpanel__item popup-with-form hidemobile" href="#auth">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#user') }}"></use>
                </svg>
            </a><a class="navpanel__item hidemobile" href="">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#heart') }}"></use>
                </svg>
                <span>
               4</span></a><a class="navpanel__item popup-with-form hidemobile" href="#cart">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#cart') }}"></use>
                </svg>
                <span>
               12</span></a><a class="navpanel__item btn-menu for-devices btn-hidepanels" id="btn-menu" href="#menu">
                <svg>
                    <use xlink:href="{{ asset('images/sprite.svg#menu') }}"></use>
                </svg>
            </a></div>
    </div>
    <nav class="header__navigation">
        <ul>
            <li><a href="">Бренды</a></li>
            <li><a href="">Бестселлеры</a></li>
            <li><a href="">Уход</a></li>
            <li><a href="">Волосы</a></li>
            <li><a href="">Парфюмерия</a></li>
            <li><a href="">Подарочные наборы</a></li>
            <li><a href="">Новинки </a></li>
            <li><a href="">Акции</a></li>
        </ul>
    </nav>
</header>
<div class="page-wrapper page">
    @yield('before_content')
    @php
        $menu_items = \App\Models\Menu::query()->where('is_active', 1)->orderBy('position')->get();
    @endphp
    @php
        $static_pages = \App\Models\Page::query()->where('is_active', 1)->get();
    @endphp
    @php
        $social = \App\Models\SocialMedia::query()->select('social_medias.*')->get();
    @endphp
    @yield('content')
</div>
<section class="modalform modalform--center modalform--medium authform" id="auth">
    <div class="modalform__container">
        <div class="modalform__closebtn">
            <svg>
                <use xlink:href="./images/sprite.svg#close"></use>
            </svg>
        </div>
        <div class="authform__step authform__step--1">
            <div class="modalform__heading">
                Покупайте<br> со скидкой
            </div>
            <div class="modalform__subheading">
                Зарегистрируйтесь, чтобы получить скидку по бонусной карте, начать копить бонусы и оплачивать покупки
                подарочными сертификатами
            </div>
            <div class="authform__btns">
                <div class="btn btn--primary" id="authform-go-step-2">Войти / Зарегистрироваться</div>
                <a class="btn btn--secondary" href="checkout.html">Продолжить как гость</a>
            </div>
        </div>
        <div class="authform__step authform__step--2">
            <div class="modalform__heading">
                Войти<br> или зарегистрироваться
            </div>
            <div class="modalform__subheading">
                Позвоним или отправим код.<br> Введите последние 4 цифры номера телефона или код из сообщения
            </div>
            <form class="authform__form form" action="">
                <div class="form__fieldset">
                    <legend class="form__legend">
                        Введите ваш номер телефона
                    </legend>
                    <input class="form__input phonemask" type="text" placeholder="+7 (___) ___ - __ - __">
                </div>
                <div class="btn btn--primary btn--100" id="authform-go-step-3">Получить код</div>
            </form>
        </div>
        <div class="authform__step authform__step--3">
            <div class="modalform__heading">
                Войти<br> или зарегистрироваться
            </div>
            <div class="modalform__subheading">
                Позвоним или отправим код.<br> Введите последние 4 цифры номера телефона или код из сообщения
            </div>
            <form class="authform__form form" action="">
                <div class="form__fieldset">
                    <legend class="form__legend">
                        Введите код из СМС
                    </legend>
                    <input class="form__input" id="sms" type="text">
                </div>
                <button class="btn btn--primary btn--100">Войти</button>
            </form>
        </div>
    </div>
</section>
<section class="modalform modalform--medium modalcart" id="cart">
    <div class="modalform__container" data-lenis-prevent>
        <div class="modalform__closebtn">
            <svg>
                <use xlink:href="./images/sprite.svg#close"></use>
            </svg>
        </div>
        <div class="modalform__heading">
            Корзина
            <button class="modalcart__clear">
                Очистить корзину
            </button>
        </div>
        <div class="modalform__emptycart is-hidden">Посмотрите наши <a href="">новинки</a> или воспользуйтесь <a
                href="">поиском</a> если ищете что-то конкретное
        </div>
        <div class="modalcart__progress cartprogress">
            <div class="cartprogress__progress"><span style="width: 48%"></span></div>
            <div class="cartprogress___subtitle">Еще <b>220₽</b> до бесплатной доставки</div>
        </div>
        <div class="modalcart__products">
            <div class="modalcart__product m-prod">
                <div class="m-prod__image"><a href=""><img src="images/tmp/product-big.png" alt=""></a></div>
                <div class="m-prod__desc">
                    <div class="m-prod__wrap"><a class="m-prod__title" href="">YVES SAINT LAURENT </a>
                        <div class="m-prod__subtitle">Libre Eau de Parfum (50ml)</div>
                    </div>
                    <div class="m-prod__options">
                        <div class="m-prod__option">
                            Выбранный цвет: <span>Red</span></div>
                        <div class="m-prod__option">
                            Выбранный размер: <span>90ml</span></div>
                    </div>
                </div>
                <div class="m-prod__nav">
                    <div class="counter">
                        <div class="counter__btn counter__btn--minus">
                            <svg>
                                <use xlink:href="./images/sprite.svg#minus"></use>
                            </svg>
                        </div>
                        <input class="counter__input" type="text" value="1">
                        <div class="counter__btn counter__btn--plus">
                            <svg>
                                <use xlink:href="./images/sprite.svg#plus"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="m-prod__price">10 073 ₽</div>
                </div>
                <div class="m-prod__del">
                    <svg>
                        <use xlink:href="./images/sprite.svg#close2"></use>
                    </svg>
                </div>
            </div>
            <div class="modalcart__product m-prod">
                <div class="m-prod__image"><a href=""><img src="images/tmp/product-big.png" alt=""></a></div>
                <div class="m-prod__desc">
                    <div class="m-prod__wrap"><a class="m-prod__title" href="">YVES SAINT LAURENT </a>
                        <div class="m-prod__subtitle">Libre Eau de Parfum (50ml)</div>
                    </div>
                    <div class="m-prod__options">
                        <div class="m-prod__option">
                            Выбранный цвет: <span>Red</span></div>
                        <div class="m-prod__option">
                            Выбранный размер: <span>90ml</span></div>
                    </div>
                </div>
                <div class="m-prod__nav">
                    <div class="counter">
                        <div class="counter__btn counter__btn--minus">
                            <svg>
                                <use xlink:href="./images/sprite.svg#minus"></use>
                            </svg>
                        </div>
                        <input class="counter__input" type="text" value="1">
                        <div class="counter__btn counter__btn--plus">
                            <svg>
                                <use xlink:href="./images/sprite.svg#plus"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="m-prod__price">10 073 ₽</div>
                </div>
                <div class="m-prod__del">
                    <svg>
                        <use xlink:href="./images/sprite.svg#close2"></use>
                    </svg>
                </div>
            </div>
            <div class="modalcart__product m-prod">
                <div class="m-prod__image"><a href=""><img src="images/tmp/product-big.png" alt=""></a></div>
                <div class="m-prod__desc">
                    <div class="m-prod__wrap"><a class="m-prod__title" href="">YVES SAINT LAURENT </a>
                        <div class="m-prod__subtitle">Libre Eau de Parfum (50ml)</div>
                    </div>
                    <div class="m-prod__options">
                        <div class="m-prod__option">
                            Выбранный цвет: <span>Red</span></div>
                        <div class="m-prod__option">
                            Выбранный размер: <span>90ml</span></div>
                    </div>
                </div>
                <div class="m-prod__nav">
                    <div class="counter">
                        <div class="counter__btn counter__btn--minus">
                            <svg>
                                <use xlink:href="./images/sprite.svg#minus"></use>
                            </svg>
                        </div>
                        <input class="counter__input" type="text" value="1">
                        <div class="counter__btn counter__btn--plus">
                            <svg>
                                <use xlink:href="./images/sprite.svg#plus"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="m-prod__price">10 073 ₽</div>
                </div>
                <div class="m-prod__del">
                    <svg>
                        <use xlink:href="./images/sprite.svg#close2"></use>
                    </svg>
                </div>
            </div>
        </div>
        <form class="modalcart__form form" action="">
            <div class="form__fieldset">
                <legend class="form__legend">
                    Введите промокод
                </legend>
                <input class="form__input" type="text">
            </div>
            <div class="form__fieldset">
                <legend class="form__legend">
                    Введите подарочную карту
                </legend>
                <input class="form__input cardmask" type="text" placeholder="____ - ____ - ____ - ____">
            </div>
            <div class="form__fieldset">
                <legend class="form__legend">
                    Использовать кол-во баллов
                    <span class="modalcart__balans">доступно 508 баллов</span>
                </legend>
                <input class="form__input" type="text">
            </div>
        </form>
        <div class="modalcart__total">
            <div class="modalform__heading">
                Сумма заказа
            </div>
            <div class="chars modalcart__chars">
                <div class="chars__item">
                    <div class="chars__name"><span>Стоимость продуктов</span></div>
                    <div class="chars__value"><span>20 146 ₽ </span></div>
                </div>
                <div class="chars__item">
                    <div class="chars__name"><span>Скидка по промокоду</span></div>
                    <div class="chars__value"><span>500 ₽ </span></div>
                </div>
                <div class="chars__item">
                    <div class="chars__name"><span>Скидка после применения баллов</span></div>
                    <div class="chars__value"><span>250 ₽ </span></div>
                </div>
            </div>
            <div class="modalcart__totalsum">
                Итого 19 396 ₽
            </div>
        </div>
        <a class="btn btn--primary btn--100" href="checkout.html">Оформить заказ
            <svg>
                <use xlink:href="./images/sprite.svg#arrow-right"></use>
            </svg>
        </a>
        <div class="modalcart__popular mc-popular">
            <div class="mc-popular__header">
                <div class="modalform__heading">
                    Популярные товары
                </div>
                <div class="mc-popular__nav">
                    <button class="btn-slider" id="mc-popular-prev">
                        <svg>
                            <use xlink:href="./images/sprite.svg#prev"></use>
                        </svg>
                    </button>
                    <button class="btn-slider" id="mc-popular-next">
                        <svg>
                            <use xlink:href="./images/sprite.svg#next"></use>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mc-popular-slider swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <article class="product">
                            <div class="product__image"><a href=""> <img class="product__front" src="images/home/1.png"
                                                                         alt=""><img class="product__back"
                                                                                     src="images/home/2.png" alt=""><img
                                        class="product__empty" src="images/home/2.png" alt=""></a>
                                <div class="product__labels">
                                    <div class="product__label product__label--red">
                                        -4%
                                    </div>
                                    <div class="product__label product__label--green">Новинка</div>
                                    <div class="product__label product__label--yellow">
                                        Хит
                                    </div>
                                </div>
                                <button class="product__btnbuy">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#cart"></use>
                                    </svg>
                                </button>
                                <button class="product__btnfav">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#heart"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="product__body">
                                <div class="product__wrap">
                                    <div class="product__prices" data-title="За объем 10 мл.">
                                        <div class="product__price">7 911 ₽</div>
                                        <div class="product__oldprice">8 790 ₽</div>
                                    </div>
                                    <div class="product__options">
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">10</div>
                                        </label>
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">50</div>
                                        </label>
                                    </div>
                                </div>
                                <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat Eau de
                                    Parfume KORRES, 50мл</a>
                                <div class="product__footer">
                                    <div class="product__rating">
                                        <svg>
                                            <use xlink:href="./images/sprite.svg#star"></use>
                                        </svg>
                                        4,7
                                    </div>
                                    <div class="product__reviews">
                                        2 отзыва
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="swiper-slide">
                        <article class="product">
                            <div class="product__image"><a href=""> <img class="product__front" src="images/home/1.png"
                                                                         alt=""><img class="product__back"
                                                                                     src="images/home/2.png" alt=""><img
                                        class="product__empty" src="images/home/2.png" alt=""></a>
                                <div class="product__labels">
                                    <div class="product__label product__label--red">
                                        -4%
                                    </div>
                                    <div class="product__label product__label--green">Новинка</div>
                                    <div class="product__label product__label--yellow">
                                        Хит
                                    </div>
                                </div>
                                <button class="product__btnbuy">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#cart"></use>
                                    </svg>
                                </button>
                                <button class="product__btnfav">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#heart"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="product__body">
                                <div class="product__wrap">
                                    <div class="product__prices" data-title="За объем 10 мл.">
                                        <div class="product__price">7 911 ₽</div>
                                        <div class="product__oldprice">8 790 ₽</div>
                                    </div>
                                    <div class="product__options">
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">10</div>
                                        </label>
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">50</div>
                                        </label>
                                    </div>
                                </div>
                                <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat Eau de
                                    Parfume KORRES, 50мл</a>
                                <div class="product__footer">
                                    <div class="product__rating">
                                        <svg>
                                            <use xlink:href="./images/sprite.svg#star"></use>
                                        </svg>
                                        4,7
                                    </div>
                                    <div class="product__reviews">
                                        2 отзыва
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="swiper-slide">
                        <article class="product">
                            <div class="product__image"><a href=""> <img class="product__front" src="images/home/1.png"
                                                                         alt=""><img class="product__back"
                                                                                     src="images/home/2.png" alt=""><img
                                        class="product__empty" src="images/home/2.png" alt=""></a>
                                <div class="product__labels">
                                    <div class="product__label product__label--red">
                                        -4%
                                    </div>
                                    <div class="product__label product__label--green">Новинка</div>
                                    <div class="product__label product__label--yellow">
                                        Хит
                                    </div>
                                </div>
                                <button class="product__btnbuy">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#cart"></use>
                                    </svg>
                                </button>
                                <button class="product__btnfav">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#heart"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="product__body">
                                <div class="product__wrap">
                                    <div class="product__prices" data-title="За объем 10 мл.">
                                        <div class="product__price">7 911 ₽</div>
                                        <div class="product__oldprice">8 790 ₽</div>
                                    </div>
                                    <div class="product__options">
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">10</div>
                                        </label>
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">50</div>
                                        </label>
                                    </div>
                                </div>
                                <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat Eau de
                                    Parfume KORRES, 50мл</a>
                                <div class="product__footer">
                                    <div class="product__rating">
                                        <svg>
                                            <use xlink:href="./images/sprite.svg#star"></use>
                                        </svg>
                                        4,7
                                    </div>
                                    <div class="product__reviews">
                                        2 отзыва
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="swiper-slide">
                        <article class="product">
                            <div class="product__image"><a href=""> <img class="product__front" src="images/home/1.png"
                                                                         alt=""><img class="product__back"
                                                                                     src="images/home/2.png" alt=""><img
                                        class="product__empty" src="images/home/2.png" alt=""></a>
                                <div class="product__labels">
                                    <div class="product__label product__label--red">
                                        -4%
                                    </div>
                                    <div class="product__label product__label--green">Новинка</div>
                                    <div class="product__label product__label--yellow">
                                        Хит
                                    </div>
                                </div>
                                <button class="product__btnbuy">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#cart"></use>
                                    </svg>
                                </button>
                                <button class="product__btnfav">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#heart"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="product__body">
                                <div class="product__wrap">
                                    <div class="product__prices" data-title="За объем 10 мл.">
                                        <div class="product__price">7 911 ₽</div>
                                        <div class="product__oldprice">8 790 ₽</div>
                                    </div>
                                    <div class="product__options">
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">10</div>
                                        </label>
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">50</div>
                                        </label>
                                    </div>
                                </div>
                                <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat Eau de
                                    Parfume KORRES, 50мл</a>
                                <div class="product__footer">
                                    <div class="product__rating">
                                        <svg>
                                            <use xlink:href="./images/sprite.svg#star"></use>
                                        </svg>
                                        4,7
                                    </div>
                                    <div class="product__reviews">
                                        2 отзыва
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="swiper-slide">
                        <article class="product">
                            <div class="product__image"><a href=""> <img class="product__front" src="images/home/1.png"
                                                                         alt=""><img class="product__back"
                                                                                     src="images/home/2.png" alt=""><img
                                        class="product__empty" src="images/home/2.png" alt=""></a>
                                <div class="product__labels">
                                    <div class="product__label product__label--red">
                                        -4%
                                    </div>
                                    <div class="product__label product__label--green">Новинка</div>
                                    <div class="product__label product__label--yellow">
                                        Хит
                                    </div>
                                </div>
                                <button class="product__btnbuy">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#cart"></use>
                                    </svg>
                                </button>
                                <button class="product__btnfav">
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#heart"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="product__body">
                                <div class="product__wrap">
                                    <div class="product__prices" data-title="За объем 10 мл.">
                                        <div class="product__price">7 911 ₽</div>
                                        <div class="product__oldprice">8 790 ₽</div>
                                    </div>
                                    <div class="product__options">
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">10</div>
                                        </label>
                                        <label class="product__option option">
                                            <input class="option__input" type="radio" name="volume">
                                            <div class="option__text">50</div>
                                        </label>
                                    </div>
                                </div>
                                <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat Eau de
                                    Parfume KORRES, 50мл</a>
                                <div class="product__footer">
                                    <div class="product__rating">
                                        <svg>
                                            <use xlink:href="./images/sprite.svg#star"></use>
                                        </svg>
                                        4,7
                                    </div>
                                    <div class="product__reviews">
                                        2 отзыва
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="modalform modalform--center modalform--medium authform" id="search">
    <div class="modalform__container">
        <div class="modalform__closebtn">
            <svg>
                <use xlink:href="./images/sprite.svg#close"></use>
            </svg>
        </div>
        <div class="modalform__heading">
            Поиск по каталогу
        </div>
        <form class="form searchform" action="">
            <input class="form__input" type="text" placeholder="Что будем искать?">
            <button class="btn btn--primary">
                <svg>
                    <use xlink:href="./images/sprite.svg#search"></use>
                </svg>
            </button>
        </form>
    </div>
</section>
<section class="modalform modalform--medium" id="newadd">
    <div class="modalform__container" data-lenis-prevent>
        <div class="modalform__closebtn">
            <svg>
                <use xlink:href="./images/sprite.svg#close"></use>
            </svg>
        </div>
        <div class="modalform__heading">
            Добавить новый адрес
        </div>
        <form class="form" action="">
            <div class="form__fieldset">
                <div class="form__legend">
                    Ваше имя *
                </div>
                <input class="form__input" type="text">
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Фамилия *
                </div>
                <input class="form__input" type="text">
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Номер телефона *
                </div>
                <input class="form__input phonemask" type="text">
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Электронная почта *
                </div>
                <input class="form__input" type="text">
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Город
                </div>
                <input class="form__input" type="text">
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Область
                </div>
                <input class="form__input" type="text">
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Адрес
                </div>
                <input class="form__input" type="text">
            </div>
            <button class="btn btn--primary btn--100">
                Добавить
            </button>
        </form>
    </div>
</section>
<section class="modalform modalform--medium" id="productinfo">
    <div class="modalform__container" data-lenis-prevent>
        <div class="modalform__closebtn">
            <svg>
                <use xlink:href="./images/sprite.svg#close"></use>
            </svg>
        </div>
        <div class="modalform__heading">
            О товаре
        </div>
        <div class="modalform__content typography">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam placeat, sint atque nobis voluptates
                nemo nihil natus odit harum fugiat, odio, accusantium quam velit a at mollitia necessitatibus omnis
                sunt!</p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam placeat, sint atque nobis voluptates
                nemo nihil natus odit harum fugiat, odio, accusantium quam velit a at mollitia necessitatibus omnis
                sunt!</p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam placeat, sint atque nobis voluptates
                nemo nihil natus odit harum fugiat, odio, accusantium quam velit a at mollitia necessitatibus omnis
                sunt!</p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam placeat, sint atque nobis voluptates
                nemo nihil natus odit harum fugiat, odio, accusantium quam velit a at mollitia necessitatibus omnis
                sunt!</p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam placeat, sint atque nobis voluptates
                nemo nihil natus odit harum fugiat, odio, accusantium quam velit a at mollitia necessitatibus omnis
                sunt!</p>
        </div>
    </div>
</section>
<section class="modalform modalform--medium" id="newreview">
    <div class="modalform__container">
        <div class="modalform__closebtn">
            <svg>
                <use xlink:href="./images/sprite.svg#close"></use>
            </svg>
        </div>
        <div class="modalform__heading">
            Написать отзыв
        </div>
        <form class="form" action="">
            <div class="form__fieldset">
                <div class="form__legend">
                    Рейтинг
                </div>
                <div class="form__rating">
                    <div class="rating-area">
                        <input id="star-5" type="radio" name="rating" value="5" required>
                        <label for="star-5" title="Оценка «5»">
                            <svg>
                                <use xlink:href="./images/sprite.svg#star"></use>
                            </svg>
                        </label>
                        <input id="star-4" type="radio" name="rating" value="4">
                        <label for="star-4" title="Оценка «4»">
                            <svg>
                                <use xlink:href="./images/sprite.svg#star"></use>
                            </svg>
                        </label>
                        <input id="star-3" type="radio" name="rating" value="3">
                        <label for="star-3" title="Оценка «3»">
                            <svg>
                                <use xlink:href="./images/sprite.svg#star"></use>
                            </svg>
                        </label>
                        <input id="star-2" type="radio" name="rating" value="2">
                        <label for="star-2" title="Оценка «2»">
                            <svg>
                                <use xlink:href="./images/sprite.svg#star"></use>
                            </svg>
                        </label>
                        <input id="star-1" type="radio" name="rating" value="1">
                        <label for="star-1" title="Оценка «1»">
                            <svg>
                                <use xlink:href="./images/sprite.svg#star"></use>
                            </svg>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Текст отзыва
                </div>
                <textarea class="form__textarea" name=""> </textarea>
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Ваше имя
                </div>
                <input class="form__input" type="text">
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Электронная почта
                </div>
                <input class="form__input phonemask" type="text">
            </div>
            <button class="btn btn--primary btn--100">
                Отправить
            </button>
        </form>
    </div>
</section>
<section class="modalform modalform--medium" id="newask">
    <div class="modalform__container">
        <div class="modalform__closebtn">
            <svg>
                <use xlink:href="./images/sprite.svg#close"></use>
            </svg>
        </div>
        <div class="modalform__heading">
            Задать вопрос
        </div>
        <form class="form" action="">
            <div class="form__fieldset">
                <div class="form__legend">
                    Ваш вопрос
                </div>
                <textarea class="form__textarea" name=""> </textarea>
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Ваше имя
                </div>
                <input class="form__input" type="text">
            </div>
            <div class="form__fieldset">
                <div class="form__legend">
                    Электронная почта
                </div>
                <input class="form__input phonemask" type="text">
            </div>
            <button class="btn btn--primary btn--100">
                Отправить
            </button>
        </form>
    </div>
</section>
<section class="modalform modalform--big" id="orderfull">
    <div class="modalform__container" data-lenis-prevent>
        <div class="modalform__closebtn">
            <svg>
                <use xlink:href="./images/sprite.svg#close"></use>
            </svg>
        </div>
        <div class="modalform__heading modalform__heading--small">
            Заказ № 2109/05<br> от 07.09.2021
        </div>
        <div class="chars c-orderinfo">
            <div class="chars__item">
                <div class="chars__name"><span>Статус заказа</span></div>
                <div class="chars__value"><span><span class="new">Новый</span></span></div>
            </div>
            <div class="chars__item">
                <div class="chars__name"><span>Дата заказа</span></div>
                <div class="chars__value"><span>07.09.2021</span></div>
            </div>
            <div class="chars__item">
                <div class="chars__name"><span>Заказчик</span></div>
                <div class="chars__value"><span>Иван Петров</span></div>
            </div>
            <div class="chars__item">
                <div class="chars__name"><span>Телефон заказчика</span></div>
                <div class="chars__value"><span>+7 495 456 78 96</span></div>
            </div>
            <div class="chars__item">
                <div class="chars__name"><span>E-mail</span></div>
                <div class="chars__value"><span>info@domen.ru</span></div>
            </div>
        </div>
        <div class="c-order">
            <div class="c-order__title">Состав заказа</div>
            <div class="cart-table">
                <div class="cart-table__thead">
                    <div class="cart-table__th cart-table__th--name">Наименование</div>
                    <div class="cart-table__th cart-table__th--count-and-price">Цена и кол-во</div>
                    <div class="cart-table__th cart-table__th--sum">Сумма</div>
                </div>
                <div class="cart-table__body">
                    <div class="cart-table__item cart-product">
                        <div class="cart-product__image"><a href=""><img src="images/tmp/product-big.png" alt=""></a>
                        </div>
                        <div class="cart-product__desc">
                            <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                            <div class="cart-product__subtitle">
                                Libre Eau de Parfum (50ml)
                            </div>
                            <div class="cart-product__options">
                                <div class="cart-product__option">Выбранный цвет: <b>Red</b></div>
                                <div class="cart-product__option">Выбранный размер: <b>90ml</b></div>
                            </div>
                        </div>
                        <div class="cart-product__prices-and-count" data-title="Цена и кол-во">
                            <div class="cart-product__price">2 x 10 073 ₽</div>
                            <div class="cart-product__oldprice">12 650 ₽</div>
                        </div>
                        <div class="cart-product__sum" data-title="Сумма">20 146 ₽</div>
                    </div>
                    <div class="cart-table__item cart-product">
                        <div class="cart-product__image"><a href=""><img src="images/tmp/product-big.png" alt=""></a>
                        </div>
                        <div class="cart-product__desc">
                            <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                            <div class="cart-product__subtitle">
                                Libre Eau de Parfum (50ml)
                            </div>
                            <div class="cart-product__options">
                                <div class="cart-product__option">Выбранный цвет: <b>Red</b></div>
                                <div class="cart-product__option">Выбранный размер: <b>90ml</b></div>
                            </div>
                        </div>
                        <div class="cart-product__prices-and-count" data-title="Цена и кол-во">
                            <div class="cart-product__price">2 x 10 073 ₽</div>
                            <div class="cart-product__oldprice">12 650 ₽</div>
                        </div>
                        <div class="cart-product__sum" data-title="Сумма">20 146 ₽</div>
                    </div>
                    <div class="cart-table__item cart-product">
                        <div class="cart-product__image"><a href=""><img src="images/tmp/product-big.png" alt=""></a>
                        </div>
                        <div class="cart-product__desc">
                            <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                            <div class="cart-product__subtitle">
                                Libre Eau de Parfum (50ml)
                            </div>
                            <div class="cart-product__options">
                                <div class="cart-product__option">Выбранный цвет: <b>Red</b></div>
                                <div class="cart-product__option">Выбранный размер: <b>90ml</b></div>
                            </div>
                        </div>
                        <div class="cart-product__prices-and-count" data-title="Цена и кол-во">
                            <div class="cart-product__price">2 x 10 073 ₽</div>
                            <div class="cart-product__oldprice">12 650 ₽</div>
                        </div>
                        <div class="cart-product__sum" data-title="Сумма">20 146 ₽</div>
                    </div>
                </div>
            </div>
            <div class="c-order__total">
                Итого с НДС <span>40 292 ₽</span></div>
            <button class="btn btn--secondary c-order__reorder">
                Повторить заказ
                <svg>
                    <use xlink:href="./images/sprite.svg#refresh"></use>
                </svg>
            </button>
            <button class="btn btn--secondary c-order__reorder">
                Оплатить заказ
            </button>
        </div>
    </div>
</section>
<div id="menu">
    <ul>
        <li><a href="">Бренды</a></li>
        <li><a href="">Бестселлеры</a></li>
        <li><a href="">Уход</a>
            <ul>
                <li><a href="">Уход для лица</a>
                    <ul>
                        <li><a href="">Очищение</a></li>
                        <li><a href="">Основной уход</a></li>
                        <li><a href="">Маски для лица</a></li>
                        <li><a href="">Уход за кожей вокруг глаз</a></li>
                        <li><a href="">Скрабы и пилинги для лица</a></li>
                        <li><a href="">Сыворотки и масла</a></li>
                        <li><a href="">Антивозрастной уход</a></li>
                    </ul>
                </li>
                <li><a href="">Уход для тела</a>
                    <ul>
                        <li><a href="">Для душа и ванны</a></li>
                        <li><a href="">Для рук</a></li>
                        <li><a href="">Увлажнение и питание</a></li>
                    </ul>
                </li>
                <li><a href="">Солнцезащитная линия</a></li>
            </ul>
        </li>
        <li><a href="">Волосы</a></li>
        <li><a href="">Парфюмерия</a></li>
        <li><a href="">Подарочные наборы</a></li>
        <li><a href="">Новинки</a></li>
        <li><a href="">Акцииss</a></li>
    </ul>
</div>
<section class="mobilepanel for-mobile"><a class="navpanel__item mobilepanel__item" href="index.html">
        <svg>
            <use xlink:href="./images/sprite.svg#home"></use>
        </svg>
        <div class="mobilepanel__text">
            Главная
        </div>
    </a><a class="navpanel__item mobilepanel__item btn-hidepanels" id="btn-menu" href="#menu">
        <svg>
            <use xlink:href="./images/sprite.svg#menu"></use>
        </svg>
        <div class="mobilepanel__text">
            Каталог
        </div>
    </a><a class="navpanel__item mobilepanel__item popup-with-form" href="#cart">
        <svg>
            <use xlink:href="./images/sprite.svg#cart"></use>
        </svg>
        <span>
           12</span>
        <div class="mobilepanel__text">
            Корзина
        </div>
    </a><a class="navpanel__item mobilepanel__item" href="">
        <svg>
            <use xlink:href="./images/sprite.svg#heart"></use>
        </svg>
        <span>
           4</span>
        <div class="mobilepanel__text">
            Избранное
        </div>
    </a><a class="navpanel__item mobilepanel__item popup-with-form" href="#auth">
        <svg>
            <use xlink:href="{{ asset('images/sprite.svg#user') }}"></use>
        </svg>
        <div class="mobilepanel__text">
            Кабинет
        </div>
    </a></section>
<script src="{{ asset('new_js/index.bundle.js') }}"></script>
</body>
</html>




