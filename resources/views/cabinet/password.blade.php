@extends('cabinet.layouts.cabinet')

@section('title', 'Изменить пароль')

@section('page_content')
    <main class="cabinet-page__main">
        <form action="" class="form form--box">
            <div class="form__fieldset">
                <legend class="form__label">Текущий пароль *</legend>
                <input type="password" class="form__input">
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Новый пароль *</legend>
                <input type="password" class="form__input">
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Повторить новый пароль</legend>
                <input type="password" class="form__input">
            </div>
            <button class="btn btn--accent">Сохранить изменения</button>
        </form>
    </main>

@endsection
