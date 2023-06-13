<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header__container">
                    <div class="header__logo"><a href="{{route('home')}}"><img src="{{asset('images/dist/logo.svg')}}" alt=""></a></div>
                    <form action="" class="header__search search">
                        <input type="text" class="search__input" placeholder="Поиск по каталогу">
                        <button class="search__btn"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#search')}}"></use></svg></button>
                    </form>
                    <div class="header__contacts">
                        <div class="header__social social">
                            <a href="" class="social__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#insta')}}"></use></svg></a>
                            <a href="" class="social__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#vk')}}"></use></svg></a>
                        </div>
                        <div class="header__phone"><a href="">+7 495 152 85 44</a></div>
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
                            <a href="{{route('favourites')}}" class="header__link header__link--fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg> <span class="header__linkcount">5</span></a>
                            <a href="{{route('cart')}}" class="header__link header__link--cart"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg> <span class="header__linkcount">2</span></a>
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
                    @php
                      $menu_categories = \App\Models\Category::query()->with('subcategories')->whereNull('category_id')->where('status', 1)->get();
                    @endphp
                    @foreach($menu_categories as $menu_category)
                        <li><a href="/categories/{{$menu_category->alias}}">{{$menu_category->name}} <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a>
                            <div class="submenu">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="submenu__wrapper">
                                                <ul class="submenu__menu">
                                                    @foreach($menu_category->subcategories as $subcategory)
                                                        <li><a href="/categories/{{$subcategory->alias}}">{{$subcategory->name}}</a>
                                                            <ul>
                                                                @foreach($subcategory->categories as $inner_subcategory)
                                                                    <li><a href="/categories/{{$inner_subcategory->alias}}">{{$inner_subcategory->name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
{{--                    <li><a href="">Ароматы <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Макияж <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Уход за кожей <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Уход за телом <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
{{--                    <li><a href="">Уход за волосами <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>--}}
                    <li><a href="">Подарки <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>
                    <li><a href="">Эксклюзивно онлайн <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>
                    <li><a href="">Акции <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
