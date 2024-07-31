@extends('layouts.app')

@section('title', 'Luxe Cosmetics - интернет-магазин люксовой косметики и парфюмерии')
@section('description', 'Интернет магазин элитной косметики и парфюмерии 💄 | Мировые бренды, широкий ассортимент, акции и бонусные программы | Купить косметику с доставкой по Москве и России ❤️ ')

@section('content')
    <section class="mainaction">
        <div class="container">
            @php
                $item = \App\Services\BannerService::getBanner();
                $positionIds = [];
                foreach ($item as $banner) {
                    $position = $banner->position;
                    if (!isset($positionIds[$position])) {
                        $positionIds[$position] = [];
                    }
                    $positionIds[$position][] = $banner->id;
                }
            @endphp
            <div class="row">
                @if (isset($positionIds['first'][0]) && $selectedItem = $item->find($positionIds['first'][0]))
                <div class="col-lg-12">
                    <div class="mainaction__one">
                        <a href="{{ $selectedItem->link }}">
                            <picture>
                                <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 576px)">
                                <source srcset="{{asset('images/uploads/banner/'. $selectedItem->getSmallImage())}}" media="(max-width: 575px)" >
                                <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                            </picture>
                        </a>
                    </div>
                </div>
                @endif
            </div>

            @if (isset($positionIds['second'][0]) && $selectedItem = $item->find($positionIds['second'][0]))
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="article">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getMediumImage
())}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getSmallImage())}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ strip_tags($selectedItem->text) }}</div>
                        </div>
                        <a href="{{ $selectedItem->link }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['second'][1]) && $selectedItem = $item->find($positionIds['second'][1]))
                <div class="col-lg-6 col-md-6">
                    <div class="article">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getMediumImage())}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getSmallImage())}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ strip_tags($selectedItem->text) }}</div>
                        </div>
                        <a href="{{ $selectedItem->link }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                @if(isset($positionIds['third'][0]) && $selectedItem = $item->find($positionIds['third'][0]))
                <div class="col-lg-4 col-md-4">
                    <div class="article article--threecol">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getMediumImage())}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getSmallImage())}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ strip_tags($selectedItem->text) }}</div>
                        </div>
                        <a href="{{ $selectedItem->link }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['third'][1]) && $selectedItem = $item->find($positionIds['third'][1]))
                <div class="col-lg-4 col-md-4">
                    <div class="article article--threecol">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getMediumImage())}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getSmallImage())}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ strip_tags($selectedItem->text) }}</div>
                        </div>
                        <a href="{{ $selectedItem->link }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['third'][2]) && $selectedItem = $item->find($positionIds['third'][2]))
                <div class="col-lg-4 col-md-4">
                    <div class="article article--threecol">
                        <div class="article__wrap">
                            <div class="article__image">
                                <picture>
                                    <source  srcset="{{asset('images/uploads/banner/' . $selectedItem->image)}}" media="(min-width: 768px)">
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getMediumImage())}}" media="(min-width: 576px) and (max-width: 767px)" >
                                    <source srcset="{{asset('images/uploads/banner/' . $selectedItem->getSmallImage())}}" media="(max-width: 575px)" >
                                    <img src="{{asset('images/uploads/banner/' . $selectedItem->image)}}">
                                </picture>
                            </div>
                            <div class="article__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                            <div class="article__intro">{{ strip_tags($selectedItem->text) }}</div>
                        </div>
                        <a href="{{ $selectedItem->link }}" class="article__more">Подробнее</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @if($show_new_products = \App\Services\SiteConfigService::getParam('показывать_блок_новинки')['value'] ?? false == 1)
    <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Новинки</h2>
                    <div class="products-slider">
                        @foreach($new_products as $product)
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
    @if($show_new_products = \App\Services\SiteConfigService::getParam('показывать_блок_из_видео')['value'] ?? false == 1)
    <section class="videoblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="videoblock__wrapper">
                        <h2 class="videoblock__title">{{$main_block->title ?? ''}}</h2>
                        {!! $main_block->content ?? ''!!}
                    </div>

                </div>
            </div>
        </div>
        @if($main_block)
        <a class="videoblock__video popup-video" style="background-image: url(images/uploads/main_block/{{ $main_block->image_path ?? ''}});"></a>
        <div class="mfp-hide" style="max-width: 1049px; margin: 0 auto" id="video_popup">
            <video width="100%" controls src="{{asset('images/uploads/main_block/'.$main_block->video_path ?? '')}}"></video>
        </div>
        @endif
    </section>
    @endif
    @if($show_new_products = \App\Services\SiteConfigService::getParam('показывать_блок_популярные')['value'] ?? false == 1)
        <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Популярные</h2>
                    <div class="products-slider">
                        @foreach($popular_products as $product)
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
    <section class="maincategory">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="maincategory__grid">
                        @if(isset($positionIds['fourth'][0]) && $selectedItem = $item->find($positionIds['fourth'][0]))
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                                <div class="category__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                                <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                            </div>
                        </div>
                        @endif
                        @if(isset($positionIds['fourth'][1]) && $selectedItem = $item->find($positionIds['fourth'][1]))
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                                <div class="category__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                                <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                            </div>
                        </div>
                        @endif
                        @if(isset($positionIds['fourth'][2]) && $selectedItem = $item->find($positionIds['fourth'][2]))
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                                <div class="category__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                                <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                            </div>
                        </div>
                        @endif
                        @if(isset($positionIds['fourth'][3]) && $selectedItem = $item->find($positionIds['fourth'][3]))
                        <div class="maincategory__item">
                            <div class="category">
                                <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                                <div class="category__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                                <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($show_new_products = \App\Services\SiteConfigService::getParam('показывать_блок_товары_со_скидкой')['value'] ?? false == 1)
        <section class="productsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Товары со скидкой</h2>
                    <div class="products-slider">
                        @foreach($product_discounts  as $product)
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
    <section class="maincategory maincategory--threecol">
        <div class="container">
            <div class="row">
                @if(isset($positionIds['fifth'][0]) && $selectedItem = $item->find($positionIds['fifth'][0]))
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="category">
                        <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                        <div class="category__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                        <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['fifth'][1]) && $selectedItem = $item->find($positionIds['fifth'][1]))
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="category">
                        <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                        <div class="category__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                        <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                    </div>
                </div>
                @endif
                @if(isset($positionIds['fifth'][2]) && $selectedItem = $item->find($positionIds['fifth'][2]))
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="category">
                        <div class="category__image" style="background-image: url({{asset('images/uploads/banner/' . $selectedItem->image)}});"></div>
                        <div class="category__title"><a href="{{ $selectedItem->link }}">{{ $selectedItem->title }}</a></div>
                        <div class="category__subtitle">{{ Str::limit(strip_tags($selectedItem->text), $limit = 120, $end = '...') }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <section class="newsblock">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Новости</h2>
                </div>
                <div class="newsblock__container">
                @foreach (\App\Services\NewsService::getNews(3) as $item)
                    <div class="article article--news">
                        <div class="article__image"><a href="{{ route('news.post', $item->link) }}"><img src="{{ $item->thumbnail_src }}" alt=""></a></div>
                        <div class="article__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg>{{ \Carbon\Carbon::parse($item->published_at)->locale('ru')->isoFormat('D.MMMM.YYYY') }}</div>
                        <div class="article__title"><a href="{{ route('news.post', $item->link) }}">{{ $item->title }}</a></div>
                        <div class="article__intro">{{ Str::limit(strip_tags($item->text), $limit = 90, $end = '...') }}</div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
    @if($show_new_products = \App\Services\SiteConfigService::getParam('показывать_блок_подписаться_на_рассылку')['value'] ?? false == 1)
        <section class="mailing">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form id="subscribeMailForm" action="{{route('subscribe')}}" class="mailing__form" method="POST">
                        @csrf
                        <div class="mailing__left">
                            <h2 class="mailing__title">Подписаться на&nbsp;рассылку</h2>
                            <div class="mailing__subtitle">Узнавайте первыми о новых поступлениях, акциях и мероприятиях в магазине</div>
                        </div>
                        <div class="mailing__right">
                            <input required type="email" class="mailing__input" name="email" placeholder="Введите ваш e-mail">
                            <button type="submit" class="mailing__button g-recaptcha" data-sitekey="{{ config('services.google.captcha.site_key') }}" data-callback='onSubmit' data-action='submit'><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#circle-arrow')}}"></use></svg></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if($show_new_products = \App\Services\SiteConfigService::getParam('показывать_слайдер-блок_бренды')['value'] ?? false == 1)
    <section class="brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-h2">Бренды</h2>
                    <div class="brands-slider">
                        @foreach(\App\Models\Brand::whereHas('products')->get() as $item)
                            <div class="brands-slider__item">
                                <a href="{{ route('brands.show', ['link' => strtolower($item->link)]) }}">
                                    <div class="brand">
                                        <img src="{{ asset('images/uploads/brands/' . $item->image) }}" alt="">
                                    </div>
                                </a>
                            </div>
                        @endforeach
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
        $(document).ready(function () {
            $('a.popup-video').on('click', function () {
                $.magnificPopup.open({
                    items: {
                        src: '#video_popup',
                        type: 'inline'
                    }
                });
            })
        })
        $('button.product__addcart').on('click', function () {
            $.magnificPopup.open({
                items: {
                    src: '#addproduct',
                    type: 'inline'
                }
            });
        })

        function onSubmit(token) {
            document.getElementById("subscribeMailForm").requestSubmit();
        }
    </script>
@endsection



