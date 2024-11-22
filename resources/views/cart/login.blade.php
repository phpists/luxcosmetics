@extends('layouts.app')

@section('title', $metaTitle = getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::CART))
@section('description', $metaDescription = getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::CART))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)

@section('content')
    <section class="cart-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-page__steps">
                        <div class="cart-page__step is-active">1. Авторизация</div>
                        <div class="cart-page__step">2. Доставка</div>
                        <div class="cart-page__step">3. Оплата</div>
                    </div>
                    <div class="cart-page__auth cart-auth" style="display: block; width: 100%">
                        <form id="cartLoginForm" method="POST" action="{{ route('cart.login.store') }}"
                              class="form form--box typography">
                            <div class="form__row">
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Имя *</legend>
                                        <input name="name" required type="text" class="form__input">
                                    </div>
                                </div>
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Фамилия *</legend>
                                        <input name="surname" required type="text" class="form__input">
                                    </div>
                                </div>
                            </div>
                            <div class="form__row">
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Телефон *</legend>
                                        <input type="tel" required name="phone" id="phone_inp"
                                               class="form__input phone_inp">
                                    </div>
                                </div>
                                <div class="form__col form__col--50">
                                    <div class="form__fieldset">
                                        <legend class="form__label">Электронная почта *</legend>
                                        <input type="email" required name="email" class="form__input">
                                    </div>
                                </div>
                            </div>

                            <div style="display: flex;justify-content: center">
                                <button type="submit" class="btn btn--accent">Продолжить</button>
                            </div>
                        </form>
                    </div>
                    <div class="cart-page__contacts">
                        <div class="cart-page__paymethods">
                            <img src="{{asset('images/dist/ico-visa.png')}}" alt="">
                            <img src="{{asset('images/dist/ico-mir.png')}}" alt="">
                            <img src="{{asset('images/dist/ico-youmoney.png')}}" alt="">
                        </div>
                        {!! \App\Services\SiteConfigService::getParamValue('cart_login_support_text') !!}
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
    <script>
        $(document).ready(function () {
            Inputmask("+7 (999) 999-99-99").mask('.phone_inp');

            $(document).on('submit', '#cartLoginForm', function (e) {
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
