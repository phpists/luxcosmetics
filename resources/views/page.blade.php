@extends('layouts.app')

@section('title', $metaTitle = $page->title ?? getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::STATIC, $page))
@section('description', $metaDescription = $item->description_meta ?? getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::STATIC, $page))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)

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
        <div class="container typography">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title-h1">{{ $page->title }}</h1>
                </div>
                {!! $page->content !!}
            </div>
        </div>
    </section>
@endsection
