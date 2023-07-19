<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-8 col-sm-8 col-6 collogo">
                <div class="footer__logo">
                    <img src="{{asset('images/dist/logo.svg')}}" alt="">
                </div>
                <div class="footer__social social">
                    <div class="social__title">Мы в социальных сетях</div>
                    <div class="social__items">
                        @foreach (\App\Models\SocialMedia::query()->select('social_medias.*')->get() as $item)
                                <div style="margin: 5px; display: inline-block;"><a href="{{ $item->link }}"><img src="{{asset('images/uploads/social/' . $item->icon)}}" alt=""></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-7  colmenu">
                <div class="footer__menublock">
                    @foreach($menu_items->whereNull('parent_id')->where('type', \App\Models\Menu::FOOTER_MENU) as $menu_item)
                        <div class="footer__menu">
                            <h4 class="footer__menutitle">{{$menu_item->title}} <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></h4>
                            <ul>
                                @foreach($menu_item->getChildren($menu_items) as $sub_item)
                                    <li><a href="{{$sub_item->link}}">{{$sub_item->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    <div class="footer__menu">
                        <h4 class="footer__menutitle">Помощь <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></h4>
                        <ul>
                            @foreach($static_pages as $sub_item)
                                <li><a href="/pages/{{$sub_item->link}}">{{$sub_item->title}}</a></li>
                            @endforeach
{{--                            <li><a href="">О компании</a></li>--}}
{{--                            <li><a href="">Сервис</a></li>--}}
{{--                            <li><a href="">Доставка и оплата</a></li>--}}
{{--                            <li><a href="">Возврат</a></li>--}}
{{--                            <li><a href="">Вакансии</a></li>--}}
{{--                            <li><a href="">Связаться с нами</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-4 col-6 colcontacts">
                <div class="footer__contacts">
{{--                    @foreach (\App\Models\SocialMedia::query()->select('social_medias.phone')->get() as $item)--}}
{{--                        <div class="footer__phone">{{ $item->phone }}</a></div>--}}
{{--                    @endforeach--}}
                        <a href="#modal-form" class="btn btn--accent popup-with-form">Заказать звонок <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#circle-arrow')}}"></use></svg></a>
                </div>
            </div>

            <div class="col-lg-12 colcopyright">
                <div class="footer__logomobile">
                    <img src="{{asset('images/dist/logo.svg')}}" alt="">
                </div>
                <div class="footer__btm">
                    <div class="footer__copyright">Luxe cosmetics © 2023 Все права защищены</div>
                    <div class="footer__policy"><a href="">Политика конфиденциальности</a></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="mobilenav">
    <a href="#menu" class="header__link header__link--cat"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#menu')}}"></use></svg></a>
    <a href="{{route('profile')}}" class="header__link header__link--auth"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#user')}}"></use></svg></a>
    <a href="{{route('favourites')}}" class="header__link header__link--fav"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#heart')}}"></use></svg> <span id="mobile__linkcount" class="header__linkcount @if(sizeof(\App\Services\FavoriteProductsService::getAllIds()) === 0) hidden @endif">{{sizeof(\App\Services\FavoriteProductsService::getAllIds())}}</span></a>
    <a href="{{route('cart')}}" class="header__link header__link--cart"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#cart')}}"></use></svg> <span class="header__linkcount">{{ $cartService->getTotalCount() }}</span></a>
</div>
