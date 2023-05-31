@extends('layouts.app')

@section('title', 'Категория')
@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="">Главная</a></li>
                        <li class="crumbs__item">Категория</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="category-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">Уход за телом</div>
                    <div class="category-page__container">
                        <aside class="category-page__aside">
                            <div class="filters" id="filters">
                                <div class="filters__close"><svg class="icon"><use xlink:href="images/dist/sprite.svg#close"></use></svg></div>
                                <div class="filters__hdr">
                                    <div class="filters__title">Сортировать по</div>
                                    <button class="filters__btn">Сбросить все</button>
                                </div>
                                <div class="filters__wrapper">
                                    <div class="filters__item filter">
                                        <div class="filter__title">Цена <svg class="icon"><use xlink:href="images/dist/sprite.svg#arrow"></use></svg></div>
                                        <div class="filter__block">
                                            <div class="filter__wrap">
                                                <div class="filter__range" id="slider-range"></div>
                                                <div class="filter__row">
                                                    <div class="filter__col">
                                                        <span>от</span>
                                                        <input type="text" class="filter__input" id="amount">
                                                    </div>
                                                    <div class="filter__col">
                                                        <span>до</span>
                                                        <input type="text" class="filter__input" id="amount2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filters__item filter">
                                        <div class="filter__title">Бренд <svg class="icon"><use xlink:href="images/dist/sprite.svg#arrow"></use></svg></div>
                                        <div class="filter__block">
                                            <div class="filter__wrap filter__scroll">
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Gucci</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Calvin Klein</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Chanel</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Dior</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Estee Lauder</div>
                                                </label>

                                            </div>
                                            <button class="filter__all">Показать все</button>
                                        </div>
                                    </div>
                                    <div class="filters__item filter">
                                        <div class="filter__title is-close">Цвет <svg class="icon"><use xlink:href="images/dist/sprite.svg#arrow"></use></svg></div>
                                        <div class="filter__block" style="display: none;">
                                            <div class="filter__wrap filter__scroll">
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Красный</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Синий</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Зеленый</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Красный</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Синий</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Зеленый</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Красный</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Синий</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Зеленый</div>
                                                </label>
                                            </div>
                                            <button class="filter__all">Показать все</button>
                                        </div>
                                    </div>
                                    <div class="filters__item filter">
                                        <div class="filter__title is-close">Пол <svg class="icon"><use xlink:href="images/dist/sprite.svg#arrow"></use></svg></div>
                                        <div class="filter__block" style="display: none;">
                                            <div class="filter__wrap filter__scroll">
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Для мужчин</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Для женщин</div>
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" />
                                                    <div class="checkbox__text">Унисекс</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filters__ftr">
                                    <button class="filters__btn">Показать</button>
                                    <button class="filters__btn">Сбросить</button>
                                </div>

                            </div>

                            <div class="category-page__image"><img src="" alt=""></div>
                        </aside>
                        <main class="category-page__main">
                            <ul class="category-page__subcategories">
                                <li>
                                    <a href="" class="category-page__subcategory">
                                        <span class="category-page__subcategory-image"><img src="{{asset('images/dist/subcategory/1.jpg')}}" alt=""></span>
                                        <span class="category-page__subcategory-title">Скрабы и пилинги для тела</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="category-page__subcategory">
                                        <span class="category-page__subcategory-image"><img src="{{asset('images/dist/subcategory/2.jpg')}}" alt=""></span>
                                        <span class="category-page__subcategory-title">Увлажняющие кремы и лосьоны</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="category-page__subcategory">
                                        <span class="category-page__subcategory-image"><img src="{{asset('images/dist/subcategory/3.jpg')}}" alt=""></span>
                                        <span class="category-page__subcategory-title">Масла для массажа и ухода</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="category-page__subcategory">
                                        <span class="category-page__subcategory-image"><img src="{{asset('images/dist/subcategory/4.jpg')}}" alt=""></span>
                                        <span class="category-page__subcategory-title">Антицеллюлитные и моделирующие средства</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="category-page__sortblock sortblock">
                                <div class="sortblock__total">Показано <b>12 из 178</b></div>
                                <div class="sortblock__sort sort">
                                    <span class="sort__title">Сортировать по</span>
                                    <select name="" id="" class="sort__select">
                                        <option value="">Возрастанию цены</option>
                                        <option value="">Убыванию цены</option>
                                    </select>
                                </div>
                            </div>
                            <div class="category-page__mobilenav">
                                <button class="category-page__mobilebtn btnfilters"><svg class="icon"><use xlink:href="images/dist/sprite.svg#filters"></use></svg> Показать фильтры</button>
                                <button class="category-page__mobilebtn btnsort"><svg class="icon"><use xlink:href="images/dist/sprite.svg#arrows"></use></svg> Сортировать по</button>
                            </div>
                            <div class="category-page__products">
                                <div class="category-page__product">
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
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
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
                                <div class="category-page__product">
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
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
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
                                <div class="category-page__product">
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
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
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
                                <div class="category-page__product">
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
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
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
                                <div class="category-page__product">
                                    <div class="category-page__action"><img src="" alt=""></div>
                                </div>
                                <div class="category-page__product">
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
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
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
                                <div class="category-page__product">
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
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
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
                                <div class="category-page__product">
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
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
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
                                <div class="category-page__product">
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
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
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
                            <div class="category-page__pagination pagination">
                                <button class="pagination__more">Показать  еще <span>12 товаров</span> <svg class="icon"><use xlink:href="images/dist/sprite.svg#refresh"></use></svg></button>
                                <ul class="pagination__list">
                                    <li class="pagination__item pagination__item--first"><a href=""><svg class="icon"><use xlink:href="images/dist/sprite.svg#first"></use></svg></a></li>
                                    <li class="pagination__item pagination__item--prev"><a href=""><svg class="icon"><use xlink:href="images/dist/sprite.svg#prev1"></use></svg></a></li>
                                    <li class="pagination__item pagination__item--active"><span>1</span></li>
                                    <li class="pagination__item"><a href="">2</a></li>
                                    <li class="pagination__item"><a href="">3</a></li>
                                    <li class="pagination__item pagination__item--dots">...</li>
                                    <li class="pagination__item"><a href="">36</a></li>
                                    <li class="pagination__item pagination__item--next"><a href=""><svg class="icon"><use xlink:href="images/dist/sprite.svg#next1"></use></svg></a></li>
                                    <li class="pagination__item pagination__item--last"><a href=""><svg class="icon"><use xlink:href="images/dist/sprite.svg#last"></use></svg></a></li>
                                </ul>
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
        <div class="sortmobile__close"><svg class="icon"><use xlink:href="images/dist/sprite.svg#close"></use></svg></div>
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
@endsection
