@extends('cabinet.layouts.cabinet')

@section('title', 'Способы оплаты')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group">
            <h3 class="subheading subheading--with-form">Привязанные карты</h3>
            <div class="mycards">
                <div class="mycards__item mycard">
                    <div class="mycard__wrap">
                        <div class="mycard__ico">
                            <svg class="icon">
                                <use xlink:href="{{asset('images/dist/sprite.svg#mastercard')}}"></use>
                            </svg>
                        </div>
                        <div class="mycard__card">4006 **** **** 4569
                            <div class="mycard__notice">Действительна до 07/24</div>
                        </div>
                    </div>
                    <button class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>
                        </svg>
                        Удалить карту
                    </button>
                </div>
                <div class="mycards__item mycard">
                    <div class="mycard__wrap">
                        <div class="mycard__ico">
                            <svg class="icon">
                                <use xlink:href="{{asset('images/dist/sprite.svg#mastercard')}}"></use>
                            </svg>
                        </div>
                        <div class="mycard__card">4006 **** **** 4569
                            <div class="mycard__notice">
                                <svg class="icon">
                                    <use xlink:href="{{asset('images/dist/sprite.svg#warning')}}"></use>
                                </svg>
                                Не действительна
                            </div>
                        </div>
                    </div>
                    <button class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>
                        </svg>
                        Удалить карту
                    </button>
                </div>
            </div>
            <div class="text-right">
                <a href="#new-card" class="btn btn--accent popup-with-form">Добавить новую карту</a>
            </div>
        </div>
    </main>
    <div class="hidden">
        <div class="popupform" id="new-card">
            <div class="subheading subheading--with-form">Добавить новую карту</div>
            <form action="" class="form form--box">
                <div class="form__row">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Номер карты</legend>
                            <input type="text" class="form__input">
                        </div>
                        <div class="form__fieldset">
                            <legend class="form__label">Срок действия</legend>
                            <div class="form__row">
                                <div class="form__col form__col--33"><input type="text" class="form__input"></div>
                                <div class="form__col form__col--33"><input type="text" class="form__input"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Фамилия и имя</legend>
                            <input type="text" class="form__input">
                        </div>
                        <div class="form__fieldset">
                            <legend class="form__label">CVV</legend>
                            <div class="form__row">
                                <div class="form__col form__col--33"><input type="text" class="form__input"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__fieldset">
                    <label class="checkbox checkbox--mailer">
                        <input type="checkbox"/>
                        <div class="checkbox__text">Сделать способом оплаты по умолчанию</div>
                    </label>
                    <button class="btn btn--accent">Добавить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
