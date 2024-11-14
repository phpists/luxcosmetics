@extends('cabinet.layouts.cabinet')

@section('title', 'Изменить свои данные')

@section('page_content')
    <main class="cabinet-page__main">
        <form action="{{route('profile.update')}}" class="form form--box" method="POST">
            @csrf
            @method('put')
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Ваше имя *</legend>
                        <input type="text" name="name" value="{{$user->name}}" class="form__input" required>
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Фамилия *</legend>
                        <input type="text" name="surname" value="{{$user->surname}}" class="form__input" required>
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Номер телефона *</legend>
                        <input type="text" readonly value="{{$user->phone}}" name="phone" id="phone_inp"
                               class="form__input">
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Электронная почта *</legend>
                        <input type="email" name="email" value="{{ $user->email }}" class="form__input">
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Дата рождения</legend>
                        <div class="form__row">
                            <div class="form__col form__col--33"><input type="number" max="31" min="1" name="day"
                                                                        class="form__input"
                                                                        value="{{ $user->birthday?->day }}">
                            </div>
                            <div class="form__col form__col--33">
                                <select class="form__input" name="month" style="background: white">
                                    @foreach(collect(range(1, 12)) as $mI)
                                        <option
                                            value="{{ $mI }}" @selected($mI == $user->birthday?->month)>{{ now()->setMonth($mI)->locale('ru-RU')->monthName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form__col form__col--33">
                                <input type="number" name="year" class="form__input" min="1900"
                                       value='{{ $user->birthday?->year  }}' max="{{ date("Y") }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form__fieldset">
                <label class="checkbox checkbox--mailer">
                    <input name="is_subscribed" @if($user->is_subscribed) checked @endif type="checkbox"/>
                    <div class="checkbox__text">Подписаться на рассылку</div>
                </label>
                <button class="btn btn--accent">Сохранить изменения</button>
            </div>
        </form>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/inputmask/inputmask.js') }}"></script>
    <script src="{{ asset('js/inputmask/jquery.inputmask.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            Inputmask("+7 (999) 999-99-99").mask('#phone_inp');
        });
    </script>
@endsection
