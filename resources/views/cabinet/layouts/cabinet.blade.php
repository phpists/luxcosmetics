@extends('layouts.app')

@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="">Главная</a></li>
                        <li class="crumbs__item">@yield('title')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="cabinet-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title-h1">
                        @yield('title')
                    </h1>
                    <div class="cabinet-page__container">
                        <aside class="cabinet-page__aside">
                            <ul class="cabmenu">
                                <li class="is-active"><a href="{{route('profile')}}">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#user')}}"></use>
                                        </svg>
                                        Мой профиль</a></li>
                                <li><a href="{{route('profile.order-history')}}">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#bug')}}"></use>
                                        </svg>
                                        История заказов</a></li>
                                <li><a href="{{route('profile.subscriptions')}}">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#bug')}}"></use>
                                        </svg>
                                        Подписки</a></li>
                                <li><a href="{{route('profile.addresses')}}">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#book')}}"></use>
                                        </svg>
                                        Мои адреса</a></li>
                                <li><a href="{{route('profile.payment-methods')}}">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#mastercard')}}"></use>
                                        </svg>
                                        Способы оплаты</a></li>
                                <li><a href="{{route('profile.gift-cards')}}">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#gift')}}"></use>
                                        </svg>
                                        Подарочные карты</a></li>
                                <li><a href="{{route('profile.bonuses')}}">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#label')}}"></use>
                                        </svg>
                                        Бальная система <span class="cabmenu__label">{{\Illuminate\Support\Facades\Auth::user()->points}} баллов</span></a></li>
                                <li><a href="{{route('profile.password')}}">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#shield2')}}"></use>
                                        </svg>
                                        Пароль</a></li>
                                <li><a href="{{route('profile.support')}}">
                                        <svg class="icon">
                                            <use xlink:href="{{asset('images/dist/sprite.svg#chats')}}"></use>
                                        </svg>
                                        Обратная связь</a></li>
                            </ul>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button class="btn btn--accent btn--full">
                                    <svg class="icon">
                                        <use xlink:href="{{asset('images/dist/sprite.svg#exit')}}"></use>
                                    </svg>
                                    Выйти из личного кабинета</button>
                            </form>
                        </aside>
                        @yield('page_content')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
