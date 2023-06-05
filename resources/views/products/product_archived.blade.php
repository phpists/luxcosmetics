@extends('layouts.app')

@section('title', 'Продукт')
@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="">Главная</a></li>
                        <li class="crumbs__item">{{$product->category->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="product-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="for-mobile">
                        <div class="product-page__title">{{$product->brand->name}}</div>
                        <div class="product-page__subtitle">Libre Eau de Parfum (50ml)</div>
                        <div class="product-page__reviewsblock">
                            <div class="product-page__reviews">
                                <div class="stars">
                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                </div>
                                <a href="">16 отзывов</a>
                            </div>
                            <div class="product-page__available"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#check')}}"></use></svg> В наличии</div>
                        </div>
                    </div>
                    <div class="product-page__galleryblock">
                        <div class="product-page__gallery">

                            <div class="gallery ">
                                <div class="gallery__item"><a href="{{asset('images/dist/tmp-bigproduct.jpg')}}"><img src="{{asset('images/dist/tmp-bigproduct.jpg')}}" alt=""></a></div>
                                <div class="gallery__item"><a href="{{asset('images/dist/tmp-bigproduct.jpg')}}"><img src="{{asset('images/dist/tmp-bigproduct.jpg')}}" alt=""></a></div>
                                <div class="gallery__item"><a href="{{asset('images/dist/tmp-bigproduct.jpg')}}"><img src="{{asset('images/dist/tmp-bigproduct.jpg')}}" alt=""></a></div>
                                <div class="gallery__item"><a href="{{asset('images/dist/tmp-bigproduct.jpg')}}"><img src="{{asset('images/dist/tmp-bigproduct.jpg')}}" alt=""></a></div>
                                <div class="gallery__item"><a href="{{asset('images/dist/tmp-bigproduct.jpg')}}"><img src="{{asset('images/dist/tmp-bigproduct.jpg')}}" alt=""></a></div>
                            </div>

                        </div>
                        <div class="product-page__gallerythumb">
                            <button class="btn-gallery btn-gallery__up" id="gallery-up"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></button>
                            <div class="gallerythumb">
                                <div class="gallerythumb__item"><img src="{{asset('images/dist/tmp-thumb.png')}}" alt=""></div>
                                <div class="gallerythumb__item"><img src="{{asset('images/dist/tmp-thumb.png')}}" alt=""></div>
                                <div class="gallerythumb__item"><img src="{{asset('images/dist/tmp-thumb.png')}}" alt=""></div>
                                <div class="gallerythumb__item"><img src="{{asset('images/dist/tmp-thumb.png')}}" alt=""></div>
                                <div class="gallerythumb__item"><img src="{{asset('images/dist/tmp-thumb.png')}}" alt=""></div>
                            </div>
                            <button class="btn-gallery btn-gallery__down" id="gallery-down"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="for-desktop">
                        <div class="product-page__title">YVES SAINT LAURENT</div>
                        <div class="product-page__subtitle">Libre Eau de Parfum (50ml)</div>
                        <div class="product-page__reviewsblock">
                            <div class="product-page__reviews">
                                <div class="stars">
                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                    <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                    <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                </div>
                                <a href="">16 отзывов</a>
                            </div>
                            <div class="product-page__available"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#check')}}"></use></svg> В наличии</div>
                        </div>
                    </div>
                    <div class="product-page__options">
                        <div class="product-page__options-title">Выбранный размер: <b>90ml</b></div>
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
                    <div class="product-page__options">
                        <div class="product-page__options-title">Выбранный цвет: <b>Red</b></div>
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
                    <div class="product-page__priceblock">
                        <div class="product-page__prices">
                            <div class="product-page__price">10 073 ₽ </div>
                            <del class="product-page__oldprice">12 650 ₽ </del>
                        </div>
                        <div class="product-page__points"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#warning')}}"></use></svg><a href=""> Заработайте 345 баллов</a></div>
                    </div>
                    <button class="btn btn--accent product-page__addcart"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg> Добавить в корзину</button>
                    <div class="product-page__deliveryinfo">
                        <p>Доставка в тот же день: заказ до 13:00 в Москве и <a href="">других городах.</a></p>
                        <p>Бесплатная экспресс-доставка для всех заказов на сумму свыше 10 000 ₽ </p>
                    </div>
                    <div class="product-page__actions">
                        <div class="product-page__action productaction">
                            <div class="productaction__image"><a href=""><img src="{{asset('images/dist/tmp-action.jpg')}}" alt=""></a></div>
                            <div class="productaction__wrap">
                                <div class="productaction__title"><a href="">Получите кэшбэк в размере 5 000 ₽ </a></div>
                                <div class="productaction__intro">Когда вы тратите 20 000 ₽  на сайте! Применяются положения и условия. Подарки автоматически добавляются при оформлении заказа.</div>
                            </div>
                        </div>
                        <div class="product-page__action productaction">
                            <div class="productaction__image"><a href=""><img src="{{asset('images/dist/tmp-action.jpg')}}" alt=""></a></div>
                            <div class="productaction__wrap">
                                <div class="productaction__title"><a href="">Получите кэшбэк в размере 5 000 ₽ </a></div>
                                <div class="productaction__intro">Когда вы тратите 20 000 ₽  на сайте! Применяются положения и условия. Подарки автоматически добавляются при оформлении заказа.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product-page__description">
                        <div class="accordeon product-page__accordeon typography">
                            <dl>
                                <dt class="active">Информация о продукте <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd>
                                    <div class="typography">
                                        <h3>Об аромате</h3>
                                        <p>LIBRE, новый женский аромат от <a href="">Yves Saint Laurent </a>, свобода жить с избытком. Аромат сильной, смелой и свободной женщины, чрезвычайно экспериментирующей со своей свободой.</p>
                                        <p>Новый аромат свободы <a href="">от Ива Сен-Лорана</a>сочетает в себе эссенцию лаванды из Франции и чувственность марокканского апельсинового цвета, создавая уникальное цветочное слияние, дополненное смелой нотой мускусного аккорда.</p>
                                        <h3>Семейство ароматов</h3>
                                        <ul>
                                            <li>Цветочный</li>
                                        </ul>
                                        <h3>Основные примечания</h3>
                                        <ul>
                                            <li>Лавандовая эссенция, апельсиновый цвет, мускусный аккорд</li>
                                        </ul>
                                        <h3>О флаконе</h3>
                                        <p>Флакон представляет собой модный аксессуар с черной асимметричной крышкой, напоминающей сексуальное платье от кутюр.Золотые цепочки на шее напоминают о культовых сумках YSL, а дизайн дополняет вневременной логотип Yves Saint Laurent.</p>
                                    </div>
                                </dd>
                            </dl>
                            <dl>
                                <dt>Как использовать <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd style="display: none;">
                                    <p>Флакон представляет собой модный аксессуар с черной асимметричной крышкой, напоминающей сексуальное платье от кутюр.Золотые цепочки на шее напоминают о культовых сумках YSL, а дизайн дополняет вневременной логотип Yves Saint Laurent.</p>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-tabs__header">
                        <h2 class="title-h2">Рейтинги и обзоры</h2>
                        <div class="product-tabs__rating">
                            4.7
                            <div class="stars">
                                <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                                <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></span>
                            </div>
                        </div>
                        <div class="product-tabs__info">58 отзывов, 4 вопроса и ответа</div>
                        <div class="product-tabs__results">
                            <div class="product-tabs__result reviewresult">
                                <div class="reviewresult__title">Долголетие</div>
                                <div class="reviewresult__spans">
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span"></span>
                                    <span class="reviewresult__span"></span>
                                </div>
                            </div>
                            <div class="product-tabs__result reviewresult">
                                <div class="reviewresult__title">Силос(ароматный след)</div>
                                <div class="reviewresult__spans">
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span"></span>
                                    <span class="reviewresult__span"></span>
                                </div>
                            </div>
                            <div class="product-tabs__result reviewresult">
                                <div class="reviewresult__title">Поглощение</div>
                                <div class="reviewresult__spans">
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span is-active"></span>
                                    <span class="reviewresult__span is-active"></span>
                                </div>
                            </div>
                        </div>
                        <div class="product-tabs__btns">
                            <button class="product-tabs__btn" id="new-review">Написать отзыв</button>
                            <button class="product-tabs__btn" id="new-ask">Задать вопрос</button>
                        </div>
                    </div>

                    <div class="product-tabs__forms">
                        <form action="" class="product-tabs__form form" id="newreview-form">
                            <div class="form__title">Написать отзыв</div>
                            <div class="form__fieldset">
                                <legend class="form__label"> Рейтинг</legend>
                                <div class="form__rating ">
                                    <div class="rating-area">
                                        <input type="radio" id="star-5" name="rating" value="5">
                                        <label for="star-5" title="Оценка «5»"><svg><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></label>
                                        <input type="radio" id="star-4" name="rating" value="4">
                                        <label for="star-4" title="Оценка «4»"><svg><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></label>
                                        <input type="radio" id="star-3" name="rating" value="3">
                                        <label for="star-3" title="Оценка «3»"><svg><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></label>
                                        <input type="radio" id="star-2" name="rating" value="2">
                                        <label for="star-2" title="Оценка «2»"><svg><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></label>
                                        <input type="radio" id="star-1" name="rating" value="1">
                                        <label for="star-1" title="Оценка «1»"><svg><use xlink:href="{{asset('images/dist/sprite.svg#start')}}"></use></svg></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form__fieldset">
                                <legend class="form__label">Заголовок</legend>
                                <input type="text" class="form__input">
                            </div>
                            <div class="form__fieldset">
                                <legend class="form__label">Текст отзыва</legend>
                                <textarea name="" class="form__textarea"></textarea>
                            </div>
                            <div class="form__fieldset">
                                <legend class="form__label">Как быстро он усваивается?</legend>
                                <label class="radio">
                                    <input type="radio" name="radio_1" />
                                    <div class="radio__text">Совсем не быстро</div>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="radio_1"/>
                                    <div class="radio__text">Не так быстро</div>
                                </label>
                                <label class="radio">
                                    <input type="radio"  name="radio_1"/>
                                    <div class="radio__text">Несколько быстро</div>
                                </label>
                                <label class="radio">
                                    <input type="radio"  name="radio_1"/>
                                    <div class="radio__text">Быстрый</div>
                                </label>
                                <label class="radio">
                                    <input type="radio"  name="radio_1"/>
                                    <div class="radio__text">Сверх быстрый</div>
                                </label>
                            </div>
                            <div class="form__fieldset">
                                <legend class="form__label">Как долго он держится на коже и/или волосах?</legend>
                                <label class="radio">
                                    <input type="radio" name="radio_2" />
                                    <div class="radio__text">2 часа или меньше</div>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="radio_2"/>
                                    <div class="radio__text">3 - 4 часа</div>
                                </label>
                                <label class="radio">
                                    <input type="radio"  name="radio_2"/>
                                    <div class="radio__text">5 - 6 часов</div>
                                </label>
                                <label class="radio">
                                    <input type="radio"  name="radio_2"/>
                                    <div class="radio__text">7 - 8 часов</div>
                                </label>
                                <label class="radio">
                                    <input type="radio"  name="radio_2"/>
                                    <div class="radio__text">Долгоиграющий; 12+ часов</div>
                                </label>
                            </div>
                            <div class="form__fieldset">
                                <legend class="form__label">Как вы оцениваете проекцию или силос (ароматный шлейф, возникающий в результате движения)?</legend>
                                <label class="radio">
                                    <input type="radio" name="radio_3" />
                                    <div class="radio__text">Слабый</div>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="radio_3"/>
                                    <div class="radio__text">Мягкий</div>
                                </label>
                                <label class="radio">
                                    <input type="radio"  name="radio_3"/>
                                    <div class="radio__text">Умеренный</div>
                                </label>
                                <label class="radio">
                                    <input type="radio"  name="radio_3"/>
                                    <div class="radio__text">Сильный</div>
                                </label>
                                <label class="radio">
                                    <input type="radio"  name="radio_3"/>
                                    <div class="radio__text">Очень сильный</div>
                                </label>
                            </div>
                            <div class="form__row">
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Ваше имя</legend>
                                        <input type="text" class="form__input">
                                    </div>
                                </div>
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Электронная почта</legend>
                                        <input type="text" class="form__input">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn--accent">Отправить</button>
                            <div class="product-tabs__formclose">Закрыть</div>
                        </form>
                        <form action="" class="product-tabs__form form" id="newask-form">
                            <div class="form__title">Задать вопрос</div>
                            <div class="form__fieldset">
                                <legend class="form__label">Ваш вопрос</legend>
                                <textarea name="" class="form__textarea"></textarea>
                            </div>
                            <div class="form__row">
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Ваше имя</legend>
                                        <input type="text" class="form__input">
                                    </div>
                                </div>
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Электронная почта</legend>
                                        <input type="text" class="form__input">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn--accent">Отправить</button>
                            <div class="product-tabs__formclose">Закрыть</div>
                        </form>

                    </div>
                    <div class="product-tabs__tabsheader tabs">
                        <div class="product-tabs__tab tab">Отзывы</div>
                        <div class="product-tabs__tab tab">Вопросы</div>
                    </div>
                    <div class="product-tabs__tabscontent">
                        <div class="product-tabs__tabsitem">
                            <div class="product-tabs__filters reviewsfilters">
                                <h4 class="reviewsfilters__title">Фильтр отзывов</h4>
                                <form action="" class="reviewsfilters__search search">
                                    <input type="text" class="search__input" placeholder="Поиск отзывов">
                                    <button class="search__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#search')}}"></use></svg></button>
                                </form>
                                <div class="reviewsfilters__selects">
                                    <div class="reviewsfilters__select">
                                        <select name="" class="selectCustom">
                                            <option value="">Рейтинг</option>
                                        </select>
                                    </div>
                                    <div class="reviewsfilters__select">
                                        <select name="" class="selectCustom">
                                            <option value="">Изображения и видео</option>
                                        </select>
                                    </div>
                                    <div class="reviewsfilters__select">
                                        <select name="" class="selectCustom">
                                            <option value="">Поглощение</option>
                                        </select>
                                    </div>
                                    <div class="reviewsfilters__select">
                                        <select name="" class="selectCustom">
                                            <option value="">Долголетие</option>
                                        </select>
                                    </div>
                                    <div class="reviewsfilters__select">
                                        <select name="" class="selectCustom">
                                            <option value="">Силос</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="product-tabs__sortblock sortblock">
                                <div class="sortblock__total">58 отзывов</div>
                                <div class="sortblock__sort sort">
                                    <span class="sort__title">Сортировать по</span>
                                    <select name="" id="" class="sort__select">
                                        <option value="">Самый высокий рейтинг</option>
                                        <option value="">Самый высокий рейтинг</option>
                                    </select>
                                </div>
                            </div>
                            <div class="product-tabs__reviews">
                                <div class="review">
                                    <div class="review__header">
                                        <div class="review__name">Ольга</div>
                                        <div class="review__userstatus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#shield')}}"></use></svg> Проверенный покупатель</div>
                                    </div>
                                    <div class="review__body">
                                        <div class="review__content">Этот аромат стал для меня настоящим открытием! Libre от ИВ СЕН-ЛОРАН обладает свежими и оригинальными нотками, которые прекрасно сочетаются с моим стилем. Парфюмированная вода держится на коже весь день, и я получаю множество комплиментов от коллег и друзей. Рекомендую всем, кто хочет выделиться из толпы и подчеркнуть свою индивидуальность.</div>
                                        <div class="review__images popup-gallery">
                                            <div class="review__image"><a href="{{asset('images/dist/tmp-gallery.jpg')}}"><img src="{{asset('images/dist/tmp-gallery.jpg')}}" alt=""></a></div>
                                            <div class="review__image"><a href="{{asset('images/dist/tmp-gallery.jpg')}}"><img src="{{asset('images/dist/tmp-gallery.jpg')}}" alt=""></a></div>
                                            <div class="review__image"><a href="{{asset('images/dist/tmp-gallery.jpg')}}"><img src="{{asset('images/dist/tmp-gallery.jpg')}}" alt=""></a></div>
                                        </div>
                                        <div class="review__points">
                                            <div class="reviewresult">
                                                <div class="reviewresult__title">Долголетие</div>
                                                <div class="reviewresult__spans">
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span"></span>
                                                    <span class="reviewresult__span"></span>
                                                </div>
                                            </div>
                                            <div class="reviewresult">
                                                <div class="reviewresult__title">Силос(ароматный след)</div>
                                                <div class="reviewresult__spans">
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span"></span>
                                                    <span class="reviewresult__span"></span>
                                                </div>
                                            </div>
                                            <div class="reviewresult">
                                                <div class="reviewresult__title">Поглощение</div>
                                                <div class="reviewresult__spans">
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review__footer">
                                        <div class="review__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 15.03.2022</div>
                                        <div class="review__mark markblock">
                                            <div class="markblock__title">Был ли этот отзыв полезен? </div>
                                            <button class="markblock__btn is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#like')}}"></use></svg> 2</button>
                                            <button class="markblock__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#dislike')}}"></use></svg> 0</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="review">
                                    <div class="review__header">
                                        <div class="review__name">Ольга</div>
                                        <div class="review__userstatus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#shield')}}"></use></svg> Проверенный покупатель</div>
                                    </div>
                                    <div class="review__body">
                                        <div class="review__content">Этот аромат стал для меня настоящим открытием! Libre от ИВ СЕН-ЛОРАН обладает свежими и оригинальными нотками, которые прекрасно сочетаются с моим стилем. Парфюмированная вода держится на коже весь день, и я получаю множество комплиментов от коллег и друзей. Рекомендую всем, кто хочет выделиться из толпы и подчеркнуть свою индивидуальность.</div>
                                        <div class="review__images popup-gallery">
                                            <div class="review__image"><a href="{{asset('images/dist/tmp-gallery.jpg')}}"><img src="{{asset('images/dist/tmp-gallery.jpg')}}" alt=""></a></div>
                                            <div class="review__image"><a href="{{asset('images/dist/tmp-gallery.jpg')}}"><img src="{{asset('images/dist/tmp-gallery.jpg')}}" alt=""></a></div>
                                            <div class="review__image"><a href="{{asset('images/dist/tmp-gallery.jpg')}}"><img src="{{asset('images/dist/tmp-gallery.jpg')}}" alt=""></a></div>
                                        </div>
                                        <div class="review__points">
                                            <div class="reviewresult">
                                                <div class="reviewresult__title">Долголетие</div>
                                                <div class="reviewresult__spans">
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span"></span>
                                                    <span class="reviewresult__span"></span>
                                                </div>
                                            </div>
                                            <div class="reviewresult">
                                                <div class="reviewresult__title">Силос(ароматный след)</div>
                                                <div class="reviewresult__spans">
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span"></span>
                                                    <span class="reviewresult__span"></span>
                                                </div>
                                            </div>
                                            <div class="reviewresult">
                                                <div class="reviewresult__title">Поглощение</div>
                                                <div class="reviewresult__spans">
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review__footer">
                                        <div class="review__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 15.03.2022</div>
                                        <div class="review__mark markblock">
                                            <div class="markblock__title">Был ли этот отзыв полезен? </div>
                                            <button class="markblock__btn is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#like')}}"></use></svg> 2</button>
                                            <button class="markblock__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#dislike')}}"></use></svg> 0</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="review">
                                    <div class="review__header">
                                        <div class="review__name">Ольга</div>
                                        <div class="review__userstatus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#shield')}}"></use></svg> Проверенный покупатель</div>
                                    </div>
                                    <div class="review__body">
                                        <div class="review__content">Этот аромат стал для меня настоящим открытием! Libre от ИВ СЕН-ЛОРАН обладает свежими и оригинальными нотками, которые прекрасно сочетаются с моим стилем. Парфюмированная вода держится на коже весь день, и я получаю множество комплиментов от коллег и друзей. Рекомендую всем, кто хочет выделиться из толпы и подчеркнуть свою индивидуальность.</div>
                                        <div class="review__images popup-gallery">
                                            <div class="review__image"><a href="{{asset('images/dist/tmp-gallery.jpg')}}"><img src="{{asset('images/dist/tmp-gallery.jpg')}}" alt=""></a></div>
                                            <div class="review__image"><a href="{{asset('images/dist/tmp-gallery.jpg')}}"><img src="{{asset('images/dist/tmp-gallery.jpg')}}" alt=""></a></div>
                                            <div class="review__image"><a href="{{asset('images/dist/tmp-gallery.jpg')}}"><img src="{{asset('images/dist/tmp-gallery.jpg')}}" alt=""></a></div>
                                        </div>
                                        <div class="review__points">
                                            <div class="reviewresult">
                                                <div class="reviewresult__title">Долголетие</div>
                                                <div class="reviewresult__spans">
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span"></span>
                                                    <span class="reviewresult__span"></span>
                                                </div>
                                            </div>
                                            <div class="reviewresult">
                                                <div class="reviewresult__title">Силос(ароматный след)</div>
                                                <div class="reviewresult__spans">
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span"></span>
                                                    <span class="reviewresult__span"></span>
                                                </div>
                                            </div>
                                            <div class="reviewresult">
                                                <div class="reviewresult__title">Поглощение</div>
                                                <div class="reviewresult__spans">
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                    <span class="reviewresult__span is-active"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review__footer">
                                        <div class="review__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 15.03.2022</div>
                                        <div class="review__mark markblock">
                                            <div class="markblock__title">Был ли этот отзыв полезен? </div>
                                            <button class="markblock__btn is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#like')}}"></use></svg> 2</button>
                                            <button class="markblock__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#dislike')}}"></use></svg> 0</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="pagination">
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
                        </div>
                        <div class="product-tabs__tabsitem">
                            <div class="product-tabs__asks">
                                <div class="review">
                                    <div class="review__header">
                                        <div class="review__name">Иван Иванов</div>
                                        <div class="review__userstatus">Непроверенный покупатель</div>
                                    </div>
                                    <div class="review__body">
                                        <div class="review__content">Какой срок годности у парфюмерной воды Libre от ИВ СЕН-ЛОРАН? Можно ли ее использовать после истечения срока годности?</div>
                                        <div class="review__answers">
                                            <div class="review__answerstotal">Ответ (1)</div>
                                            <div class="review__answer answer">
                                                <div class="answer__hdr">
                                                    <div class="answer__author">Техподдержка</div>
                                                    <div class="answer__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 20.03.2022</div>
                                                </div>
                                                <div class="answer__content">Парфюмерная вода Libre от ИВ СЕН-ЛОРАН обладает уникальным сочетанием цветочных, фруктовых и древесных нот</div>
                                            </div>
                                            <div class="review__answer answer">
                                                <div class="answer__hdr">
                                                    <div class="answer__author">Техподдержка</div>
                                                    <div class="answer__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 20.03.2022</div>
                                                </div>
                                                <div class="answer__content">Парфюмерная вода Libre от ИВ СЕН-ЛОРАН обладает уникальным сочетанием цветочных, фруктовых и древесных нот</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="review__footer">
                                        <div class="review__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 15.03.2022</div>
                                        <div class="review__mark markblock">
                                            <div class="markblock__title">Был ли этот отзыв полезен? </div>
                                            <button class="markblock__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#like')}}"></use></svg> 2</button>
                                            <button class="markblock__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#dislike')}}"></use></svg> 0</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="review">
                                    <div class="review__header">
                                        <div class="review__name">Иван Иванов</div>
                                        <div class="review__userstatus">Непроверенный покупатель</div>
                                    </div>
                                    <div class="review__body">
                                        <div class="review__content">Какой срок годности у парфюмерной воды Libre от ИВ СЕН-ЛОРАН? Можно ли ее использовать после истечения срока годности?</div>
                                        <div class="review__answers">
                                            <div class="review__answerstotal">Ответ (1)</div>
                                            <div class="review__answer answer">
                                                <div class="answer__hdr">
                                                    <div class="answer__author">Техподдержка</div>
                                                    <div class="answer__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 20.03.2022</div>
                                                </div>
                                                <div class="answer__content">Парфюмерная вода Libre от ИВ СЕН-ЛОРАН обладает уникальным сочетанием цветочных, фруктовых и древесных нот</div>
                                            </div>
                                            <div class="review__answer answer">
                                                <div class="answer__hdr">
                                                    <div class="answer__author">Техподдержка</div>
                                                    <div class="answer__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 20.03.2022</div>
                                                </div>
                                                <div class="answer__content">Парфюмерная вода Libre от ИВ СЕН-ЛОРАН обладает уникальным сочетанием цветочных, фруктовых и древесных нот</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="review__footer">
                                        <div class="review__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 15.03.2022</div>
                                        <div class="review__mark markblock">
                                            <div class="markblock__title">Был ли этот отзыв полезен? </div>
                                            <button class="markblock__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#like')}}"></use></svg> 2</button>
                                            <button class="markblock__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#dislike')}}"></use></svg> 0</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="review">
                                    <div class="review__header">
                                        <div class="review__name">Иван Иванов</div>
                                        <div class="review__userstatus">Непроверенный покупатель</div>
                                    </div>
                                    <div class="review__body">
                                        <div class="review__content">Какой срок годности у парфюмерной воды Libre от ИВ СЕН-ЛОРАН? Можно ли ее использовать после истечения срока годности?</div>
                                        <div class="review__answers">
                                            <div class="review__answerstotal">Ответ (1)</div>
                                            <div class="review__answer answer">
                                                <div class="answer__hdr">
                                                    <div class="answer__author">Техподдержка</div>
                                                    <div class="answer__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 20.03.2022</div>
                                                </div>
                                                <div class="answer__content">Парфюмерная вода Libre от ИВ СЕН-ЛОРАН обладает уникальным сочетанием цветочных, фруктовых и древесных нот</div>
                                            </div>
                                            <div class="review__answer answer">
                                                <div class="answer__hdr">
                                                    <div class="answer__author">Техподдержка</div>
                                                    <div class="answer__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 20.03.2022</div>
                                                </div>
                                                <div class="answer__content">Парфюмерная вода Libre от ИВ СЕН-ЛОРАН обладает уникальным сочетанием цветочных, фруктовых и древесных нот</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="review__footer">
                                        <div class="review__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> 15.03.2022</div>
                                        <div class="review__mark markblock">
                                            <div class="markblock__title">Был ли этот отзыв полезен? </div>
                                            <button class="markblock__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#like')}}"></use></svg> 2</button>
                                            <button class="markblock__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#dislike')}}"></use></svg> 0</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="pagination">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="products-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper">
                        <div class="tabs">
                            <span class="tab">Выбрано для вас</span>
                            <span class="tab">Вам также может понравиться</span>
                            <span class="tab">Клиенты также просмотрели</span>
                        </div>
                        <div class="tab_content">
                            <div class="tab_item">
                                <div class="otherproducts-slider">
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                            </div>
                            <div class="tab_item">
                                <div class="otherproducts-slider">
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                            </div>
                            <div class="tab_item">
                                <div class="otherproducts-slider">
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}"  alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}"  alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}"  alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}"  alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                                    <div class="products-slider__item">
                                        <div class="product">
                                            <div class="product__top">
                                                <div class="product__image">
                                                    <div class="product__labels">
                                                        <div class="product__label product__label--brown">-50%</div>
                                                        <div class="product__label product__label--green">Хит продаж</div>
                                                    </div>
                                                    <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}"  alt=""></a>
                                                    <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-set">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Наборы</h2>
                    <div class="product-set__container">
                        <div class="product-set__product"><div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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

                            </div></div>
                        <div class="product-set__symbol">+</div>
                        <div class="product-set__product"><div class="product">
                                <div class="product__top">
                                    <div class="product__image">
                                        <div class="product__labels">
                                            <div class="product__label product__label--brown">-50%</div>
                                            <div class="product__label product__label--green">Хит продаж</div>
                                        </div>
                                        <a href=""><img src="{{asset('/images/dist/tmp-product.jpg')}}" alt=""></a>
                                        <button class="product__fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg></button>
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

                            </div></div>
                        <div class="product-set__symbol">=</div>
                        <div class="product-set__total">
                            <div class="product-set__subtitle">Цена за комплект</div>
                            <div class="product-set__price">24 800 ₽ </div>
                            <del class="product-set__oldprice">32 650 ₽ </del>
                            <button class="btn btn--accent product-page__addcart product-set__addcart"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg> Добавить в корзину</button>
                        </div>
                    </div>
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
