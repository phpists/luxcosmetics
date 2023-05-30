@extends('layouts.app')

@section('title', 'Главная')
@section('content')
    <section class="mainaction">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mainaction__one">
                        <a href="">
                            <picture>
                                <source  srcset="{{asset('images/dist/banners/banner-big.jpg')}}" media="(min-width: 576px)">
                                <source srcset="{{asset('images/dist/banners/banner-big@320.jpg')}}" media="(max-width: 575px)" >
                                <img src="images/dist/banners/banner-big.jpg">
                            </picture>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="article">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/dist/banners/banner-medium.jpg')}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-medium@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-medium@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="images/dist/banners/banner-medium.jpg">
                                </picture>
                            </div>
                            <div class="article__title"><a href="">Бьюти-Бум</a></div>
                            <div class="article__intro">Получите скидку 20% на всю декоративную косметику! Только одна неделя – улучшите свой образ с нашими качественными продуктами по выгодным ценам</div>
                        </div>
                        <a href="" class="article__more">Подробнее</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="article">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/dist/banners/banner-medium2.jpg')}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-medium2@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-medium2@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="images/dist/banners/banner-medium2.jpg">
                                </picture>
                            </div>
                            <div class="article__title"><a href="">Красота в каждом уголке</a></div>
                            <div class="article__intro">Распродажа сезонных товаров со скидками до 50%!
                                Успейте обновить свою косметичку лучшими средствами по суперценам</div>
                        </div>
                        <a href="" class="article__more">Подробнее</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="article article--threecol">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/dist/banners/banner-small.jpg')}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-small@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-small@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="images/dist/banners/banner-small.jpg">
                                </picture>
                            </div>
                            <div class="article__title"><a href="">VIP-день</a></div>
                            <div class="article__intro">Зарегистрируйтесь на нашем сайте и получите скидку 25% на первую покупку в день вашего рождения. Отметьте свой особенный день вместе с нами.</div>
                        </div>
                        <a href="" class="article__more">Подробнее</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="article article--threecol">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/dist/banners/banner-small2.jpg')}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-small2@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-small2@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="images/dist/banners/banner-small2.jpg">
                                </picture>
                            </div>
                            <div class="article__title"><a href="">Студенческие скидки</a></div>
                            <div class="article__intro">Всем студентам действует постоянная скидка 10% при предъявлении студенческого билета. Ухаживайте за своей красотой и экономьте на покупках с нашей студенческой программой.</div>
                        </div>
                        <a href="" class="article__more">Подробнее</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="article article--threecol">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/dist/banners/banner-small3.jpg')}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/dist/banners/banner-small3@768.jpg')}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/dist/banners/banner-small3@320.jpg')}}" media="(max-width: 575px)" >
                                    <img src="images/dist/banners/banner-small3.jpg">
                                </picture>
                            </div>
                            <div class="article__title"><a href="">Семейные выходные</a></div>
                            <div class="article__intro">Каждые выходные дни скидка 15% на всю продукцию для детей и мужчин. Проведите время с пользой и радостью, выбирая качественные средства для всей семьи по специальным ценам</div>
                        </div>
                        <a href="" class="article__more">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Новинки</h2>
                    <div class="products-slider">
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>
                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный объем: <b>150ml</b></div>
                                            <div class="product__options product__volume">
                                                <label class="volume">
                                                    <input type="radio" name="volume"  checked/>
                                                    <div class="volume__text"><b>50ml</b> 10 073 ₽ </div>
                                                </label>
                                                <label class="volume">
                                                    <input type="radio" name="volume" />
                                                    <div class="volume__text"><b>90ml</b> 13 326 ₽  </div>
                                                </label>
                                                <label class="volume">
                                                    <input type="radio" name="volume"/>
                                                    <div class="volume__text"><b>150ml</b> 15 320 ₽  </div>
                                                </label>

                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>
                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный объем: <b>150ml</b></div>
                                            <div class="product__options product__volume">
                                                <label class="volume">
                                                    <input type="radio" name="volume"  checked/>
                                                    <div class="volume__text"><b>50ml</b> 10 073 ₽ </div>
                                                </label>
                                                <label class="volume">
                                                    <input type="radio" name="volume" />
                                                    <div class="volume__text"><b>90ml</b> 13 326 ₽  </div>
                                                </label>
                                                <label class="volume">
                                                    <input type="radio" name="volume"/>
                                                    <div class="volume__text"><b>150ml</b> 15 320 ₽  </div>
                                                </label>

                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="videoblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="videoblock__wrapper">
                        <h2 class="videoblock__title">Мастер-класс от&nbsp;эксперта</h2>
                        <p>Приобретите косметические продукты на сумму свыше 7000 рублей и получите доступ к эксклюзивному видео-мастер-классу от известного визажиста!</p>
                        <p>Узнайте секреты профессионалов и научитесь создавать неповторимые образы с помощью наших качественных средств. Ваша красота – в ваших руках!</p>
                    </div>

                </div>
            </div>
        </div>
        <a href="https://www.youtube.com/watch?v=m-4XcLUMYQ4" class="videoblock__video popup-youtube" style="background-image: url(images/dist/video-cover.jpg);"></a>
    </section>
    <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Популярные</h2>
                    <div class="products-slider">
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="maincategory">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="maincategory__grid">
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url(images/dist/catbanners/1.jpg);"></div>
                                <div class="category__title"><a href="">Бестселлеры</a></div>
                                <div class="category__subtitle">Популярные и востребованные товары, которые заслужили любовь и доверие покупателей</div>
                            </div>
                        </div>
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url(images/dist/catbanners/2.jpg);"></div>
                                <div class="category__title"><a href="">Мейкап</a></div>
                                <div class="category__subtitle">Широкий выбор декоративной косметики для создания разнообразных образов: туши, тени, румяна, помады и многое другое</div>
                            </div>
                        </div>
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url(images/dist/catbanners/3.jpg);"></div>
                                <div class="category__title"><a href="">Волосы и ногти</a></div>
                                <div class="category__subtitle">Косметические средства и аксессуары для ухода за волосами и ногтями: шампунь, кондиционер, лак для ногтей</div>
                            </div>
                        </div>
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url(images/dist/catbanners/4.jpg);"></div>
                                <div class="category__title"><a href="">Уход за кожей</a></div>
                                <div class="category__subtitle">Продукты для очищения, увлажнения и питания кожи лица и тела: кремы, маски, скрабы, сыворотки и другие средства</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Товары со скидкой</h2>
                    <div class="products-slider">
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="products-slider__item">
                            <div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="images/dist/sprite.svg#heart"></use></svg></button>
                                    </div>
                                    <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
                                    <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
                                </div>
                                <div class="product__btm">
                                    <div class="product__reviews">
                                        <div class="stars">
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item is-active"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                            <span class="stars__item"><svg class="icon"><use xlink:href="images/dist/sprite.svg#star"></use></svg></span>
                                        </div>
                                        <a href="">16 отзывов</a>
                                    </div>
                                    <div class="product__ftrwrap">
                                        <div class="product__prices">
                                            <div class="product__price">4 009 ₽</div>
                                            <del class="product__oldprice">4 700 ₽</del>
                                        </div>
                                        <button class="product__mobile-btn"><svg class="icon"><use xlink:href="images/dist/sprite.svg#cart"></use></svg></button>
                                    </div>
                                    <div class="product__sizesinfo">Еще два размера</div>


                                    <div class="product__pnl">
                                        <div class="product__optionsblock">
                                            <div class="product__optionstitle">Выбранный цвет: <b>Red</b></div>
                                            <div class="product__options product__colors">
                                                <label class="color">
                                                    <input type="radio" name="color"  checked/>
                                                    <div class="color__text" style="background-color: #880B0B"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #188299"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #AE3A80"></div>
                                                </label>
                                                <label class="color">
                                                    <input type="radio" name="color" />
                                                    <div class="color__text" style="background-color: #99CB47"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <button class="product__addcart">Добавить в корзину <span>23 878 ₽</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="maincategory maincategory--threecol">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="category">
                        <div class="category__image" style="background-image: url(images/dist/catbanners/5.jpg);"></div>
                        <div class="category__title"><a href="">Ароматы</a></div>
                        <div class="category__subtitle">Изысканный выбор парфюмерии, включая духи, туалетную воду и одеколоны от ведущих мировых брендов</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="category">
                        <div class="category__image" style="background-image: url(images/dist/catbanners/6.jpg);"></div>
                        <div class="category__title"><a href="">Натуральная косметика</a></div>
                        <div class="category__subtitle">Экологичные и органические продукты для тех, кто предпочитает натуральные ингредиенты и уход без добавок</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="category">
                        <div class="category__image" style="background-image: url(images/dist/catbanners/7.jpg);"></div>
                        <div class="category__title"><a href="">Мужская линия</a></div>
                        <div class="category__subtitle">Специальные товары, разработанные для мужской кожи и ухода за собой: гели для бритья, лосьоны после бритья, кремы...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="newsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Новости</h2>
                </div>
                <div class="newsblock__container">
                    <div class="article article--news">
                        <div class="article__image"><a href=""><img src="{{asset('images/dist/tmp-news.jpg')}}" alt=""></a></div>
                        <div class="article__date"><svg class="icon"><use xlink:href="images/dist/sprite.svg#calendar"></use></svg> 18 апреля 2023</div>
                        <div class="article__title"><a href="">Эко-инициатива</a></div>
                        <div class="article__intro">Наш магазин присоединяется к глобальной кампании по уменьшению использования пластика! Мы представляем новую линию экологичной упаковки и средств для ухода...</div>
                    </div>
                    <div class="article article--news">
                        <div class="article__image"><a href=""><img src="{{asset('images/dist/tmp-news.jpg')}}" alt=""></a></div>
                        <div class="article__date"><svg class="icon"><use xlink:href="images/dist/sprite.svg#calendar"></use></svg> 18 апреля 2023</div>
                        <div class="article__title"><a href="">Эко-инициатива</a></div>
                        <div class="article__intro">Наш магазин присоединяется к глобальной кампании по уменьшению использования пластика! Мы представляем новую линию экологичной упаковки и средств для ухода...</div>
                    </div>
                    <div class="article article--news">
                        <div class="article__image"><a href=""><img src="{{asset('images/dist/tmp-news.jpg')}}" alt=""></a></div>
                        <div class="article__date"><svg class="icon"><use xlink:href="images/dist/sprite.svg#calendar"></use></svg> 18 апреля 2023</div>
                        <div class="article__title"><a href="">Эко-инициатива</a></div>
                        <div class="article__intro">Наш магазин присоединяется к глобальной кампании по уменьшению использования пластика! Мы представляем новую линию экологичной упаковки и средств для ухода...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mailing">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="" class="mailing__form">
                        <div class="mailing__left">
                            <h2 class="mailing__title">Подписаться на&nbsp;рассылку</h2>
                            <div class="mailing__subtitle">Узнавайте первыми о новых поступлениях, акциях и мероприятиях в магазине</div>
                        </div>
                        <div class="mailing__right">
                            <input type="text" class="mailing__input" placeholder="Введите ваш e-mail">
                            <button class="mailing__button"><svg class="icon"><use xlink:href="images/dist/sprite.svg#circle-arrow"></use></svg></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
@endsection

