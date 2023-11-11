@extends('layouts.app')

@section('title', $category->title_meta)
@section('description', $category->description_meta ?? '')
@section('keywords', $category->keywords_meta ?? '')
@section('og:title', $category->og_title_meta ?? '')
@section('og:description', $category->og_description_meta ?? '')
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
    <div class="alert alert-primary hidden alert-favadd" role="alert" id="fav_alert">
        Товар добавлен в избранное
    </div>
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
                    <div class="title-h1">{{$category->name}}</div>
                    <div class="category-page__container">
                        <aside class="category-page__aside">
                            <div class="filters" id="filters">
                                @include('categories.parts.filter', ['is_not_brands' => true])
                            </div>

                            <div class="category-page__image"><img src="" alt=""></div>
                        </aside>
                        <main class="category-page__main">
                            <ul class="category-page__subcategories">
                                @foreach($category->tags->where('add_to_top', true)->sortBy('position') as $tag)
                                    <li>
                                        <a href="{{$tag->link}}" class="category-page__subcategory">
                                            <span class="category-page__subcategory-image"><img src="{{$tag->getImageSrcAttribute()}}" alt=""></span>
                                            <span class="category-page__subcategory-title">{{$tag->name}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div id="catalog">
                                <div class="category-page__events">
                                    @foreach($category->posts as $post)
                                        <div class="category-page__event catevent">
                                            <div class="catevent__image"><img src="{{asset('/images/uploads/category_posts/'.$post->image_path)}}" alt=""></div>
                                            <div class="catevent__title">{{$post->title}}</div>
                                            <div class="catevent__subtitle">{!! $post->content !!}</div>
                                        </div>
                                    @endforeach
                                </div>
                                {!! $products_list !!}
                            </div>

{{--                            <div class="category-page__pagination pagination">--}}
{{--                                <button class="pagination__more">Показать  еще <span>12 товаров</span> <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use></svg></button>--}}
{{--                                <ul class="pagination__list">--}}
{{--                                    <li class="pagination__item pagination__item--first"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use></svg></a></li>--}}
{{--                                    <li class="pagination__item pagination__item--prev"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use></svg></a></li>--}}
{{--                                    <li class="pagination__item pagination__item--active"><span>1</span></li>--}}
{{--                                    <li class="pagination__item"><a href="">2</a></li>--}}
{{--                                    <li class="pagination__item"><a href="">3</a></li>--}}
{{--                                    <li class="pagination__item pagination__item--dots">...</li>--}}
{{--                                    <li class="pagination__item"><a href="">36</a></li>--}}
{{--                                    <li class="pagination__item pagination__item--next"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use></svg></a></li>--}}
{{--                                    <li class="pagination__item pagination__item--last"><a href=""><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use></svg></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $has_bottom_title = (isset($category->bottom_title) && $category->bottom_title !== ''  && $category->bottom_title !== '<p><br></p>');
        $has_bottom_text = (isset($category->bottom_text) && $category->bottom_text !== ''  && $category->bottom_text !== '<p><br></p>');
        $has_hidden_bottom_text = (isset($category->hidden_bottom_text) && $category->hidden_bottom_text !== '' && $category->hidden_bottom_text !== '<p><br></p>');
        $bottom_tags = $category->tags->where('add_to_top', false);
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
    <div class="sortmobile">
        <div class="sortmobile__close"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg></div>
        <div class="sortmobile__title">Сортировать</div>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">По убыванию цены</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">По возрастанию цены</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">По популярности</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort" />
            <div class="radio__text">По новизне</div>
        </label>
    </div>
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
        $(document).ready(function () {
            // let tagHidden = document.querySelectorAll('.seoblock__tag.is-hidden');
            //
            // $(".seoblock__moretags").click(function() {
            //     $(this).text(function(i, text){
            //         return text === "Свернуть" ? "Развернуть" : "Свернуть";
            //     })
            //     for (let i = 0; i < tagHidden.length; i++) {
            //         tagHidden[i].classList.toggle("is-hidden");
            //     }
            // });
            $(document).on('click', '.pagination__more', function () {
                let is_disabled = $('.pagination__item--next').attr('aria-disabled')
                if(is_disabled === 'false') {
                    let url = this.dataset.url
                    $.ajax({
                        url: url,
                        data: {
                            load_more: true
                        },
                        success: function (response) {
                            $('#catalog div.category-page__products').append(response.products)
                            $('#catalog div.category-page__pagination').remove()
                            $('#catalog').append(response.pagination)
                            let currentlyShowedCount = parseInt($('#currentlyShowedCount').text());
                            $('#currentlyShowedCount').text(currentlyShowedCount + response.new_count)
                        },
                        error: function (response) {
                            console.log(response)
                        }
                    })
                }
            })

            $(document).on('click', '.pagination__item', function(e) {
                e.preventDefault();
                let url = $(this).find('a').attr('href');

                if (url !== '#') {
                    $.ajax({
                        url: url,
                        data: {
                            change_page: true
                        },
                        beforeSend: function () {
                            $('#catalog').addClass('loading')
                        },
                        success: function (response) {
                            $('#catalog').html(response.html)
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                        },
                        error: function (response) {
                            console.log(response)
                        },
                        complete: function () {
                            $('#catalog').removeClass('loading')
                        }
                    })
                }

                return false
            })

            $(document).on('change', '#select_sort_preview', function(e) {
                $('#filterForm input[name="sort"]').val(this.value)
                $('#filterForm').trigger('change')
            })

            $(document).on('slidechange', '#slider-range', function(e) {
                $('#filterForm').trigger('change')
            })
            $(document).on('change', '#amount', function(e) {
                $('#filterForm').trigger('change')
                $('#slider-range').slider( "values", 0, this.value);
            })
            $(document).on('change', '#amount2', function(e) {
                $('#filterForm').trigger('change')
                $('#slider-range').slider( "values", 1, this.value);
            })

            $(document).on('change', '#filterForm', function(e) {
                let data = $(this).serializeArray();
                data.push({
                    name: "load", value: true
                });

                const uri_data = new FormData(this);
                const queryString = new URLSearchParams(uri_data).toString();

                let uri = location.pathname + '?' + queryString

                $.ajax({
                    type: 'GET',
                    data: data,
                    beforeSend: function () {
                        $('#catalog').addClass('loading')
                    },
                    success: function (response) {
                        $('#catalog').html(response.html)
                        $('#filterPropertyCounts').val(JSON.stringify(response.filterCounts))
                        updateFilter()
                    },
                    complete: function () {
                        $('#catalog').removeClass('loading')
                        history.replaceState(null, null, uri)
                    }
                })
            })

            $(document).on('submit', '#filterForm', function(e) {
                e.preventDefault()
                $(this).trigger('change')
                return false
            })


            updateFilter()
        })


        function updateFilter() {
            let counts = JSON.parse($('#filterPropertyCounts').val());

            for (let property_id in counts) {
                let $property = $(`.filters__item[data-property="${property_id}"]:not(:has(input:checked))`);
                $property.find('label').each(function (i, property_value) {
                    let property_value_id = $(property_value).find('input').val()
                    console.log(property_id, property_value_id, counts[property_id][property_value_id])
                    if (counts[property_id][property_value_id] > 0) {
                        $(property_value).show()
                    } else {
                        $(property_value).hide()
                    }
                })
                let maxCount = Math.max(...Object.values(counts[property_id]))
                if (maxCount < 1) {
                    $property.hide()
                } else {
                    $property.show()
                }

                if ($property.find('label').filter(function() {
                    return $(this).css('display') !== 'none';
                }).length > 3) {
                    $property.find('button.filter__all').show()
                } else {
                    $property.find('button.filter__all').hide()
                }
            }
        }
    </script>
@endsection
