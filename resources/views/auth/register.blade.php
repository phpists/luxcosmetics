@extends('layouts.app')

@section('title', $metaTitle = getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::REGISTER))
@section('description', $metaDescription = getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::REGISTER))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)

@section('content')
    <style>
    </style>
    <section class="signin-page reg-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">Регистрация</div>
                    <p><b>Создайте учетную запись, чтобы пользоваться эксклюзивными преимуществами</b></p>
                    <p>Включая отслеживание заказов и ранний доступ к нашим мероприятиям и специальным предложениям
                    </p>
                    <form id="registerForm" method="POST" action="{{ route('register.store') }}" class="form form--box  typography">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color: red">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form__row">
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Имя  *</legend>
                                    <input name="name" required type="text" class="form__input" >
                                </div>
                            </div>
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Фамилия  *</legend>
                                    <input name="surname" required type="text" class="form__input">
                                </div>
                            </div>
                        </div>
                        <div class="form__row">
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Телефон *</legend>
                                    <input type="tel" required name="phone" id="phone_inp" class="form__input phone_inp">
                                </div>
                            </div>
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Электронная почта *</legend>
                                    <input type="email" required name="email" class="form__input">
                                </div>
                            </div>
                        </div>
                        <div class="form__fieldset">
                            <legend class="form__label">Дата рождения</legend>
                            <div class="form__row">
                                <div class="form__col form__col--33"><input type="number" max="31" min="1" name="day" class="form__input" value="10">
                                </div>
                                <div class="form__col form__col--33">
                                    <select class="form__input" name="month" style="background: white">
                                        <option value="1">Январь</option>
                                        <option value="2">Февраль</option>
                                        <option value="3">Март</option>
                                        <option value="4">Апрель</option>
                                        <option value="5">Май</option>
                                        <option value="6">Июнь</option>
                                        <option value="7">Июль</option>
                                        <option value="8">Август</option>
                                        <option value="9">Сентябрь</option>
                                        <option value="10">Октябрь</option>
                                        <option value="11">Ноябрь</option>
                                        <option value="12">Декабрь</option>
                                    </select>
                                </div>
                                <div class="form__col form__col--33">
                                    <input type="number" name="year" class="form__input" min="1900" value='{{date("Y")}}' max="{{date("Y")}}">
                                </div>
                            </div>
                        </div>
                        <div class="form__fieldset">
                            <label class="checkbox">
                                <input type="checkbox" name="newsletter" />
                                <div class="checkbox__text">Подпишитесь на рассылку новостей<br> <small>Установив этот флажок, вы соглашаетесь получать сообщения о запуске новых продуктов, эксклюзивных событиях в магазине и сезонных рекламных акциях.</small></div>
                            </label>
                        </div>
                        <div class="form__fieldset">
                            <label class="checkbox">
                                <input type="checkbox" name="agreement" value="1" required/>
                                <div class="checkbox__text">Я прочитал <a href="/pages/policy">Условия и положения</a> , а также <a href="/pages/policy">Политику конфиденциальности</a> и согласен с ними*</div>
                            </label>
                        </div>


                        <button id="reg_btn" class="btn btn--accent">Зарегистрироваться</button>
                    </form>

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

            $(document).on('submit', '#registerForm', function (e) {
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

            $(document).on('submit', '#otpForm', function (e) {
                e.preventDefault();
                const $form = $(this);
                submitLiveForm($form)
            })
        });
    </script>
@endsection
