@extends('layouts.app')

@section('title', $seoTemplate->title ?? 'Каталог')
@section('description', $seoTemplate->description)
@section('keywords', '')
@section('og:title', $seoTemplate->title ?? 'Каталог')
@section('og:description', $seoTemplate->description)
@section('og:url', request()->url())


@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="{{ route('home') }}">Главная</a></li>
                        <li class="crumbs__item">Каталог</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="catalog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">Каталог</div>
                    @foreach($catalogItems as $catalogItem)
                        <div class="catalog-page__item catitem">
                            <div class="catitem__image">
                                <img src="{{ $catalogItem->img_src }}" alt="">
                            </div>
                            <div class="catitem__content">
                                <div class="catitem__links">
                                    @foreach($catalogItem->links as $link)
                                        <a href="{{ $link['link'] }}" class="catitem__link">{{ $link['title'] }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
@endsection
