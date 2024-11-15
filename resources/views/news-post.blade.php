@extends('layouts.app')
@section('title', $metaTitle = $item->meta_title ?? getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::NEWS, $item))
@section('description', $metaDescription = $item->description_meta ?? getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::NEWS, $item))
@section('keywords', $item->keywords_meta ?? '')
@section('og:title', $item->og_title_meta ?? $metaTitle)
@section('og:description', $item->og_description_meta ?? $metaDescription)
@section('og:url', request()->url())
@section('content')
    <style>
        .slick-slide img {
            object-fit: cover;
        }
        .slider .slick-slide img {
            aspect-ratio: 628/407;
        }
        .slider-vert img {
            aspect-ratio: 2133/3200;
        }

        .content-page__preview img{
            max-width: 100%;
            width: 100%;
            height: 400px;
            object-fit: cover;

        }

        @media screen and (max-width: 768px) {
            .content-page__preview img{
                height: 350px;
            }
        }

        @media screen and (max-width: 768px) {
            .content-page__preview img{
                height: 280px;
            }
        }
    </style>
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="/">Главная</a></li>
                        <li class="crumbs__item"><a href="/news">Новости</a></li>
                        <li class="crumbs__item"><a href="{{route('news.post', $item->link)}}">{{$item->title}}</a></li>
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
                    <div class="content-page__preview" style="margin-bottom: 50px">
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout()
        })
    </script>
@endsection
