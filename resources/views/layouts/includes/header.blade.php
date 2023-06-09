<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header__container">
                    <div class="header__logo"><a href="{{route('home')}}"><img src="{{asset('images/dist/logo.svg')}}" alt=""></a></div>
                    <form action="{{route('show_search')}}" class="header__search search">
                        <div id="header-container" style="position: relative">
                            <input type="text" minlength="2" name="search" id="header_search" class="search__input" placeholder="Поиск по каталогу">
                            <div id="search_results" style="position: absolute; background: whitesmoke; z-index: 2; width: 100%"></div>
                        </div>
                        <button class="search__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#search')}}"></use></svg></button>
                    </form>
                    <div class="header__contacts">
                        <div class="header__social social">
                            @foreach (\App\Models\SocialMedia::query()->select('social_medias.*')->get() as $item)
                                <div style="margin: 5px; display: inline-block;"><a href="{{ $item->link }}"><img src="{{asset('images/uploads/social/' . $item->icon)}}" alt=""></div>
                            @endforeach
                            </div>
{{--                        @foreach (\App\Models\SocialMedia::query()->select('social_medias.phone')->get() as $item)--}}
{{--                            <div class="header__phone"><a href="">{{ $item->phone }}</a></div>--}}
{{--                        @endforeach--}}
                        <div class="header__links">
                            <button class="header__link header__link--search">
                                <div class="if-close"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#search')}}"></use></svg></div>
                                <div class="if-open"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use></svg></div>
                            </button>

                            <ul data-block-content="user">
                                <li>
                                    <a href="{{route('profile')}}" class="header__link header__link--auth"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#user')}}"></use></svg></a>
                                </li>
                            </ul>
                            <a href="{{route('favourites')}}" class="header__link header__link--fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg> <span class="header__linkcount @if(sizeof(\App\Services\FavoriteProductsService::getAllIds()) === 0) hidden @endif" id="header__linkcount">{{sizeof(\App\Services\FavoriteProductsService::getAllIds())}}</span></a>
                            <a href="{{route('cart')}}" class="header__link header__link--cart"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg> <span class="header__linkcount" id="cartTotalCount">{{ $cartService->getTotalCount() }}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 static">
                <a href="#menu"   class="navigation__btncat">
                    <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#menu')}}"></use></svg>
                    Каталог товаров
                </a>
                <ul class="navigation__menu">
                    @foreach($menu_items->whereNull('parent_id')->where('type', \App\Models\Menu::TOP_MENU) as $menu_item)
                        <li><a href="{{$menu_item->link}}">{{$menu_item->title}} @if(sizeof($menu_item->getChildren($menu_items)) > 0)
                            <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a>
                            <div class="submenu">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="submenu__wrapper">
                                                <ul class="submenu__menu">
                                                    @foreach($menu_item->getChildren($menu_items) as $submenu)
                                                        <li><a href="{{$submenu->link}}">{{$submenu->title}}</a>
                                                            @include('layouts.parts.submenu', ['menu_item' => $submenu, 'items' => $menu_items])
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </li>
                    @endforeach
{{--                    <li><a href="">Ароматы <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Макияж <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Уход за кожей <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Уход за телом <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Уход за волосами <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Подарки <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Эксклюзивно онлайн <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="{{route('sales')}}">Акции <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</section>
