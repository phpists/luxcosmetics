@extends('layouts.app')

@section('title', $metaTitle = $brand->name ?? getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::BRAND, $brand))
@section('description', $metaDescription = $brand->description_meta ?? getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::BRAND, $brand))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)
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
                        <li class="crumbs__item"><a href="{{ route('brands') }}">Бренды</a></li>
                        <li class="crumbs__item">{{$brand->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="category-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title-h1">{{ $brand->getSeo('h1') ?? $brand->name }}</h1>
                    <livewire:catalog :model-class="\App\Models\Brand::class" :brand="$brand" :category="$category"/>
                </div>
            </div>
        </div>
    </section>
    <section class="seoblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="seoblock__wrapper">
                        @php($bottomTitle = $brand->getSeo('bottom_title'))
                        @if(!empty($bottomTitle))
                        <h1 class="seoblock__title">{{ $bottomTitle }}</h1>
                        @endif
                        @php($bottomText = $brand->getSeo('bottom_text'))
                            @if(!empty($bottomText))
                        <div class="seoblock__content">{!! $bottomText !!}</div>
                            @endif
                        @php($hiddenBottomText = $brand->getSeo('hidden_bottom_text'))
                            @if(!empty($hiddenBottomText))
                            <div class="seoblock__content is-hidden" id="seohidden">{!! $hiddenBottomText !!}</div>
                        <div class="seoblock__morecontent">Показать еще</div>
                            @endif

                        @if($brand->bottomTags->isNotEmpty())
                        <div class="seoblock__tags">
                            @foreach($brand->bottomTags as $bottomTag)
                            <a href="{{ $bottomTag->link }}" class="seoblock__tag">{{ $bottomTag->name }}</a>
                            @endforeach
                        </div>
                        <div class="seoblock__moretags">Развернуть</div>
                         @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
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
