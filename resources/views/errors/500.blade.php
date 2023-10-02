@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="color: red">500<br>Упс! Что то пошло не так. Напишите нам об ошибке</h1>
        <h2>{{ $exception->getMessage() }}</h2>
    </div>
@endsection
