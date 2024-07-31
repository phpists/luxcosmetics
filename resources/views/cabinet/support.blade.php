@extends('cabinet.layouts.cabinet')

@section('title', 'Обратная связь')

@section('styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <style>
        .filepond--panel-root {
            background-color: #ffffff;
        }
    </style>
@endsection

@section('page_content')
    <main class="cabinet-page__main">
        <div style="margin-bottom: 10px;">
        @include('layouts.includes.messages')
        </div>
        <form method="POST" action="{{route('create-chat')}}" class="form form--box" enctype="multipart/form-data">
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
            <div class="form__fieldset">
                <legend class="form__label">Файлы</legend>
                <input id="filesInput" name="files[]" type="file" multiple/>
            </div>
            <button class="btn btn--accent">Отправить на рассмотрение</button>
        </form>
    </main>
@endsection

@section('scripts')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        const inputElement = document.getElementById('filesInput');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            allowMultiple: true,
            storeAsFile: true,
            labelIdle: `Перетащите файлы или <span class="filepond--label-action">Обзор</span>`,
        });
    </script>
@endsection
