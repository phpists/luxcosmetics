@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}" class="text-muted">Главная</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.pages.index') }}" class="text-muted">Страницы</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.pages.create') }}"
                           class="text-muted">Создание страницы</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <!--end::Subheader-->
    <!--begin::Entry-->
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
                                    <span class="nav-text">Создание</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_1_4">
                            <form action="{{ route('admin.pages.store') }}" method="POST">
                                @csrf
                                @method('post')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row align-items-center">
                                                <div class="col col-md-6 px-0">
                                                    <div class="form-group w-100">
                                                        <label for="createFaqQuestion" class="col-auto col-form-label font-weight-bold">Название</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="createPageTitle" name="title" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col col-md-2 px-0">
                                                    <div class="form-group w-100">
                                                        <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Ссылка</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="createLink" name="link" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Активная</label>
                                                        <div class="">
                                                            <span class="switch">
                                                                <label>
                                                                    <input type="checkbox" checked="checked" name="is_active"/>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <label>Описание характеристики</label>
                                                <textarea class="textEditor" name="content"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->
{{--    @include('admin.categories.modals.create')--}}
{{--    @include('admin.categories.modals.update')--}}

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>

    <script>
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

        // tinymce.init({
        //     selector: '.textEditor',
        //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        //     tinycomments_mode: 'embedded',
        //     tinycomments_author: 'Author name',
        //     language: 'ru',
        //     height: "1000"
        // });
        $('.textEditor').summernote($.extend(summernoteDefaultOptions, {
            height: 400
        }));
    </script>
@endsection




