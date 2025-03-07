<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'menu-item-active' : '' }}"
                aria-haspopup="true">
                <a href="{{route('admin.dashboard')}}" class="menu-link">
                    <i class="fas fa-th menu-icon"></i>
                    <span class="menu-text">Главная</span>
                </a>
            </li>

            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::ORDERS_VIEW))
                <li class="menu-item menu-item-submenu {{ (Str::is('admin.orders.*', request()->route()->getName())
    || Str::is('admin.order_statuses.*', request()->route()->getName())) ? 'menu-item-open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="fas fa-shopping-cart menu-icon"></i>
                        <span class="menu-text">Заказы</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" style="" kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ Str::is('admin.orders.*', request()->route()->getName()) ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.orders.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Заказы</span>
                                </a>
                            </li>
                            @if(auth()->user()->isSuperAdmin())
                                <li class="menu-item {{ Str::is('admin.order_statuses.*', request()->route()->getName()) ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.order_statuses.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Статусы</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROMO_CODES_VIEW))
                <li class="menu-item {{ Str::is('admin.promo_codes.*', request()->route()->getName()) ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.promo_codes.index') }}" class="menu-link">
                        <i class="far fa-star menu-icon"></i>
                        <span class="menu-text">Промо коды</span>
                    </a>
                </li>
            @endif

            @if(auth()->user()->isSuperAdmin()
                || auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_VIEW)
                || auth()->user()->can(\App\Services\Admin\PermissionService::CATEGORIES_VIEW)
                || auth()->user()->can(\App\Services\Admin\PermissionService::BRANDS_VIEW)
                || auth()->user()->can(\App\Services\Admin\PermissionService::PROPERTIES_VIEW)
                || auth()->user()->can(\App\Services\Admin\PermissionService::GIFTS_VIEW)
                )
                <li class="menu-item menu-item-submenu
{{ (request()->routeIs('admin.products')
|| request()->routeIs('admin.products.tree')
|| request()->routeIs('admin.categories')
|| request()->routeIs('admin.brands.*')
|| request()->routeIs('admin.properties.index')
|| request()->routeIs('admin.product.edit')
|| request()->routeIs('admin.product.create')
|| request()->routeIs('admin.category.edit')
|| request()->routeIs('admin.category.create')
|| request()->routeIs('admin.properties.edit')
|| request()->routeIs('admin.properties.create')
|| request()->routeIs('admin.main-block.index')
|| request()->routeIs('admin.gifts.index')
|| request()->routeIs('admin.product-prices.*')
|| request()->routeIs('admin.catalog-banners.*')
|| request()->routeIs('admin.catalog-items.*')) ? 'menu-item-open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="fas flaticon2-copy menu-icon"></i>
                        <span class="menu-text">Магазин</span>
                        <i class="menu-arrow"></i>
                    </a>
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_VIEW))
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ (request()->routeIs('admin.products') || request()->routeIs('admin.products.tree')) || request()->routeIs('admin.product.edit') || request()->routeIs('admin.product.create') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.products') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Товары</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATEGORIES_VIEW))
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.categories') || request()->routeIs('admin.category.edit') || request()->routeIs('admin.category.create') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.categories') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Категории</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BRANDS_VIEW))
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.brands.*') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.brands.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Бренды</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROPERTIES_VIEW))
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.edit') || request()->routeIs('admin.properties.create') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.properties.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Характеристики</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if(auth()->user()->isSuperAdmin())
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.main-block.index') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.main-block.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Блок на главной странице</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::GIFTS_VIEW))
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.gifts.index') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.gifts.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Подарки</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if(auth()->user()->isSuperAdmin()
                || auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCT_PRICES_VIEW))
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.product-prices.index') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.product-prices.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Модуль ценников</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if(auth()->user()->isSuperAdmin()
                || auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_VIEW))
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.catalog-banners.index') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.catalog-banners.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Баннеры каталога</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_ITEMS_VIEW))
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.catalog-items.index') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.catalog-items.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Главный каталог</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </li>
            @endif

            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::GIFT_CARDS_VIEW))
                <li class="menu-item menu-item-submenu
                        {{ (request()->routeIs('admin.gift_cards.index')
                        || request()->routeIs('admin.gif-card')) ? 'menu-item-open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="fas flaticon2-copy menu-icon"></i>
                        <span class="menu-text">Подарочные карты</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" style="" kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ request()->routeIs('admin.gift_cards.index') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.gift_cards.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Подарочные карты</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="menu-submenu" style="" kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ request()->routeIs('admin.gif-card') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{route('admin.gif-card')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Настройки</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::FEEDBACKS_VIEW))
                <li class="menu-item menu-item-submenu
                        {{ (request()->routeIs('admin.chats') || request()->routeIs('admin.feedback-reason.index')) ? 'menu-item-open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="fas flaticon2-copy menu-icon"></i>
                        <span class="menu-text">Обратная связь</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" style="" kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ request()->routeIs('admin.feedback-reason.index') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.feedback-reason.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Причины обращения</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="menu-submenu" style="" kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ request()->routeIs('admin.chats') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{route('admin.chats')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Тикеты</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::SUBSCRIPTIONS_VIEW))
                <li class="menu-item menu-item-submenu {{(request()->routeIs('admin.subscribers.index')
                        || request()->routeIs('admin.subscription-category.index')) ? 'menu-item-open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="fas flaticon2-paper-plane menu-icon"></i>
                        <span class="menu-text">Подписки</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" style="" kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ request()->routeIs('admin.subscribers.index') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{route('admin.subscribers.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Подписчики</span>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('admin.subscription-category.index') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{route('admin.subscription-category.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Категории</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if(auth()->user()->isSuperAdmin()
                    || auth()->user()->can(\App\Services\Admin\PermissionService::NEWS_VIEW)
                    || auth()->user()->can(\App\Services\Admin\PermissionService::BANNERS_VIEW)
                    || auth()->user()->can(\App\Services\Admin\PermissionService::PROMOTIONS_VIEW))
                <li class="menu-item menu-item-submenu
{{ (request()->routeIs('admin.news')
|| request()->routeIs('admin.banner')
|| request()->routeIs('admin.pages.index')
|| request()->routeIs('admin.news.create')
|| request()->routeIs('admin.news.edit')
|| request()->routeIs('admin.banner.create')
|| request()->routeIs('admin.banner.edit')
|| request()->routeIs('admin.pages.create')
|| request()->routeIs('admin.pages.edit')
|| request()->routeIs('admin.promotions.*')) ? 'menu-item-open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="fas flaticon2-copy menu-icon"></i>
                        <span class="menu-text">Страницы</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" style="" kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::NEWS_VIEW))
                                <li class="menu-item {{ (request()->routeIs('admin.news') || request()->routeIs('admin.news.edit') || request()->routeIs('admin.news.create')) ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.news') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Новости</span>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BANNERS_VIEW))
                                <li class="menu-item {{ (request()->routeIs('admin.banner') || request()->routeIs('admin.banner.edit') || request()->routeIs('admin.banner.create')) ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.banner') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Баннеры</span>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->isSuperAdmin())
                                <li class="menu-item {{ request()->routeIs('admin.pages.index') || request()->routeIs('admin.pages.edit') || request()->routeIs('admin.pages.create') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.pages.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Статические</span>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROMOTIONS_VIEW))
                                <li class="menu-item {{ request()->routeIs('admin.promotions.*') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.promotions.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Акции</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCT_AVAILABILITY_WAITER_VIEW))
                <li class="menu-item {{ Str::is('admin.product-availability-waiters.*', request()->route()->getName()) ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.product-availability-waiters.index') }}" class="menu-link">
                        <i class="fas fa-user-clock menu-icon"></i>
                        <span class="menu-text">Ожидаемые товары</span>
                    </a>
                </li>
            @endif

            @if(auth()->user()->isSuperAdmin()
                    || auth()->user()->can(\App\Services\Admin\PermissionService::USERS_VIEW)
                    || auth()->user()->can(\App\Services\Admin\PermissionService::COMMENTS_VIEW)
                    || auth()->user()->can(\App\Services\Admin\PermissionService::QUESTIONS_VIEW)
                    || auth()->user()->can(\App\Services\Admin\PermissionService::MENUS_VIEW))
                <li class="menu-section ">
                    <h4 class="menu-text">Настройки</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                @if(auth()->user()->isSuperAdmin())
                    <li class="menu-item menu-item-submenu
{{ (request()->routeIs('admin.roles.index') || request()->routeIs('admin.admins.index')) ? 'menu-item-open' : '' }}"
                        aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fas fa-lock menu-icon"></i>
                            <span class="menu-text">Администрирование</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.admins.index') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.admins.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Администраторы</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.roles.index') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Роли</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::USERS_VIEW))
                    <li class="menu-item {{ request()->routeIs('admin.users') ? 'menu-item-active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{route('admin.users')}}" class="menu-link">
                            <i class="far fa-user menu-icon"></i>
                            <span class="menu-text">Пользователи</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::LOYALTY_STATUS_VIEW))
                    <li class="menu-item {{ request()->routeIs('admin.loyalty-statuses.index') ? 'menu-item-active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{route('admin.loyalty-statuses.index')}}" class="menu-link">
                            <i class="far fa-user menu-icon"></i>
                            <span class="menu-text">Накопительная система</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->isSuperAdmin()
                        || auth()->user()->can(\App\Services\Admin\PermissionService::COMMENTS_VIEW)
                        || auth()->user()->can(\App\Services\Admin\PermissionService::QUESTIONS_VIEW))
                    <li class="menu-item menu-item-submenu
{{ (request()->routeIs('admin.chats') || request()->routeIs('admin.feedback-reason.index')) ? 'menu-item-open' : '' }}"
                        aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fas flaticon2-copy menu-icon"></i>
                            <span class="menu-text">Комментарии/Вопросы</span>
                            <i class="menu-arrow"></i>
                        </a>
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::QUESTIONS_VIEW))
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ request()->routeIs('admin.product_questions') ? 'menu-item-active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('admin.product_questions') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Вопросы по товарам</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::COMMENTS_VIEW))
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ request()->routeIs('admin.comment') ? 'menu-item-active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('admin.comment') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Комментарии к товарам</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </li>
                @endif
                @if(auth()->user()->isSuperAdmin())
                    <li class="menu-item
{{ request()->routeIs('admin.faq-groups') || request()->routeIs('admin.faq-groups.edit') || request()->routeIs('admin.faq-groups.create') ? 'menu-item-active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('admin.faq-groups') }}" class="menu-link">
                            <i class="far fa-question-circle menu-icon"></i>
                            <span class="menu-text">FAQ</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::MENUS_VIEW))
                    <li class="menu-item menu-item-submenu
{{ request()->routeIs('admin.menu') ||
(request()->routeIs('admin.menu.create') && request()->segment(3) === \App\Models\Menu::TOP_MENU) ||
request()->routeIs('admin.menu.edit', \App\Models\Menu::FOOTER_MENU) ||
request()->routeIs('admin.menu.create', \App\Models\Menu::TOP_MENU) ||
request()->routeIs('admin.menu.edit', \App\Models\Menu::TOP_MENU) ? 'menu-item-open' : '' }}"
                        aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="fas flaticon2-copy menu-icon"></i>
                            <span class="menu-text">Меню</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu" style="" kt-hidden-height="160">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ (request()->routeIs('admin.menu', \App\Models\Menu::TOP_MENU) && request()->segment(3) == \App\Models\Menu::TOP_MENU) || request()->routeIs('admin.menu.create', \App\Models\Menu::TOP_MENU) || request()->routeIs('admin.menu.edit', \App\Models\Menu::TOP_MENU) ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.menu', \App\Models\Menu::TOP_MENU) }}"
                                       class="menu-link">
                                        <i class="fas flaticon2-copy menu-icon"></i>
                                        <span class="menu-text">Верхнее меню</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ (request()->routeIs('admin.menu', \App\Models\Menu::FOOTER_MENU) && request()->segment(3) == \App\Models\Menu::FOOTER_MENU) || request()->routeIs('admin.menu.create', \App\Models\Menu::FOOTER_MENU) || request()->routeIs('admin.menu.edit', \App\Models\Menu::FOOTER_MENU) ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.menu', \App\Models\Menu::FOOTER_MENU) }}"
                                       class="menu-link">
                                        <i class="fas flaticon2-copy menu-icon"></i>
                                        <span class="menu-text">Нижнее меню</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif







                {{--                            <div class="menu-submenu" style="" kt-hidden-height="160">--}}
                {{--                                <i class="menu-arrow"></i>--}}
                {{--                                <ul class="menu-subnav">--}}
                {{--                                    <li class="menu-item {{ request()->routeIs('admin.sale.index') || request()->routeIs('admin.sale.edit') ? 'menu-item-active' : '' }}"--}}
                {{--                                        aria-haspopup="true">--}}
                {{--                                        <a href="{{route('admin.sale.index')}}" class="menu-link">--}}
                {{--                                            <i class="menu-bullet menu-bullet-dot">--}}
                {{--                                                <span></span>--}}
                {{--                                            </i>--}}
                {{--                                            <span class="menu-text">Розпродажі</span>--}}
                {{--                                        </a>--}}
                {{--                                    </li>--}}
                {{--                                </ul>--}}
                {{--                            </div>--}}


                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CONFIG_VIEW))
                    <li class="menu-item  menu-item-submenu {{ (request()->routeIs('admin.settings.contacts') || request()->routeIs('admin.settings.socials')) ? 'menu-item-open' : '' }}"
                        aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
    <span class="svg-icon menu-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"></rect>
                <path
                    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                    fill="#000000"></path>
                <path
                    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                    fill="#000000" opacity="0.3"></path>
            </g>
         </svg>
    </span>
                            <span class="menu-text">Общие</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::ROBOTS_VIEW))
                                    <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                        <span class="menu-link"><span class="menu-text">Общие</span></span>
                                    </li>
                                    <li class="menu-item {{ request()->routeIs('admin.settings.contacts') ? 'menu-item-active' : '' }}">
                                        <a href="#" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                            <span class="menu-text">Контактные данные</span>
                                        </a>
                                    </li>
                                    <li class="menu-item  {{ request()->routeIs('admin.settings.socials') ? 'menu-item-active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('admin.settings.socials') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                            <span class="menu-text">Соц.медиа</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->routeIs('admin.sitemap') ? 'menu-item-active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                            <span class="menu-text">Sitemap Generator</span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::ROBOTS_VIEW))
                                    <li class="menu-item {{ request()->routeIs('admin.robots.index') ? 'menu-item-active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('admin.robots.index') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                            <span class="menu-text">Robots.txt</span>
                                        </a>
                                    </li>
                                    @endif
                                @endif
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CONFIG_VIEW))
                                    <li class="menu-item {{ request()->routeIs('admin.settings.index') ? 'menu-item-active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('admin.settings.index') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                            <span class="menu-text">Настройки</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::DELIVERY_METHODS_VIEW))
                    <li class="menu-item  menu-item-submenu {{ request()->routeIs(['admin.delivery-methods.*'], 'admin.courier-delivery-methods.*') ? 'menu-item-open' : '' }}"
                        aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
    <span class="svg-icon menu-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"></rect>
                <path
                    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                    fill="#000000"></path>
                <path
                    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                    fill="#000000" opacity="0.3"></path>
            </g>
         </svg>
    </span>
                            <span class="menu-text">Доставка</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->routeIs('admin.delivery-methods.*') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.delivery-methods.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">Службы</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->routeIs('admin.courier-delivery-methods.*') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.courier-delivery-methods.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">Курьерская</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            @endif

            @if(auth()->user()->isSuperAdmin())
                <li class="menu-item {{ Str::is('admin.seo-templates.*', request()->route()->getName()) ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.seo-templates.index') }}" class="menu-link">
                        <i class="far fa-star menu-icon"></i>
                        <span class="menu-text">SEO шаблоны</span>
                    </a>
                </li>
            @endif
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
