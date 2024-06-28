@extends('layouts.app')

@section('title', getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::REGISTER))
@section('description', getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::REGISTER))

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
                    <form method="POST" action="{{ route('register') }}" class="form form--box  typography">
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
                        <div class="form__row">
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Пароль *</legend>
                                    <input type="password" name="password" id="password_inp" pattern=".{8,}" title="Пароль должен содержать минимум 8 символов" class="form__input" >
                                </div>
                            </div>
                            <div class="form__col form__col--50">
                                <div class="form__fieldset">
                                    <legend class="form__label">Подтвердите пароль *</legend>
                                    <input type="password" required name="password_confirmation" pattern=".{8,}" title="Пароль должен содержать минимум 8 символов" class="form__input" placeholder="Введите ваш пароль">
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
{{--                        <div class="form__fieldset">--}}
{{--                            <legend class="form__label">Выберите предпочтительный способ связи--}}
{{--                            </legend>--}}
{{--                            @foreach(\App\Models\User::getConnectionOptions() as $option)--}}
{{--                                <label class="checkbox">--}}
{{--                                    <input type="radio" value="{{$option}}" name="connection_type" />--}}
{{--                                    <div class="checkbox__text">{{\App\Services\SiteService::getConnectionOption($option)}}</div>--}}
{{--                                </label>--}}
{{--                            @endforeach--}}

{{--                            <label class="checkbox">--}}
{{--                                <input type="checkbox" name="communications[]" />--}}
{{--                                <div class="checkbox__text">Электронная почта</div>--}}
{{--                            </label>--}}
{{--                            <label class="checkbox">--}}
{{--                                <input type="checkbox" name="communications[]" />--}}
{{--                                <div class="checkbox__text">SMS</div>--}}
{{--                            </label>--}}
{{--                            <label class="checkbox">--}}
{{--                                <input type="checkbox" name="communications[]" />--}}
{{--                                <div class="checkbox__text">Телефон</div>--}}
{{--                            </label>--}}
{{--                            <label class="checkbox">--}}
{{--                                <input type="checkbox" name="communications[]" />--}}
{{--                                <div class="checkbox__text">WhatsApp</div>--}}
{{--                            </label>--}}
{{--                        </div>--}}
                        <div class="form__fieldset">
                            <label class="checkbox">
                                <input type="checkbox" name="newsletter" />
                                <div class="checkbox__text">Подпишитесь на рассылку новостей<br> <small>Установив этот флажок, вы соглашаетесь получать сообщения о запуске новых продуктов, эксклюзивных событиях в магазине и сезонных рекламных акциях.</small></div>
                            </label>
                        </div>
                        <div class="form__fieldset">
                            <label class="checkbox">
                                <input type="checkbox" name="agreement" required/>
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
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/inputmask/inputmask.js') }}"></script>
        <script src="{{ asset('js/inputmask/jquery.inputmask.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            Inputmask("+7 (999) 999-99-99").mask('#phone_inp');
        });
    </script>
@endsection
