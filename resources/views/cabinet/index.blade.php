@extends('cabinet.layouts.cabinet')

@section('title', 'Мій профіль')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Мой профиль</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="chars">
                    <div class="chars__item">
                        <div class="chars__name"><span>Имя и фамилия</span></div>
                        <div class="chars__value"><span>Иван Петров</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>Номер телефона</span></div>
                        <div class="chars__value"><span>+7 495 456 78 96</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>Дата рождения</span></div>
                        <div class="chars__value"><span>17 января 1978</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>E-mail</span></div>
                        <div class="chars__value"><span>info@domen.ru</span></div>
                    </div>
                </div>
                <a href="{{route('profile.edit')}}" class="btn-edit">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use>
                    </svg>
                    Редактировать
                </a>
            </div>
        </div>
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Пароль</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="cabinet-page__data"><b>*********</b></div>
                <a href="{{route('profile.password')}}" class="btn-edit">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use>
                    </svg>
                    Редактировать
                </a>
            </div>
        </div>
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Мои адреса</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="cabinet-page__data">г.Москва ул. Пролетарская 24 / 5</div>
                <div class="cabinet-page__btns">
                    <a href="{{route('profile.addresses')}}" class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#book')}}"></use>
                        </svg>
                        Смотреть все адреса</a>
                    <button class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#add')}}"></use>
                        </svg>
                        Добавить новый адрес
                    </button>
                </div>
            </div>
        </div>
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Мои карты</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="cabinet-page__data"><b>4006 **** **** 4569</b></div>
                <div class="cabinet-page__btns">
                    <button class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>
                        </svg>
                        Удалить карту
                    </button>
                    <button class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#add')}}"></use>
                        </svg>
                        Добавить новую карту
                    </button>
                </div>
            </div>
        </div>
    </main>
@endsection
