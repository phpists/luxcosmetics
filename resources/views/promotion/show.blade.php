@extends('layouts.app')

@section('title', $metaTitle = $promotion->seo?->getMeta('title') ?? getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::PROMOTION_ARTICLE, $promotion))
@section('description', $metaDescription = $promotion->seo?->getMeta('description') ?? getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::PROMOTION_ARTICLE, $promotion))
@section('og:title', $promotion->seo?->getOG('title') ?? $metaTitle)
@section('og:description', $promotion->seo?->getOG('description') ?? $metaTitle)
@section('og:url', request()->url())

@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="/">Главная</a></li>
                        <li class="crumbs__item"><a href="{{ route('promotions.index') }}">Акции</a></li>
                        <li class="crumbs__item">{{ $promotion->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="article-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">{{ $promotion->title }}</div>
                </div>
            </div>
        </div>
        @if($promotion->bg_img)
            <div class="article-page__preview" style="text-align: center;">
                <img src="{{ $promotion->bg_img_src }}">
            </div>
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="article-page__content typography">
                        {!! $promotion->content !!}

                        @if($promotion->btn_title && $promotion->btn_link)
                            <div class="article-page__btn">
                                <a href="{{ $promotion->btn_link }}" class="btn btn--accent">{{ $promotion->btn_title }}
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('images/dist/sprite.svg#circle-arrow') }}"></use>
                                    </svg>
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($promotion->products?->isNotEmpty())
        <section class="productsblock productsblock--grayblock">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="title-h2">Что будет в боксе</h2>
                        <div class="products-slider">
                            @foreach($promotion->products as $product)
                                <div class="products-slider__item">
                                    @include('products._card')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
