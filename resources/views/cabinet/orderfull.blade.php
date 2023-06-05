@extends('cabinet.layouts.cabinet')

@section('title', 'Подарочные карты')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Информация о заказе</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="chars">
                    <div class="chars__item">
                        <div class="chars__name"><span>Статус заказа</span></div>
                        <div class="chars__value"><span><b class="status status--new">Новый</b></span></div>
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
                <button class="btn btn--accent">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#repeat')}}"></use>
                    </svg>
                    Повторить заказ
                </button>
            </div>
        </div>
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Состав заказа</h3>
            <div class="cart-table">
                <div class="cart-table__thead">
                    <div class="cart-table__th cart-table__th--name">Наименование</div>
                    <div class="cart-table__th cart-table__th--count-and-price">Цена и кол-во</div>
                    <div class="cart-table__th cart-table__th--sum">Сумма</div>
                </div>
                <div class="cart-table__body">
                    <div class="cart-table__item cart-product">
                        <div class="cart-product__image">
                            <a href=""><img src="{{asset('images/dist/tmp-product2.jpg')}}" alt=""></a>
                        </div>
                        <div class="cart-product__desc">
                            <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                            <div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>
                            <div class="cart-product__options">
                                <div class="cart-product__option">Выбранный цвет: <b>Red</b></div>
                                <div class="cart-product__option">Выбранный размер: <b>90ml</b></div>
                            </div>
                        </div>

                        <div class="cart-product__prices-and-count">
                            <div class="cart-product__price">2 x 10 073 ₽</div>
                            <div class="cart-product__oldprice">12 650 ₽</div>
                        </div>
                        <div class="cart-product__sum">20 146 ₽</div>
                    </div>
                    <div class="cart-table__item cart-product">
                        <div class="cart-product__image">
                            <a href=""><img src="{{asset('images/dist/tmp-product2.jpg')}}" alt=""></a>
                        </div>
                        <div class="cart-product__desc">
                            <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                            <div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>
                            <div class="cart-product__options">
                                <div class="cart-product__option">Выбранный цвет: <b>Red</b></div>
                                <div class="cart-product__option">Выбранный размер: <b>90ml</b></div>
                            </div>
                        </div>

                        <div class="cart-product__prices-and-count">
                            <div class="cart-product__price">2 x 10 073 ₽</div>
                            <div class="cart-product__oldprice">12 650 ₽</div>
                        </div>
                        <div class="cart-product__sum">20 146 ₽</div>
                    </div>
                    <div class="cart-table__item  cart-product cart-product--gift">
                        <div class="cart-product__image">
                            <a href=""><img src="{{asset('images/dist/tmp-product2.jpg')}}" alt=""></a>
                        </div>
                        <div class="cart-product__desc">
                            <div class="cart-product__title"><a href="">YVES SAINT LAURENT</a></div>
                            <div class="cart-product__subtitle">Libre Eau de Parfum (50ml)</div>
                        </div>
                        <div class="cart-product__sum cart-product__sum--free">Бесплатно</div>
                    </div>
                </div>
            </div>
            <div class="cabinet-page__total">Итого с НДС <b>40 292 ₽</b></div>
        </div>
    </main>
@endsection
