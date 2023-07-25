<!DOCTYPE html>
<html lang="uk">

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
    <link rel="icon" href="{{ asset('/images/54231.mp3') }}">

    <meta name="theme-color" content="#06473A">

    <link rel="stylesheet" href="{{ asset('/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/cart.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    @vite(['resources/js/app.js'])
    <![endif]-->

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
    @include('layouts.includes.header', ['menu_items' => $menu_items])
    @yield('content')

    @include('layouts.includes.purchase_modal')

    @include('layouts.includes.footer', ['menu_items' => $menu_items, 'static-pages' => $static_pages])
</div>
@include('layouts.parts.mobile-menu', ['menu_items' => $menu_items])
<div class="hidden">
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

        search_field.addEventListener("focus", (event) => {
            results_container.style.display = "block";
        }, true);

        search_field.addEventListener("blur", (event) => {
            results_container.style.display = "none";
        });

        header_search.addEventListener('input', function (ev) {
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
                    }
                })
            }
            else {
                results_container.innerHTML = "";
            }
        })
    })
</script>
<script src="{{ asset('js/cart.js') }}"></script>
@yield('scripts')
</body>

</html>




