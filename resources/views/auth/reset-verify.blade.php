@extends('layouts.app')

@section('content')
    <section class="signin-page mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="my-3" style="font-size: 24px">Вам на почту {{$email}} отправлен новый пароль</p>
                    <p>Перейти на <a href="{{route('login')}}">страницу авторизации</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
