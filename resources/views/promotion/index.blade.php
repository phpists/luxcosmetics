@extends('layouts.app')

@section('title', $metaTitle = getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::PROMOTIONS))
@section('description', $metaDescription = getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::PROMOTIONS))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)
@section('og:url', request()->url())

@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="/">Главная</a></li>
                        <li class="crumbs__item">Акции</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="category-page articles-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">Акции</div>
                    <div class="articles-page__menu">
                        <li class="is-active"><span>Акции</span></li>
                        <li><a href="{{ route('news.index') }}">Новости</a></li>
                    </div>
                    <div class="category-page__container">
                        <aside class="category-page__aside">
                            <div class="filters" id="filters">
                                <div class="filters__close"><svg class="icon"><use xlink:href="{{ asset('images/dist/sprite.svg#close') }}"></use></svg></div>
                                <div class="filters__hdr">
                                    <div class="filters__title">Фильтр</div>
                                    <button class="filters__btn" onclick="location.href = '{{ route('promotions.index') }}'">Сбросить все</button>
                                </div>
                                <form id="filterForm">
                                    <input type="hidden" name="page">
                                <div class="filters__wrapper">
                                    @if($properties?->isNotEmpty())
                                        @foreach($properties as $title => $values)
                                        <div class="filters__item filter">
                                            <div class="filter__title">{{ $title }} <svg class="icon"><use xlink:href="images/dist/sprite.svg#arrow"></use></svg></div>
                                            <div class="filter__block">
                                                <div class="filter__wrap filter__scroll">
                                                    @foreach($values as $value)
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="filters[{{ $title }}][]" value="{{ $value }}" />
                                                        <div class="checkbox__text">{{ $value }}</div>
                                                    </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                </form>

                            </div>

                        </aside>
                        <main class="category-page__main">
                            <div class="category-page__mobilenav">
                                <button class="category-page__mobilebtn btnfilters"><svg class="icon"><use xlink:href="images/dist/sprite.svg#filters"></use></svg> Показать фильтры</button>
                            </div>

                            <div id="promotionsContainer">
                                @include('promotion._list')
                            </div>

                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function () {
            $(document).on('submit', '#filterForm', function(e) {
                e.preventDefault();

                const data = new FormData(this);
                const queryString = new URLSearchParams(data).toString();

                $('#promotionsContainer').load('?' + queryString)
            })

            $(document).on('change', '#filterForm', function(e) {
                this.requestSubmit()
            })

            $(document).on('click', '.pagination__item a', function (e) {
                e.preventDefault();
                let params = new URL(this.href).searchParams;
                let page = params.get('page');

                $('#filterForm input[name="page"]').val(page).trigger('change')
            })

            $(document).on('click', '.pagination__more', function(e) {
                e.preventDefault();
                let params = new URL(this.dataset.url).searchParams;
                let page = params.get('page');

                const data = new FormData(document.getElementById('filterForm'));
                data.append('page', page)
                data.append('load_more', true)
                const queryString = new URLSearchParams(data).toString();

                $.ajax({
                    url: '?' + queryString,
                    success: function (response) {
                        $('#promotionsItems').append(response.promotions)
                        $('#promotionsPagination').html(response.pagination)
                    }
                })
            })
        })
    </script>
@endsection
