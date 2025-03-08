@extends('layouts.app')

@section('title', $metaTitle = $category->title_meta ?? getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::CATEGORY, $category))
@section('description', $metaDescription = $category->description_meta ?? getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::CATEGORY, $category))
@section('keywords', $category->keywords_meta ?? '')
@section('og:title', $category->og_title_meta ?? $metaTitle)
@section('og:description', $category->og_description_meta ?? $metaDescription)
@section('og:url', request()->url())

@section('styles')
    <style>
        .loading:after {
            content: '';
            background: url({{ asset('images/loading.gif') }}) center;
            height: 256px;
            width: 256px;
            display: block;
            position: absolute;
            left: 50%;
            top: 40%;
            z-index: 999;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none; // Yeah, yeah everybody write about it
        }

        input[type='number'],
        input[type="number"]:hover,
        input[type="number"]:focus {
            appearance: none;
            -moz-appearance: textfield;
        }
    </style>
@endsection


@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="{{ route('home') }}">Главная</a></li>
                        @include('categories.parts.parent_category')
                        <li class="crumbs__item">{{ $category->breadcrumb }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="category-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title-h1">{{ $category->h1 ?? $category->name }}</h1>
                    <livewire:catalog :model-class="\App\Models\Category::class" :category="$category"/>
                </div>
            </div>
        </div>
    </section>
    @php
        $has_bottom_title = (isset($category->bottom_title) && $category->bottom_title !== ''  && $category->bottom_title !== '<p><br></p>');
        $has_bottom_text = (isset($category->bottom_text) && $category->bottom_text !== ''  && $category->bottom_text !== '<p><br></p>');
        $has_hidden_bottom_text = (isset($category->hidden_bottom_text) && $category->hidden_bottom_text !== '' && $category->hidden_bottom_text !== '<p><br></p>');
        $bottom_tags = $category->bottomTags;
    @endphp
    @if($has_bottom_title || $has_bottom_text || $has_hidden_bottom_text || (sizeof($bottom_tags) > 0))
    <section class="seoblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="seoblock__wrapper">
                            @if($has_bottom_title)
                                <h1 class="seoblock__title">{{$category->bottom_title}}</h1>
                            @endif
                            @if($has_bottom_text)
                                <div class="seoblock__content">{!! $category->bottom_text !!}</div>
                            @endif
                            @if($has_hidden_bottom_text)
                                <div class="seoblock__content is-hidden" id="seohidden">{!! $category->hidden_bottom_text !!}</div>
                                <div class="seoblock__morecontent">Показать еще</div>
                            @endif
                            @if(sizeof($bottom_tags) > 0)
                                <div class="seoblock__tags">
                                    @foreach($bottom_tags->sortBy('position') as $idx=>$tag)
                                        <a href="{{$tag->link}}" class="seoblock__tag">{{$tag->name}}</a>
                                    @endforeach
                                </div>
                                @if(sizeof($bottom_tags) > 5)
                                    <div class="seoblock__moretags">Развернуть</div>
                                @endif
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection

@section('after_content')
    <div class="filters-overlay"></div>
    <div class="hidden">
        <!-- <form action="" class="form" id="callback">
            <h3>Оставить сообщение</h3>

            <input type="text"  name="Имя" placeholder="Ваше имя"  required="required">
            <input type="text"  name="Телефон" placeholder="Номер телефона" required="required">
            <input type="text"  name="E-mail" placeholder="E-mail" required="required">
            <textarea name="Сообщение" placeholder="Сообщение"></textarea>
            <button class="btn btn-feed">Отправить</button>
        </form> -->
        @include('layouts.includes.purchase_modal')
    </div>
    <div class="done-w">
        <div class="done-window">
            <div class="done-window__icn"></div>
            <div class="done-window__title">Ваша заявка принята</div>
            <div class="done-window__subtitle">Наш менеджер свяжется с Вами в течении 15 минут</div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/favourites.js')}}"></script>
    <script>
        $(function () {
            setTimeout(() => $('.filter__title').off('click'), 500)
            setTimeout(() => $('.filter__all').off('click'), 500)
            setTimeout(() => $("#filters").mCustomScrollbar('destroy'), 500)
        })
    </script>
@endsection
