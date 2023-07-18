<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>LuxCosmetics | Админ-панель</title>
    <meta name="description" content="Betinsurance"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="lang" content="{{ app()->getLocale() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <link rel="canonical" href="https://keenthemes.com/metronic"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('super_admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('super_admin/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('super_admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('super_admin/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('super_admin/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('super_admin/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('super_admin/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Layout Themes-->
    <link href="{{ asset('super_admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>

    <link rel="shortcut icon" href="{{ asset('super_admin/media/logos/favicon.ico') }}"/>

    <link href="{{ asset('super_admin/css/main.css') }}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{ asset('super_admin/css/main.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('super_admin/plugins/custom/uppy/uppy.bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('super_admin/css/toastr.css') }}">
@yield('styles')

<!--end::Layout Themes-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <!--begin::Logo-->
    <a href="{{ route('admin.dashboard') }}">
        <img alt="Logo" src="{{ asset('super_admin/media/logos/logo-light.png') }}"/>
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24"/>
								<path
                                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								<path
                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                    fill="#000000" fill-rule="nonzero"/>
							</g>
						</svg>
                        <!--end::Svg Icon-->
					</span>
        </button>
        <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Aside-->
        <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
            <!--begin::Brand-->
            <div class="brand flex-column-auto" id="kt_brand">
                <!--begin::Logo-->
                <h1 style="color: #fff">LuxCosmetics</h1>
                <!--end::Logo-->
                <!--begin::Toggle-->
                <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                     version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24"/>
										<path
                                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"/>
										<path
                                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"/>
									</g>
								</svg>
                                <!--end::Svg Icon-->
							</span>
                </button>
                <!--end::Toolbar-->
            </div>
            <!--end::Brand-->
            <!--begin::Aside Menu-->
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

                        <li class="menu-item menu-item-submenu
{{ (request()->routeIs('admin.products')
|| request()->routeIs('admin.products.tree')
|| request()->routeIs('admin.categories')
|| request()->routeIs('admin.brands.index')
|| request()->routeIs('admin.properties.index')
|| request()->routeIs('admin.product.edit')
|| request()->routeIs('admin.product.create')
|| request()->routeIs('admin.category.edit')
|| request()->routeIs('admin.category.create')
|| request()->routeIs('admin.properties.edit')
|| request()->routeIs('admin.properties.create')) ? 'menu-item-open' : '' }}"
                        aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <i class="fas flaticon2-copy menu-icon"></i>
                                <span class="menu-text">Магазин</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ (request()->routeIs('admin.products') || request()->routeIs('admin.products.tree')) || request()->routeIs('admin.product.edit') || request()->routeIs('admin.product.create') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.products') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Товары</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ request()->routeIs('admin.categories') || request()->routeIs('admin.category.edit') || request()->routeIs('admin.category.create') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.categories') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Категории</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ request()->routeIs('admin.brands.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.brands.index') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Бренды</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ request()->routeIs('admin.properties.index') || request()->routeIs('admin.properties.edit') || request()->routeIs('admin.properties.create') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.properties.index') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Характеристики</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ request()->routeIs('admin.main-block.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.main-block.index') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Блок на главной странице</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


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


                        </li>

                        <li class="menu-item menu-item-submenu
                        {{ (request()->routeIs('admin.chats') || request()->routeIs('admin.feedback-reason.index') || request()->routeIs('admin.users')) ? 'menu-item-open' : '' }}"
                            aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <i class="fas flaticon2-copy menu-icon"></i>
                                <span class="menu-text">Обратная связь</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ request()->routeIs('admin.feedback-reason.index') ? 'menu-item-active' : '' }}" aria-haspopup="true">
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
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ request()->routeIs('admin.users') ? 'menu-item-active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{route('admin.users')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Пользователи</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

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

                        <li class="menu-item menu-item-submenu
{{ (request()->routeIs('admin.news')
|| request()->routeIs('admin.banner')
|| request()->routeIs('admin.pages.index')
|| request()->routeIs('admin.news.create')
|| request()->routeIs('admin.news.edit')
|| request()->routeIs('admin.banner.create')
|| request()->routeIs('admin.banner.edit')
|| request()->routeIs('admin.pages.create')
|| request()->routeIs('admin.pages.edit')) ? 'menu-item-open' : '' }}"
                        aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <i class="fas flaticon2-copy menu-icon"></i>
                                <span class="menu-text">Страницы</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu" style="" kt-hidden-height="160">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item {{ (request()->routeIs('admin.news') || request()->routeIs('admin.news.edit') || request()->routeIs('admin.news.create')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.news') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Новости</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ (request()->routeIs('admin.banner') || request()->routeIs('admin.banner.edit') || request()->routeIs('admin.banner.create')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.banner') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Баннеры</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->routeIs('admin.pages.index') || request()->routeIs('admin.pages.edit') || request()->routeIs('admin.pages.create') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.pages.index') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Статические</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-section ">
                            <h4 class="menu-text">Настройки</h4>
                            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                        </li>
                        <li class="menu-item
                        {{ request()->routeIs('admin.faq-groups') || request()->routeIs('admin.faq-groups.edit') || request()->routeIs('admin.faq-groups.create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('admin.faq-groups') }}" class="menu-link">
                                <i class="far fa-question-circle menu-icon"></i>
                                <span class="menu-text">FAQ</span>
                            </a>
                        </li>
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
                <a href="{{ route('admin.menu', \App\Models\Menu::TOP_MENU) }}" class="menu-link">
                    <i class="fas flaticon2-copy menu-icon"></i>
                    <span class="menu-text">Верхнее меню</span>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('admin.menu', \App\Models\Menu::FOOTER_MENU) && request()->segment(3) == \App\Models\Menu::FOOTER_MENU) || request()->routeIs('admin.menu.create', \App\Models\Menu::FOOTER_MENU) || request()->routeIs('admin.menu.edit', \App\Models\Menu::FOOTER_MENU) ? 'menu-item-active' : '' }}"
                aria-haspopup="true">
                <a href="{{ route('admin.menu', \App\Models\Menu::FOOTER_MENU) }}" class="menu-link">
                    <i class="fas flaticon2-copy menu-icon"></i>
                    <span class="menu-text">Нижнее меню</span>
                </a>
            </li>
        </ul>
    </div>
