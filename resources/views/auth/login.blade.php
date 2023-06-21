{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

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
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    <a href="{{ route('register') }}">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                    </a>--}}
{{--                                </button>--}}
{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

@extends('layouts.app')

@section('content')
    <section class="signin-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">Войти</div>
                    <div class="signin-page__wrap">
                        <div class="signin-page__social">
                            <p>Зарегистрируйтесь через</p>
                            <div class="cart-auth__providers">
                                <a href="{{route('login_socialite', ['provider' => 'google'])}}" class="cart-auth__provider">
                                    <img src="{{asset('images/dist/icons/google.svg')}}" alt="">
                                    <span>Google</span>
                                </a>
                                <a href="{{route('login_socialite', ['provider' => 'facebook'])}}" class="cart-auth__provider">
                                    <img src="{{asset('images/dist/icons/fb.svg')}}" alt="">
                                    <span>Facebook</span>
                                </a>
                            </div>
                        </div>
                        <p><b>ИЛИ</b></p>
                        <form method="POST" action="{{ route('login') }}" class="form form--box signin-page__form">
                            @csrf
                            <div class="form__fieldset">
                                <legend class="form__label">Электронная почта *</legend>
                                <input type="text" name="email" class="form__input" placeholder="Введите ваш email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form__fieldset">
                                <legend class="form__label">Пароль *</legend>
                                <input type="password" name="password" class="form__input" placeholder="Введите ваш пароль">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form__fieldset form__ftr">
                                <label class="checkbox">
                                    <input type="checkbox" />
                                    <div class="checkbox__text">Запомнить меня</div>
                                </label>
                                <a href="#fgt-password" class="popup-with-form">Забыли пароль?</a>
                            </div>
                            <button class="btn btn--accent">Авторизоваться</button>
                        </form>
                        <p><b>ИЛИ</b></p>
                        <a href="{{ route('register') }}"  class="btn btn--accent">Создать аккаунт</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="hidden">
        <div class="popupform" id="fgt-password">
            <div class="subheading">Восстановление пароля</div>
            <p>Укажите адрес электронной почты своей учетной записи, чтобы получить электронное письмо для сброса пароля.</p>
            <form  method="POST" action="{{ route('password.reset-password') }}" class="form form--box">
                @csrf
                <div class="form__fieldset">
                    <legend class="form__label">Ваш e-mail</legend>
                    <input type="text" name="email" required class="form__input">
                </div>
                <button class="btn btn--accent">Отправить</button>
            </form>
        </div>
    </div>
@endsection
