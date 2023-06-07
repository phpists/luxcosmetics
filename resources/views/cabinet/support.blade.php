@extends('cabinet.layouts.cabinet')

@section('title', 'Обратная связь')

@section('page_content')
    <main class="cabinet-page__main">
        <form action="" class="form form--box">

            <div class="form__fieldset">
                <legend class="form__label">Причина обращения *</legend>
                <select name="" id="" class="selectCustom">
                    <option value="">Причина 1</option>
                    <option value="">Причина 2</option>
                    <option value="">Причина 3</option>
                    <option value="">Причина 4</option>
                </select>
            </div>
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Адрес электронной почты *</legend>
                        <input type="text" class="form__input">
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Номер телефона *</legend>
                        <input type="text" class="form__input">
                    </div>
                </div>
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Номер заказа *</legend>
                <input type="text" class="form__input">
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Тема обращения</legend>
                <input type="text" class="form__input">
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Текст вашего обращения</legend>
                <textarea name="" class="form__textarea"></textarea>
            </div>
            <button class="btn btn--accent">Отправить на рассмотрение</button>
        </form>
    </main>
@endsection
