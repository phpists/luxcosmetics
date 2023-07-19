@extends('layouts.app')
@section('content')
    <ul class="ml-5 my-10">
        @foreach($items as $key=>$item)
            <li><a href="{{\App\Http\Controllers\FrontCardController::link_generate($key)}}">{{$key}}</a></li>
        @endforeach
    </ul>
@endsection
