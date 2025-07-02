@extends('layouts.app_new')

@section('title', 'Luxe Cosmetics - интернет-магазин люксовой косметики и парфюмерии')
@section('description', 'Интернет магазин элитной косметики и парфюмерии 💄 | Мировые бренды, широкий ассортимент, акции и бонусные программы | Купить косметику с доставкой по Москве и России ❤️ ')

@section('content')
    <section class="heroslider">
        <div class="slider swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide slider__slide">
                    <video class="slider__media" muted autoplay playsinline loop poster="" data-swiper-parallax="40%">
                        <source src="files/214737.mp4" type="video/mp4">
                    </video>
                    <div class="slider__content" data-swiper-parallax="10%">
                        <div class="container">
                            <div class="slider__contentwrapper">
                                <div class="slider__title">
                                    Больше заказ,<br> больше скидка
                                </div>
                                <div class="slider__subtitle">
                                    примените промокод и получите<br> дополнительную скидку до −25%
                                </div>
                                <a class="slider__btnmore btn btn--primary" href="">
                                    Узнать подробнее
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slider__overlay" style="opacity: 0.5;"></div>
                </div>
                <div class="swiper-slide slider__slide">
                    <div class="slider__media" data-swiper-parallax="40%"><img src="images/slider/2.png" alt=""></div>
                    <div class="slider__content" data-swiper-parallax="10%">
                        <div class="container">
                            <div class="slider__contentwrapper">
                                <div class="slider__title">
                                    Акция 2
                                </div>
                                <div class="slider__subtitle">
                                    примените промокод и получите<br> дополнительную скидку до −25%
                                </div>
                                <a class="slider__btnmore btn btn--primary" href="">
                                    Узнать подробнее
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slider__overlay" style="opacity: 0.5;"></div>
                </div>
                <div class="swiper-slide slider__slide">
                    <video class="slider__media" muted autoplay playsinline loop poster="" data-swiper-parallax="40%">
                        <source src="files/257927.mp4" type="video/mp4">
                    </video>
                    <div class="slider__content" data-swiper-parallax="10%">
                        <div class="container">
                            <div class="slider__contentwrapper">
                                <div class="slider__title">
                                    Больше заказ,больше скидка
                                </div>
                                <div class="slider__subtitle">
                                    примените промокод и получите<br> дополнительную скидку до −25%
                                </div>
                                <a class="slider__btnmore btn btn--primary" href="">
                                    Узнать подробнее
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slider__overlay" style="opacity: 0.5;"></div>
                </div>
                <div class="swiper-slide slider__slide">
                    <div class="slider__media" data-swiper-parallax="40%"><img src="images/slider/3.png" alt=""></div>
                    <div class="slider__content" data-swiper-parallax="10%">
                        <div class="container">
                            <div class="slider__contentwrapper">
                                <div class="slider__title">
                                    Акция 3
                                </div>
                                <div class="slider__subtitle">
                                    примените промокод и получите<br> дополнительную скидку до −25%
                                </div>
                                <a class="slider__btnmore btn btn--primary" href="">
                                    Узнать подробнее
                                    <svg>
                                        <use xlink:href="./images/sprite.svg#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slider__overlay" style="opacity: 0.5;"></div>
                </div>
            </div>
            <button class="slider__btn slider__btn--prev">
                <svg>
                    <use xlink:href="./images/sprite.svg#arrow-left"></use>
                </svg>
            </button>
            <button class="slider__btn slider__btn--next">
                <svg>
                    <use xlink:href="./images/sprite.svg#arrow-right"></use>
                </svg>
            </button>
        </div>
    </section>
    <section class="topcategories">
        <div class="container">
            <div class="topcategories__container">
                <div class="topcategories__item topcat">
                    <div class="topcat__image"><img src="images/categories/1.png" alt=""></div>
                    <a class="topcat__title" href="">Бестселлеры</a>
                    <div class="topcat__subtitle">
                        Лучшие средства ухода и самые востребованные парфюмерные композиции со всего мира
                    </div>
                </div>
                <div class="topcategories__item topcat">
                    <div class="topcat__image"><img src="images/categories/2.png" alt=""></div>
                    <a class="topcat__title" href="">Парфюмерия</a>
                    <div class="topcat__subtitle">
                        Самые изысканные ароматы со всего мира, которые не оставят равнодушными даже самых искушенных
                        потребителей
                    </div>
                </div>
                <div class="topcategories__item topcat">
                    <div class="topcat__image"><img src="images/categories/3.png" alt=""></div>
                    <a class="topcat__title" href="">Уход за кожей</a>
                    <div class="topcat__subtitle">
                        Последние достижения науки, воплощенные в таких эффективныхсредствах ухода, как сыворотки,
                        крема, маски, тоники и др.
                    </div>
                </div>
                <div class="topcategories__item topcat">
                    <div class="topcat__image"><img src="images/categories/4.png" alt=""></div>
                    <a class="topcat__title" href="">Уход за волосами</a>
                    <div class="topcat__subtitle">
                        Эффективные средства для красоты и здоровья ваших волос
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="marquee" id="marquee">
        <div class="marquee__item"><a href=""> <img src="images/brands/1.png" alt=""></a></div>
        <div class="marquee__item"><a href=""> <img src="images/brands/2.png" alt=""></a></div>
        <div class="marquee__item"><a href=""> <img src="images/brands/3.png" alt=""></a></div>
        <div class="marquee__item"><a href=""> <img src="images/brands/4.png" alt=""></a></div>
        <div class="marquee__item"><a href=""> <img src="images/brands/5.png" alt=""></a></div>
        <div class="marquee__item"><a href=""> <img src="images/brands/6.png" alt=""></a></div>
        <div class="marquee__item"><a href=""> <img src="images/brands/7.png" alt=""></a></div>
        <div class="marquee__item"><a href=""> <img src="images/brands/8.png" alt=""></a></div>
    </section>
    <section class="prodblock">
        <div class="container">
            <div class="prodblock__row">
                <div class="prodblock__col prodblock__col--2">
                    <div class="prodblock__wrap">
                        <h2 class="heading">
                            Новинки</h2>
                        <div class="intro">
                            Будьте в курсе новинок и первыми попробуйте лучшие косметические продукты
                        </div>
                    </div>
                    <div class="prodblock__btns">
                        <button class="btn-slider prodblock__prev" id="prod-new-prev">
                            <svg>
                                <use xlink:href="./images/sprite.svg#arrow-left"></use>
                            </svg>
                        </button>
                        <button class="btn-slider prodblock__next" id="prod-new-next">
                            <svg>
                                <use xlink:href="./images/sprite.svg#arrow-right"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="prodblock__col prodblock__col--10">
                    <div class="prodblock__slider newprod-slider swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
        </div>
    </section>
    <section class="promotionssliderblock">
        <div class="container">
            <div class="promotionssliderblock__header">
                <h2 class="heading">
                    Клиентские дни</h2>
                <div class="promotionssliderblock__nav">
                    <button class="btn-slider promotionssliderblock__prev">
                        <svg>
                            <use xlink:href="./images/sprite.svg#arrow-left"></use>
                        </svg>
                    </button>
                    <button class="btn-slider promotionssliderblock__next">
                        <svg>
                            <use xlink:href="./images/sprite.svg#arrow-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="promotions-slider swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="promotion">
                        <div class="promotion__image"><a href=""> <img src="images/tmp/banner-8.png" alt=""></a></div>
                        <div class="promotion__content">
                            <div class="promotion__wrap"><a class="promotion__title" href="">
                                    Rinfoltil до −25%</a>
                                <div class="promotion__subtitle">
                                    уход против выпадения волос
                                </div>
                            </div>
                            <div class="promotion__date">
                                6 — 9<br> февраля
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="promotion">
                        <div class="promotion__image"><a href=""> <img src="images/tmp/banner-8.png" alt=""></a></div>
                        <div class="promotion__content">
                            <div class="promotion__wrap"><a class="promotion__title" href="">
                                    Rinfoltil до −25%</a>
                                <div class="promotion__subtitle">
                                    уход против выпадения волос
                                </div>
                            </div>
                            <div class="promotion__date">
                                6 — 9<br> февраля
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="promotion">
                        <div class="promotion__image"><a href=""> <img src="images/tmp/banner-8.png" alt=""></a></div>
                        <div class="promotion__content">
                            <div class="promotion__wrap"><a class="promotion__title" href="">
                                    Rinfoltil до −25%</a>
                                <div class="promotion__subtitle">
                                    уход против выпадения волос
                                </div>
                            </div>
                            <div class="promotion__date">
                                6 — 9<br> февраля
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="promotion">
                        <div class="promotion__image"><a href=""> <img src="images/tmp/banner-8.png" alt=""></a></div>
                        <div class="promotion__content">
                            <div class="promotion__wrap"><a class="promotion__title" href="">
                                    Rinfoltil до −25%</a>
                                <div class="promotion__subtitle">
                                    уход против выпадения волос
                                </div>
                            </div>
                            <div class="promotion__date">
                                6 — 9<br> февраля
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="promotion">
                        <div class="promotion__image"><a href=""> <img src="images/tmp/banner-8.png" alt=""></a></div>
                        <div class="promotion__content">
                            <div class="promotion__wrap"><a class="promotion__title" href="">
                                    Rinfoltil до −25%</a>
                                <div class="promotion__subtitle">
                                    уход против выпадения волос
                                </div>
                            </div>
                            <div class="promotion__date">
                                6 — 9<br> февраля
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="promotion">
                        <div class="promotion__image"><a href=""> <img src="images/tmp/banner-8.png" alt=""></a></div>
                        <div class="promotion__content">
                            <div class="promotion__wrap"><a class="promotion__title" href="">
                                    Rinfoltil до −25%</a>
                                <div class="promotion__subtitle">
                                    уход против выпадения волос
                                </div>
                            </div>
                            <div class="promotion__date">
                                6 — 9<br> февраля
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="promotion">
                        <div class="promotion__image"><a href=""> <img src="images/tmp/banner-8.png" alt=""></a></div>
                        <div class="promotion__content">
                            <div class="promotion__wrap"><a class="promotion__title" href="">
                                    Rinfoltil до −25%</a>
                                <div class="promotion__subtitle">
                                    уход против выпадения волос
                                </div>
                            </div>
                            <div class="promotion__date">
                                6 — 9<br> февраля
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="promotion">
                        <div class="promotion__image"><a href=""> <img src="images/tmp/banner-8.png" alt=""></a></div>
                        <div class="promotion__content">
                            <div class="promotion__wrap"><a class="promotion__title" href="">
                                    Rinfoltil до −25%</a>
                                <div class="promotion__subtitle">
                                    уход против выпадения волос
                                </div>
                            </div>
                            <div class="promotion__date">
                                6 — 9<br> февраля
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="prodblock prodblock--reverse">
        <div class="container">
            <div class="prodblock__row">
                <div class="prodblock__col prodblock__col--2">
                    <div class="prodblock__wrap">
                        <h2 class="heading">
                            Популярные</h2>
                        <div class="intro">
                            Лучшие формулы, эффективные составы и тренды, которые остаются актуальными
                        </div>
                    </div>
                    <div class="prodblock__btns">
                        <button class="btn-slider prodblock__prev" id="prod-popular-prev">
                            <svg>
                                <use xlink:href="./images/sprite.svg#arrow-left"></use>
                            </svg>
                        </button>
                        <button class="btn-slider prodblock__next" id="prod-popular-next">
                            <svg>
                                <use xlink:href="./images/sprite.svg#arrow-right"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="prodblock__col prodblock__col--10">
                    <div class="prodblock__slider popular-slider swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
        </div>
    </section>
    <section class="promotions promoslider">
        <div class="container">
            <div class="promoslider__header">
                <h2 class="heading">
                    Блогеры<br> советуют</h2>
                <div class="promoslider__btns">
                    <button class="btn-slider promoslider__prev">
                        <svg>
                            <use xlink:href="./images/sprite.svg#arrow-left"></use>
                        </svg>
                    </button>
                    <button class="btn-slider promoslider__next">
                        <svg>
                            <use xlink:href="./images/sprite.svg#arrow-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="promoslider-slider swiper">
                <div class="swiper-wrapper">
                    <div class="promoslider__item swiper-slide">
                        <div class="promotion">
                            <div class="promotion__image"><a href=""> <img src="images/tmp/banner-4.png" alt=""></a>
                            </div>
                            <div class="promotion__content">
                                <div class="promotion__wrap"><a class="promotion__title" href="">
                                        Rinfoltil до −25%</a>
                                    <div class="promotion__subtitle">
                                        уход против выпадения волос
                                    </div>
                                </div>
                                <div class="promotion__date">
                                    6 — 9<br> февраля
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="promoslider__item swiper-slide">
                        <div class="promotion">
                            <div class="promotion__image"><a href=""> <img src="images/tmp/banner-4.png" alt=""></a>
                            </div>
                            <div class="promotion__content">
                                <div class="promotion__wrap"><a class="promotion__title" href="">
                                        Rinfoltil до −25%</a>
                                    <div class="promotion__subtitle">
                                        уход против выпадения волос
                                    </div>
                                </div>
                                <div class="promotion__date">
                                    6 — 9<br> февраля
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="prodblock">
        <div class="container">
            <div class="prodblock__row">
                <div class="prodblock__col prodblock__col--2">
                    <div class="prodblock__wrap">
                        <h2 class="heading">
                            Товары<br> со&nbsp;скидкой</h2>
                        <div class="intro">
                            Собрали для вас лучшие предложения на косметику от мировых брендов
                        </div>
                    </div>
                    <div class="prodblock__btns">
                        <button class="btn-slider prodblock__prev" id="prod-discount-prev">
                            <svg>
                                <use xlink:href="./images/sprite.svg#arrow-left"></use>
                            </svg>
                        </button>
                        <button class="btn-slider prodblock__next" id="prod-discount-next">
                            <svg>
                                <use xlink:href="./images/sprite.svg#arrow-right"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="prodblock__col prodblock__col--10">
                    <div class="prodblock__slider discount-slider swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
                            <div class="swiper-slide prodblock-slider__item">
                                <article class="product">
                                    <div class="product__image"><a href=""> <img class="product__front"
                                                                                 src="images/home/1.png" alt=""><img
                                                class="product__back" src="images/home/2.png" alt=""><img
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
                                        <a class="product__title" href=""><span>Парфюмерная вода</span> Cashmere Kumquat
                                            Eau de Parfume KORRES, 50мл</a>
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
        </div>
    </section>
    <section class="promotions promotions--full">
        <div class="container">
            <h2 class="heading">
                Клиентские дни</h2>
        </div>
        <div class="promotions__container">
            <div class="promotions__item">
                <div class="promotion">
                    <div class="promotion__image"><a href="">
                            <picture>
                                <source srcset="images/tmp/banner-6.png" media="(min-width: 992px)" type="image/png"/>
                                <source srcset="images/tmp/banner-5.png" media="(min-width: 576px) and (max-width: 991px)"
                                        type="image/png"/>
                                <source srcset="images/tmp/banner-5.png" media="(max-width: 575px)" type="image/png"/>
                                <img src="images/tmp/banner-6.png" alt="banner"/>
                            </picture>
                        </a></div>
                    <div class="promotion__content">
                        <div class="promotion__wrap"><a class="promotion__title" href="">
                                Rinfoltil до −25%</a>
                            <div class="promotion__subtitle">
                                уход против выпадения волос
                            </div>
                        </div>
                        <div class="promotion__date">
                            6 — 9<br> февраля
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="lastnews">
        <div class="container">
            <div class="lastnews__header">
                <h2 class="heading">
                    Последние<br> новости</h2><a class="more" href="">Смотреть<br> все новости</a>
            </div>
            <div class="lastnews__items">
                <article class="lastnews__item news">
                    <div class="news__image">
                        <picture>
                            <source srcset="images/tmp/news.png" media="(min-width: 992px)" type="image/png"/>
                            <source srcset="images/tmp/news.png" media="(min-width: 576px) and (max-width: 991px)"
                                    type="image/png"/>
                            <source srcset="images/tmp/news.png" media="(max-width: 575px)" type="image/png"/>
                            <img src="images/tmp/news.png" alt="article"/>
                        </picture>
                    </div>
                    <div class="news__date">
                        <svg>
                            <use xlink:href="./images/sprite.svg#calendar"></use>
                        </svg>
                        28 ноября 2024
                    </div>
                    <a class="news__title" href="">Коллаборация Canteen x Luxe Cosmetics </a>
                    <div class="news__intro">
                        Canteen x Luxe Cosmetics Встречайте праздничный special-десерт «Шишка», который был р...
                    </div>
                </article>
                <article class="lastnews__item news">
                    <div class="news__image">
                        <picture>
                            <source srcset="images/tmp/news-big.png" media="(min-width: 992px)" type="image/png"/>
                            <source srcset="images/tmp/news.png" media="(min-width: 576px) and (max-width: 991px)"
                                    type="image/png"/>
                            <source srcset="images/tmp/news.png" media="(max-width: 575px)" type="image/png"/>
                            <img src="images/tmp/news-big.png" alt="article"/>
                        </picture>
                    </div>
                    <div class="news__date">
                        <svg>
                            <use xlink:href="./images/sprite.svg#calendar"></use>
                        </svg>
                        28 ноября 2024
                    </div>
                    <a class="news__title" href="">Вечер исполнения желаний KORRES в ресторане Canteen</a>
                    <div class="news__intro">
                        27 ноября, в минувшую среду, прошел традиционный вечер исполнения желаний косметического б...
                    </div>
                </article>
                <article class="lastnews__item news">
                    <div class="news__image">
                        <picture>
                            <source srcset="images/tmp/news.png" media="(min-width: 992px)" type="image/png"/>
                            <source srcset="images/tmp/news.png" media="(min-width: 576px) and (max-width: 991px)"
                                    type="image/png"/>
                            <source srcset="images/tmp/news.png" media="(max-width: 575px)" type="image/png"/>
                            <img src="images/tmp/news.png" alt="article"/>
                        </picture>
                    </div>
                    <div class="news__date">
                        <svg>
                            <use xlink:href="./images/sprite.svg#calendar"></use>
                        </svg>
                        28 ноября 2024
                    </div>
                    <a class="news__title" href="">Греческое меню от KORRES в ресторане FLANER</a>
                    <div class="news__intro">
                        15 августа ресторан ближневосточной кухни Flâner и греческий бренд натуральной косметики KORRES
                        запускают совместное меню...
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection



