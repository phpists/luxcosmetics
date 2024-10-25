@extends('layouts.app')

@section('title', $metaTitle = getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::REGISTER))
@section('description', $metaDescription = getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::REGISTER))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)

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
    <script
        src="https://www.google.com/recaptcha/api.js?render={{ config('services.google.captcha.site_key') }}"></script>
    <script src="{{ asset('js/inputmask/inputmask.js') }}"></script>
    <script src="{{ asset('js/inputmask/jquery.inputmask.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            Inputmask("+7 (999) 999-99-99").mask('.phone_inp');

            $(document).on('submit', '#loginForm', function (e) {
                e.preventDefault();
                const $form = $(this);

                $form.find('button:submit').prop('disabled', true)

                grecaptcha.ready(function () {
                    grecaptcha.execute('{{ config('services.google.captcha.site_key') }}', {action: 'submit'})
                        .then(function (token) {
                            submitLiveForm($form, function (response, json) {
                                if (response.status == 200) {
                                    $('#otpForm').find('[name="phone"]').val($form.find('[name="phone"]').val())
                                    openModal('#otpModal')
                                    if (json.message)
                                        $('button:submit[form="resendCodeForm"]').setCooldown(60);
                                }
                                $form.find('button:submit').prop('disabled', false)
                            })
                        });
                });
            })
        });
    </script>
@endsection
