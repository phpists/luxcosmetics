@extends('layouts.app')

@section('title', $page->title)
@section('content')
<div class="container my-5">
    <h1>{{$page->title}}</h1>
    {!! $page->content !!}
</div>

@endsection
