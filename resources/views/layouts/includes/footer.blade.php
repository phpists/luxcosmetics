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
                        <a href="" class="social__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#insta')}}"></use></svg></a>
                        <a href="" class="social__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#vk')}}"></use></svg></a>
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
                            <li><a href="">О компании</a></li>
                            <li><a href="">Сервис</a></li>
                            <li><a href="">Доставка и оплата</a></li>
                            <li><a href="">Возврат</a></li>
                            <li><a href="">Вакансии</a></li>
                            <li><a href="">Связаться с нами</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-4 col-6 colcontacts">
                <div class="footer__contacts">
                    <div class="footer__phone"><a href="">+7 495 152 85 44</a></div>
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
