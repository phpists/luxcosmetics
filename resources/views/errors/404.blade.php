@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="color: red">404! Страница не найдена</h1>
        <h2>{{ $exception->getMessage() }}</h2>
    </div>
@endsection
