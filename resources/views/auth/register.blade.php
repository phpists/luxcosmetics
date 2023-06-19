@extends('layouts.app')

@section('content')
    <section class="signin-page reg-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">Регистрация</div>
                    <p><b>Создайте учетную запись, чтобы пользоваться эксклюзивными преимуществами</b></p>
                    <p>Включая отслеживание заказов и ранний доступ к нашим мероприятиям и специальным предложениям
                    </p>
                    <form method="POST" action="{{ route('register') }}" class="form form--box  typography">
                        @csrf
                        <div class="form__row">
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Имя  *</legend>
                                    <input name="name" type="text" class="form__input" >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Фамилия  *</legend>
                                    <input name="surname" type="text" class="form__input" >
                                </div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Телефон *</legend>
                                    <input type="text" name="phone" class="form__input">
                                </div>
                            </div>
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Электронная почта *</legend>
                                    <input type="text" name="email" class="form__input">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Пароль *</legend>
                                    <input type="password"  name="password" class="form__input" >
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Подтвердите пароль *</legend>
                                    <input type="password" name="password_confirmation"  class="form__input" placeholder="Введите ваш пароль">
                                </div>
                            </div>
                        </div>
                        <div class="form__fieldset">
                            <legend class="form__label">Дата рождения</legend>
                            <div class="form__row">
                                <div class="form__col form__col--33">
                                    <div class="form__fieldset"><input type="text" class="form__input" placeholder="День"></div>
                                </div>
                                <div class="form__col form__col--33">
                                    <div class="form__fieldset"><input type="text" class="form__input" placeholder="Месяц"></div>
                                </div>
                                <div class="form__col form__col--33">
                                    <div class="form__fieldset"><input type="text" class="form__input" placeholder="Год"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form__fieldset">
                            <legend class="form__label">Выберите предпочтительный способ связи
                            </legend>

                            <label class="checkbox">
                                <input type="checkbox" name="communications[]" />
                                <div class="checkbox__text">Электронная почта</div>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="communications[]" />
                                <div class="checkbox__text">SMS</div>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="communications[]" />
                                <div class="checkbox__text">Телефон</div>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="communications[]" />
                                <div class="checkbox__text">WhatsApp</div>
                            </label>
                        </div>
                        <div class="form__fieldset">
                            <label class="checkbox">
                                <input type="checkbox" name="newsletter" />
                                <div class="checkbox__text">Подпишитесь на рассылку новостей<br> <small>Установив этот флажок, вы соглашаетесь получать сообщения о запуске новых продуктов, эксклюзивных событиях в магазине и сезонных рекламных акциях.</small></div>
                            </label>
                        </div>
                        <div class="form__fieldset">
                            <label class="checkbox">
                                <input type="checkbox" name="agreement" required/>
                                <div class="checkbox__text">Я прочитал <a href="">Условия и положения</a> , а также <a href="">Политику конфиденциальности</a> и согласен с ними*</div>
                            </label>
                        </div>


                        <button class="btn btn--accent">Зарегистрироваться</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection

{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    <a href="{{ route('login') }}">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                    </a>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
