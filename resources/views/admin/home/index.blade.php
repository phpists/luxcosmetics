@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}" class="text-muted">Главная</a>
                    </li>
                </ul>
                <!--end::Page Title-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line" style="gap: 10px">
                    @php
                        $tab_id = 'tab_1';
                        if (session('tab_id')){
                            $tab_id = session('tab_id');
                        }
                    @endphp
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item" data-tab="tab_1">
                                <a class="nav-link @if($tab_id === 'tab_1') active @endif" data-toggle="tab"
                                   href="#tab_1">
                                    <span class="nav-text">Главный слайдер</span>
                                </a>
                            </li>
                            <li class="nav-item" data-tab="tab_2">
                                <a class="nav-link @if($tab_id === 'tab_2') active @endif"
                                   data-toggle="tab"
                                   href="#tab_2">
                                    <span class="nav-text">Бестселлеры</span>
                                </a>
                            </li>
                            <li class="nav-item" data-tab="tab_3">
                                <a class="nav-link @if($tab_id === 'tab_3') active @endif"
                                   data-toggle="tab"
                                   href="#tab_3">
                                    <span class="nav-text">SEO</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body pb-3">
                    <div class="tab-content">
                        <div class="tab-pane fade @if($tab_id === 'tab_1') show active @endif" id="tab_1"
                             role="tabpanel" aria-labelledby="tab_1">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Главный слайдер</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createMainSliderModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>Добавить
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 text-center">
                                            #
                                        </th>
                                        <th class="pr-0 text-center">
                                            Название
                                        </th>
                                        <th class="text-center pr-0">
                                            Краткое описание
                                        </th>
                                        <th class="text-center pr-0">
                                            Ссылка
                                        </th>
                                        <th class="text-center pr-0">
                                            Надпись кнопки
                                        </th>
                                        <th class="text-center pr-0">
                                            Изображения
                                        </th>
                                        <th class="pr-0 text-center">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    @foreach($homeMainSlider as $item)
                                        <tr id="post_{{$item->id}}" data-id="{{ $item->id }}">
                                            <td class="text-center pl-0">
                                                {{ $item->id }}
                                            </td>
                                            <td class="text-center pr-0">
                                                {!! $item->title !!}
                                            </td>
                                            <td class="text-center pr-0">
                                                {!! $item->description !!}
                                            </td>
                                            <td class="text-center pr-0">
                                                {{ $item->link }}
                                            </td>
                                            <td class="text-center pr-0">
                                                {{ $item->btn_title }}
                                            </td>
                                            <td class="text-center pr-0">
                                                <div class="article__image">
                                                    @if (Str::endsWith($item->file, ['.mp4']))
                                                        <video  muted autoplay playsinline loop poster="" data-swiper-parallax="40%" style="height: 80px; width: auto;">
                                                            <source src="{{ $item->getImage() }}" type="video/mp4" >
                                                        </video>
                                                    @else
                                                        <img src="{{ $item->getImage() }}" alt="" style="height: 80px; width: auto;">
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center pr-0">
                                                {{ date('m Y, H:i:s', strtotime($item->created_at)) }}
                                            </td>
                                            <td class="text-center pr-0">
                                                <a href="javascript:;"
                                                   class="btn btn-sm btn-clean btn-icon editMainSliderBtn"
                                                   data-toggle="modal"
                                                   data-target="#updateMainSliderModal"
                                                   data-id="{{ $item->id }}">
                                                    <i class="las la-edit"></i>
                                                </a>

                                                <form class="flex-fill"
                                                      action="{{ route('admin.main-slider.destroy', $item->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn--accent" style="width: 100%"
                                                            onclick="return confirm('Вы уверенны, что хотите удалить данную запись?')">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade @if($tab_id === 'tab_2') show active @endif" id="tab_2"
                             data-tab="tab_2" role="tabpanel" aria-labelledby="tab_2">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Бестселлеры</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createBestSellersModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>Добавить
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 text-center">
                                            #
                                        </th>
                                        <th class="pr-0 text-center">
                                            Название
                                        </th>
                                        <th class="text-center pr-0">
                                            Краткое описание
                                        </th>
                                        <th class="text-center pr-0">
                                            Ссылка
                                        </th>
                                        <th class="text-center pr-0">
                                            Изображения
                                        </th>
                                        <th class="pr-0 text-center">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="table" class="brand-table">
                                    @foreach($bestSeller as $item)
                                        <tr id="post_{{$item->id}}" data-id="{{ $item->id }}">
                                            <td class="text-center pl-0">
                                                {{ $item->id }}
                                            </td>
                                            <td class="text-center pr-0">
                                                {{ $item->title }}
                                            </td>
                                            <td class="text-center pr-0">
                                                {{ $item->description }}
                                            </td>
                                            <td class="text-center pr-0">
                                                {{ $item->link }}
                                            </td>
                                            <td class="text-center pr-0">
                                                <div class="article__image">
                                                    <img src="{{ $item->getImage() }}"
                                                         alt=""
                                                         style="height: 80px; width: auto;">
                                                </div>
                                            </td>
                                            <td class="text-center pr-0">
                                                {{ date('m Y, H:i:s', strtotime($item->created_at)) }}
                                            </td>
                                            <td class="text-center pr-0">
                                                <a href="javascript:;"
                                                   class="btn btn-sm btn-clean btn-icon editBestSellerBtn"
                                                   data-toggle="modal"
                                                   data-target="#updateBestSellersModal"
                                                   data-id="{{ $item->id }}">
                                                    <i class="las la-edit"></i>
                                                </a>

                                                <form class="flex-fill"
                                                      action="{{ route('admin.best-seller.destroy', $item->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn--accent" style="width: 100%"
                                                            onclick="return confirm('Вы уверенны, что хотите удалить данную запись?')">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade @if($tab_id === 'tab_3') show active @endif" id="tab_3"
                             role="tabpanel" aria-labelledby="tab_3">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-2">
                                        <h3>Seo</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-group">
                                        <button form="seo_form" type="submit" class="btn btn-success mr-2">Save
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <form id="seo_form" action="#" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta title</label>
                                            <input type="text" name="meta_title" class="form-control"
                                                   value="{{ $seo->meta_title ?? '' }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta description</label>
                                            <textarea class="form-control" id="meta_description"
                                                      name="meta_description">{{ $seo->meta_description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta keywords</label>
                                            <textarea class="form-control" id="meta_keywords"
                                                      name="meta_keywords">{{ $seo->meta_keywords ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta:og Title</label>
                                            <input type="text" name="og_title" class="form-control"
                                                   value="{{ $seo->og_title ?? '' }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta:og Description</label>
                                            <textarea class="form-control" id="meta_description"
                                                      name="og_description">{{ $seo->og_description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.home.modals.best_sellers.create')
    @include('admin.home.modals.best_sellers.update')

    @include('admin.home.modals.main_slider.create')
    @include('admin.home.modals.main_slider.update')
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/Sortable.js') }}"></script>
    <script src="{{ asset('super_admin/js/best_seller.js') }}"></script>
    <script src="{{ asset('super_admin/js/home_slider.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>

    <script>
        var createImagePlugin = new KTImageInput('createImagePlugin');
        var updateImagePlugin = new KTImageInput('updateImagePlugin');

        var createMainSliderImagePlugin = new KTImageInput('createMainSliderImagePlugin');
        var updateMainSliderImagePlugin = new KTImageInput('updateMainSliderImagePlugin');
    </script>
@endsection
