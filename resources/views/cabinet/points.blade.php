@extends('cabinet.layouts.cabinet')

@section('title', 'Программа лояльности')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group">
            <div class="points">
                <div class="points__title">Ваш баланс</div>
                <div class="points__sum">{{\Illuminate\Support\Facades\Auth::user()->points}} баллов</div>
            </div>
        </div>
        <div class="cabinet-page__group">
            <h3 class="subheading">Информация об аккаунте</h3>
            <div class="chars">
                <div class="chars__item">
                    <div class="chars__name"><span>Номер телефона</span></div>
                    <div class="chars__value"><span>+{{\Illuminate\Support\Facades\Auth::user()->phone}}</span></div>
                </div>
                <div class="chars__item">
                    <div class="chars__name"><span>Уровень</span></div>
                    <div class="chars__value"><span>Изумруд</span></div>
                </div>
                <div class="chars__item">
                    <div class="chars__name"><span>Ваш ID номер</span></div>
                    <div class="chars__value"><span>46565899654231</span></div>
                </div>
            </div>
        </div>
        <div class="cabinet-page__group">
            <h3 class="subheading">Как работает программа лояльности</h3>
            <div class="typography">
                <p>Совершайте покупки в любом магазине, учавствующем в программе, чтобы зарабатывать и использовать
                    баллы.</p>
                <p>Чем больше баллов вы заработаете, тем больше наград вы получите в своих любимых брендах и
                    магазинах</p>
            </div>
        </div>
    </main>
@endsection
