@extends('cabinet.layouts.cabinet')

@section('title', 'Изменить свои данные')

@section('page_content')
    <main class="cabinet-page__main">
        <form action="" class="form form--box">
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Ваше имя *</legend>
                        <input type="text" class="form__input">
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Фамилия *</legend>
                        <input type="text" class="form__input">
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Номер телефона *</legend>
                        <input type="text" class="form__input">
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Электронная почта *</legend>
                        <input type="text" class="form__input">
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Пароль</legend>
                        <input type="text" class="form__input">
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Дата рождения</legend>
                        <div class="form__row">
                            <div class="form__col form__col--33"><input type="text" class="form__input" value="10">
                            </div>
                            <div class="form__col form__col--33"><input type="text" class="form__input" value="Январь">
                            </div>
                            <div class="form__col form__col--33"><input type="text" class="form__input" value="1978">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form__fieldset">
                <label class="checkbox checkbox--mailer">
                    <input type="checkbox"/>
                    <div class="checkbox__text">Подписаться на рассылку</div>
                </label>
                <button class="btn btn--accent">Сохранить изменения</button>
            </div>
        </form>
    </main>
@endsection
