@extends('cabinet.layouts.cabinet')

@section('title', 'Изменить пароль')

@section('page_content')
    <main class="cabinet-page__main">
        @include('layouts.includes.messages')
        <form action="{{route('profile.reset-password')}}" method="POST" class="form form--box">
            @csrf
            @isset($errors)
                <div class="alert alert-danger mb-2">
                    <ul>
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endisset
            <div class="form__fieldset">
                <legend class="form__label">Текущий пароль *</legend>
                <input type="password" pattern=".{8,}" title="Пароль должен содержать минимум 8 символов" name="original_password" required class="form__input">
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Новый пароль *</legend>
                <input type="password" pattern=".{8,}" title="Пароль должен содержать минимум 8 символов" name="new_password" required class="form__input">
            </div>
            <div class="form__fieldset">
                <legend class="form__label">Повторить новый пароль</legend>
                <input type="password" pattern=".{8,}" title="Пароль должен содержать минимум 8 символов" class="form__input" name="new_confirm" required>
            </div>
            <button class="btn btn--accent">Сохранить изменения</button>
        </form>
    </main>

@endsection
