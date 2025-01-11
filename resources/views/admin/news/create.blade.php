@extends('admin.layouts.app')

@section('styles')
    <style>
        .tox-tinymce {
            height: 1500px !important;
            width: 100%;
        }
    </style>
@endsection

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.news') }}" class="text-muted">Новости</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Создание новости
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
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                    <span class="nav-text">Создать</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-toolbar">
                        <button type="submit" form="form1" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_1_4">
                            <form id="form1" action="{{ route('admin.news.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Изображения</label>
                                    <div class="col-auto ml-2">
                                        <div class="image-input image-input-outline" id="createImagePlugin" style="max-height: 700px;">
                                            <div class="image-input-wrapper" id="updateImageBackground"></div>
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" id="imageInput" name="image" required accept="image/*">
                                                <input type="hidden" name="image_remove">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Название</label>
                                            <input type="text" name="title" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Слаг</label>
                                            <input type="text" name="link" class="form-control"/>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Статус</label>
                                            <select class="form-control status" id="kt_select2_1" name="status">
                                                <option value="1">Активный</option>
                                                <option value="0">Неактивный</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Дата публикации</label>
                                            <div class="input-group date" id="kt_datetimepicker_1"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       placeholder="Дата публикации"
                                                       name="published_at" required
                                                       data-target="#kt_datetimepicker_1"/>
                                                <div class="input-group-append" data-target="#kt_datetimepicker_1"
                                                     data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Тип слайдера</label>
                                            <select name="slider_type" id="" class="dropdown form-control">
                                                @foreach(\App\Models\NewsItem::getSliderTypes() as $slider_type)
                                                    <option value="{{$slider_type}}">
                                                        {{\App\Services\SiteService::getNewsSliderType($slider_type)}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Текст</label>
                                        <div style="max-height: 400px; overflow-y: auto;">
                                            <textarea id="textEditor" name="text"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script>
        $('#kt_select2_4').select2({
            allowClear: true
        });
        Promise.allSettled = Promise.allSettled || ((promises) => Promise.all(
            promises.map(p => p
                .then(value => ({
                    status: "fulfilled",
                    value
                }))
                .catch(reason => ({
                    status: "rejected",
                    reason
                }))
            )
        ));

        $(function () {
            CKEDITOR.replace( 'textEditor' );

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var createImagePlugin = new KTImageInput('createImagePlugin');
            var createPageImagePlugin = new KTImageInput('createPageImagePlugin');
        });
    </script>

@endsection
