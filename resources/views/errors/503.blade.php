@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="color: red">503 <br>Сервис на данный момент не доступен. Попробуйте снова позже.</h1>
        <h2>{{ $exception->getMessage() }}</h2>
    </div>
@endsection
