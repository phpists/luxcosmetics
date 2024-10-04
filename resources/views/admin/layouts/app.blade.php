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
            @include('admin.layouts.includes.sidebar')
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
