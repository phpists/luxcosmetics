<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <!-- <base href="/"> -->
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('/images/favicon.png') }}">
    <meta property="og:image" content="{{ asset('/images/dist/preview.jpg') }}">

    <meta name="theme-color" content="#06473A">

    <link rel="stylesheet" href="{{ asset('/css/main.min.css') }}">
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
    @include('layouts.includes.header', ['menu_items' => $menu_items])
    @yield('content')
    @include('layouts.includes.footer', ['menu_items' => $menu_items])
</div>
@yield('after_content')
@yield('scripts')
<script src="{{asset('/js/app.min.js')}}"></script>
</body>

</html>




