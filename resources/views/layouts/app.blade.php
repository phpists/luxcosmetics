<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <!-- <base href="/"> -->
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">

    <meta property="og:title" content="@yield('og:title')">
    <meta property="og:description" content="@yield('og:description')">
    <meta property="og:image" content="{{ asset('/images/dist/preview.jpg') }}">
    <meta property="og:url" content="@yield('og:url')"/>
    <meta property="og:type" content="website">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <meta name="theme-color" content="#06473A">

    <link rel="stylesheet" href="{{ asset('/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <![endif]-->

    <meta name="yandex-verification" content="1a6e42b4fe6f0e17" />
    @livewireStyles
    @yield('styles')
</head>

<body>
<div class="overlay"></div>
<div id="page" class="wrapper @yield('wrapper_class')">
    @yield('before_content')
    @php
        $menu_items = \App\Models\Menu::query()->where('is_active', 1)->orderBy('position')->get();
    @endphp
    @php
        $static_pages = \App\Models\Page::query()->where('is_active', 1)->get();
    @endphp
    @php
        $social = \App\Models\SocialMedia::query()->select('social_medias.*')->get();
    @endphp
    @include('layouts.includes.header', ['menu_items' => $menu_items, 'social' => $social])
    @include('layouts.includes.messages')

    @yield('content')

    @include('layouts.includes.purchase_modal')

    @guest
        @include('layouts.modals.otp-modal')
    @endguest

    @include('layouts.includes.footer', ['menu_items' => $menu_items, 'static-pages' => $static_pages, 'social' => $social])
</div>
@include('layouts.parts.mobile-menu', ['menu_items' => $menu_items])
<div class="hidden">
    @yield('hidden-content')
    <div class="popupform form" id="callback">
        <div class="popupform__title">Оставить сообщение</div>
        <div class="form__fieldset">
            <input type="text"  class="form__input" name="Имя" placeholder="Ваше имя"  required="required">
        </div>
        <div class="form__fieldset">
            <input type="text"  class="form__input" name="Телефон" placeholder="Номер телефона" required="required">
        </div>
        <button class="btn btn--accent">Отправить</button>
    </div>
</div>
@yield('after_content')
<script src="{{asset('/js/app.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function (ev) {
        let results_container = document.getElementById('search_results');

        let search_field = document.getElementById('search_field_header');

        let header_search = document.getElementById('header_search');
        //
        // search_field.addEventListener("focus", (event) => {
        //     results_container.style.display = "block";
        // }, true);

        // document.getElementById('search_field_header').addEventListener("blur", (event) => {
        //     results_container.style.display = "none";
        // }, false);

        function clickOutsideInput(ev) {
            if (ev.target !== search_field && !search_field.contains(ev.target)) {
                results_container.style.display = "none";
                document.removeEventListener('click', clickOutsideInput);
            }
        }

        header_search.addEventListener('input', function (ev) {
            document.addEventListener('click', clickOutsideInput);
            if (ev.target.value !== '') {
                fetch('{{route('search_prompt')}}?search='+ev.target.value, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    },
                }).then(async (resp) => {
                    let result = await resp.json();
                    results_container.innerHTML = "";
                    for (const resultKey in result) {
                        let div = document.createElement('div');
                        let title = result[resultKey].title;
                        let link = '/p/' + result[resultKey].alias;
                        div.innerHTML = `<a href="${link}">${title}</a>`;
                        results_container.appendChild(div);
                        results_container.style.display = "block";
                    }
                })
            }
            else {
                results_container.innerHTML = "";
                results_container.style.display = "none";
            }
        })
    })
</script>
<script src="{{ asset('js/cart.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('/js/scripts.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
@livewireScripts
@yield('scripts')
@stack('scripts')
{!! \App\Services\SiteConfigService::getParamValue('footer_scripts') !!}
</body>

</html>




