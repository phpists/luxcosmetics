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
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-muted">Главная</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.category_posts') }}" class="text-muted">Посты для категорий</a>
                </li>
                <li class="breadcrumb-item">
                    Создать пост
                </li>                <!--end::Page Title-->
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
                    <form id="form1" action="{{ route('admin.category_post.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-start">
                            <div class="form-group col">
                                <div class="col-auto ml-2">
                                    <div class="image-input image-input-outline" id="createImagePlugin">
                                        <div class="image-input-wrapper" id="updateImageBackground"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image_path" accept="image/*"/>
                                            <input type="hidden" name="image_remove"/>
                                        </label>
                                    </div>
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
                                    <label for="exampleSelect2">Ссылка</label>
                                    <input type="text" name="link" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Статус</label>
                                    <select class="form-control status" name="is_active">
                                        <option value="1">Активный</option>
                                        <option value="0">Неактивный</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Категория</label>
                                    <select class="form-control select2" id="cat_select" name="category_id">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Текст</label>
                                <div style="max-height: 400px; overflow-y: auto;">
                                    <textarea id="textEditor" name="content"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
    @endsection
@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script>
        $('#kt_select2_4').select2({
            allowClear: true
        });
        $("#cat_select").select2(
            {
                placeholder: "Категория",
                allowClear: true
            }
        );
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

        var KTSummernote = function () {
            // Private functions
            var demos = function () {
                $('#textEditor').summernote($.extend(summernoteDefaultOptions, {
                    height: 1000
                }));
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            KTSummernote.init();

            var createImagePlugin = new KTImageInput('createImagePlugin');
            var createPageImagePlugin = new KTImageInput('createPageImagePlugin');
            var updateSmallImagePlugin = new KTImageInput('updateSmallImagePlugin');
            var updateMediumImagePlugin = new KTImageInput('updateMediumImagePlugin');
        });
    </script>

@endsection
