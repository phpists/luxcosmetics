@extends('cabinet.layouts.cabinet')

@section('title', 'Обратная связь')

@section('page_content')
    <main class="cabinet-page__main">
        <form method="POST" action="{{route('create-chat')}}" class="form form--box">
            @csrf
            <div class="form__fieldset">
                <legend class="form__label">Причина обращения *</legend>
                <select required name="feedbacks_reason_id" id="" class="selectCustom">
                    @foreach($feedback_reasons as $reason)
                        <option value="{{$reason->id}}">{{$reason->reason}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__row">
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Адрес электронной почты *</legend>
                        <input type="email" value="{{$user->email}}" required name="email" class="form__input">
                    </div>
                </div>
                <div class="form__col form__col--50">
                    <div class="form__fieldset">
                        <legend class="form__label">Номер телефона *</legend>
                        <input type="text" value="{{$user->phone}}" required name="phone" class="form__input">
                    </div>
                </div>
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Номер заказа</legend>
                <input type="text" name="order_number" class="form__input">
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Тема обращения</legend>
                <input type="text" name="feedback_theme" class="form__input">
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Текст вашего обращения</legend>
                <textarea name="message" class="form__textarea"></textarea>
            </div>
            <button class="btn btn--accent">Отправить на рассмотрение</button>
        </form>
    </main>
@endsection