</li>







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


                        </li>
                        <li class="menu-item  menu-item-submenu {{ (request()->routeIs('admin.settings.contacts') || request()->routeIs('admin.settings.socials')) ? 'menu-item-open' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                     </svg>
                                </span>
                                <span class="menu-text">Общие</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                        <span class="menu-link"><span class="menu-text">Общие</span></span>
                                    </li>
                                    <li class="menu-item {{ request()->routeIs('admin.settings.contacts') ? 'menu-item-active' : '' }}">
                                        <a href="#" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                            <span class="menu-text">Контактные данные</span>
                                        </a>
                                    </li>
                                    <li class="menu-item  {{ request()->routeIs('admin.settings.socials') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.settings.socials') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                            <span class="menu-text">Соц.медиа</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->routeIs('admin.sitemap') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                            <span class="menu-text">Sitemap Generator</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->routeIs('admin.robots') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                        <a href="" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                            <span class="menu-text">Robots.txt</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                    <!--end::Menu Nav-->
                </div>
                <!--end::Menu Container-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
        @include('admin.layouts.includes.header')
        <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                @yield('content')
            </div>
            <!--end::Content-->
            @include('admin.layouts.includes.footer')
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">Ваш профиль</h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label"
                     style="background-image:url( {{ asset('super_admin/media/users/300_21.jpg') }})"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#"
                   class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ Auth::user()->name }}</a>
                <!-- <div class="text-muted mt-1">Application Developer</div> -->
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-lg svg-icon-primary">
											<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path
                                                        d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                        fill="#000000"/>
													<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"/>
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
									</span>
									<span
                                        class="navi-text text-muted text-hover-primary">{{ Auth::user()->email }}</span>
								</span>
                    </a>
                    <a href="{{ route('logout') }}"
                       class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24"/>
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
						<path
                            d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                            fill="#000000" fill-rule="nonzero"/>
					</g>
				</svg>
                <!--end::Svg Icon-->
			</span>
</div>
<!--end::Scrolltop-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('super_admin/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('super_admin/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('super_admin/js/scripts.bundle.js') }}"></script>

<!-- SUMMERNOTE WYSIWYG image upload/delete methods -->
<script src="{{ asset('js/summernote_file_options.js') }}"></script>

<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('super_admin/js/pages/widgets.js') }}"></script>
<script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>

{{--Custom js--}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<script src="{{ asset('super_admin/js/select2-uk.js') }}"></script>

<script src="{{ asset('super_admin/js/toastr.min.js') }}"></script>
@yield('js_after')
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>
