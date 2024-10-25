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
                        <p><b>Авторизация на сайте</b></p>
                        <form id="loginForm" method="POST" action="{{ route('login.store') }}" class="form form--box signin-page__form">
                            @csrf
                            @if (session('error'))
                                <p class="invalid-feedback" role="alert" style="margin-bottom: 17px; font-size: 18px">
                                        <strong style="color: red">{{ session('error') }}</strong>
                                    </p>
                            @endif
                            <div class="form__fieldset">
                                <legend class="form__label">Номер телефона *</legend>
                                <input type="tel" name="phone" class="form__input phone_inp" placeholder="Введите ваш номер телефон" required>
                                <span class="invalid-feedback" role="alert"><strong></strong></span>
                            </div>
                            <button type="submit" class="btn btn--accent">Авторизоваться</button>
                        </form>
                        <p><b>Регистрация на сайте</b></p>
                        <a href="{{ route('register') }}"  class="btn btn--accent">Создать аккаунт</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/inputmask/inputmask.js') }}"></script>
    <script src="{{ asset('js/inputmask/jquery.inputmask.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            Inputmask("+7 (999) 999-99-99").mask('.phone_inp');

            $(document).on('submit', '#loginForm', function (e) {
                e.preventDefault();
                const $form = $(this);
                submitLiveForm($form, function (response, json) {
                    if (response.status == 200) {
                        $('#otpForm').find('[name="phone"]').val($form.find('[name="phone"]').val())
                        openModal('#otpModal')
                        if (json.message)
                            $('button:submit[form="resendCodeForm"]').setCooldown(60);
                    }
                })
            })
        });
    </script>
@endsection
