@extends('layouts.app')

@section('title', 'Оплата')

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
    <section class="cart-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-page__steps">
                        <div class="cart-page__step">1. Авторизация</div>
                        <div class="cart-page__step">2. Доставка</div>
                        <div class="cart-page__step is-active">3. Оплата </div>
                    </div>
                    <div class="cart-page__container">
                        {!! $form !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
