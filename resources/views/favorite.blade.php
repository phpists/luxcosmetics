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
                                <button class="category-page__mobilebtn btnsort"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrows')}}"></use></svg> Сортировать по</button>
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
                <a href=""><img src="images/dist/tmp-product.jpg" alt=""></a>
                <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
            </div>
            <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
            <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
        </div>
        <div class="product__btm">
            <div class="product__reviews">
                <div class="stars">
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                </div>
                <a href="">16 отзывов</a>
            </div>
            <div class="product__ftrwrap">
                <div class="product__prices">
                    <div class="product__price">4 009 ₽</div>
                    <del class="product__oldprice">4 700 ₽</del>
                </div>
                <button class="product__mobile-btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg></button>
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
                <a href=""><img src="images/dist/tmp-product.jpg" alt=""></a>
                <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
            </div>
            <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
            <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
        </div>
        <div class="product__btm">
            <div class="product__reviews">
                <div class="stars">
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                </div>
                <a href="">16 отзывов</a>
            </div>
            <div class="product__ftrwrap">
                <div class="product__prices">
                    <div class="product__price">4 009 ₽</div>
                    <del class="product__oldprice">4 700 ₽</del>
                </div>
                <button class="product__mobile-btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg></button>
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
                <a href=""><img src="images/dist/tmp-product.jpg" alt=""></a>
                <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
            </div>
            <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
            <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
        </div>
        <div class="product__btm">
            <div class="product__reviews">
                <div class="stars">
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                </div>
                <a href="">16 отзывов</a>
            </div>
            <div class="product__ftrwrap">
                <div class="product__prices">
                    <div class="product__price">4 009 ₽</div>
                    <del class="product__oldprice">4 700 ₽</del>
                </div>
                <button class="product__mobile-btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg></button>
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
                <a href=""><img src="images/dist/tmp-product.jpg" alt=""></a>
                <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
            </div>
            <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
            <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
        </div>
        <div class="product__btm">
            <div class="product__reviews">
                <div class="stars">
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                </div>
                <a href="">16 отзывов</a>
            </div>
            <div class="product__ftrwrap">
                <div class="product__prices">
                    <div class="product__price">4 009 ₽</div>
                    <del class="product__oldprice">4 700 ₽</del>
                </div>
                <button class="product__mobile-btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg></button>
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
                <a href=""><img src="images/dist/tmp-product.jpg" alt=""></a>
                <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
            </div>
            <div class="product__title"><a href="">ROBERTO CAVALLI</a></div>
            <div class="product__subtitle">Frantic Rose Gold Collection Eau de Parfum 100ml (100ml)</div>
        </div>
        <div class="product__btm">
            <div class="product__reviews">
                <div class="stars">
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                </div>
                <a href="">16 отзывов</a>
            </div>
            <div class="product__ftrwrap">
                <div class="product__prices">
                    <div class="product__price">4 009 ₽</div>
                    <del class="product__oldprice">4 700 ₽</del>
                </div>
                <button class="product__mobile-btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg></button>
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
                                <button class="pagination__more">Показать  еще <span>12 товаров</span> <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use></svg></button>
                                <ul class="pagination__list">
                                    <li class="pagination__item pagination__item--first"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use></svg></a></li>
                                    <li class="pagination__item pagination__item--prev"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use></svg></a></li>
                                    <li class="pagination__item pagination__item--active"><span>1</span></li>
                                    <li class="pagination__item"><a href="">2</a></li>
                                    <li class="pagination__item"><a href="">3</a></li>
                                    <li class="pagination__item pagination__item--dots">...</li>
                                    <li class="pagination__item"><a href="">36</a></li>
                                    <li class="pagination__item pagination__item--next"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use></svg></a></li>
                                    <li class="pagination__item pagination__item--last"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use></svg></a></li>
                                </ul>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="sortmobile">
        <div class="sortmobile__close"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg></div>
        <div class="sortmobile__title">Выберите категорию</div>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">Уход за кожей</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">Уход за телом</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">Уход за волосами</div>
        </label>
    </div>
@endsection
