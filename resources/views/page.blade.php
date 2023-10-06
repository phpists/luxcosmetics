@extends('layouts.app')

@section('title', $page->title)

@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="">Главная</a></li>
                        <li class="crumbs__item"><a href="/news">Новости</a></li>
                        <li class="crumbs__item">Категория</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="title-h1">{{ $page->title }}</h1>
                    <div class="content-page__preview">
                        <img src="images/dist/tmp.jpg" alt="">
                    </div>
                    <div class="typography">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
