@extends('layouts.app')
@section('title', $item->title)
@section('description', $item->description_meta ?? '')
@section('keywords', $item->keywords_meta ?? '')
@section('og:title', $item->og_title_meta ?? '')
@section('og:description', $item->og_description_meta ?? '')
@section('og:url', request()->url())
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
                    <h1 class="title-h1">{{ $item->title }}</h1>
                    <div class="content-page__preview">
                        <img src="{{$item->mainImage()}}" alt="">
                    </div>
                    <div class="typography">
                        {!! $item->text !!}

                        @if($item->slider_type === \App\Models\NewsItem::HORIZONTAL_SLIDER)
                            <div class="slider popup-gallery">
                                @foreach($item->images as $image)
                                    <div class="slider__item">
                                        <a href="{{$image->getImageSrcAttribute()}}">
                                            <img src="{{$image->getImageSrcAttribute()}}" alt="">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="slider-vert popup-gallery">
                                @foreach($item->images as $image)
                                    <div class="slider__item">
                                        <a href="{{$image->getImageSrcAttribute()}}">
                                            <img src="{{$image->getImageSrcAttribute()}}" alt="">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
