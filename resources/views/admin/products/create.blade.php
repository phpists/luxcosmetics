@extends('admin.layouts.app')

@section('styles')
    <style>
        .tox-tinymce {
            height: 600px !important;
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
                <h5 class="text-dark font-weight-bold my-1 mr-5">Головна</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products') }}" class="text-muted">Товар</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.product.create') }}" class="text-muted">Создание товара</a>
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
                                    <span class="nav-text">Створити</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <button type="submit" form="blog_post" class="btn btn-primary">Зберегти</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_1_4">
                            <form id="blog_post" action="{{ route('admin.products.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Назва</label>
                                            <input type="text" name="title" class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Категорії</label>
                                            <select class="form-control select2" id="kt_select2_4"
                                                    name="category_id" required>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Brand</label>
                                                    <select class="form-control select2" id="kt_select2_3"
                                                            name="brand_id">
                                                        @foreach($brands as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="exampleSelect2">Ціна</label>
                                                <input type="number" step="any" name="price" class="form-control" required/>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="exampleSelect2">Знижка</label>
                                                <input type="number" step="any" name="discount_price" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Зображення</label>
                                            <div class="col-auto ml-2">
                                                <div class="image-input  image-input-outline" id="createImagePlugin"
                                                     style="max-height: 700px;">
                                                    <div class="image-input-wrapper" id="updateImageBackground"></div>
                                                    <label
                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change" data-toggle="tooltip"
                                                        data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="image" required accept="image/*"/>
                                                        <input type="hidden" name="image_remove"/>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Статус</label>
                                            <select class="form-control status" id="kt_select2_1" name="availability">
                                                @foreach(array_column(\App\Enums\AvailableOptions::cases(), 'value') as $value)
                                                    <option value="{{$value}}">{{\App\Services\SiteService::getProductStatus($value)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Артикул</label>
                                            <input type="text" name="code" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Артикул 1C</label>
                                            <input type="text" name="code_1c" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alias</label>
                                            <input type="text" name="alias" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-5">
                                        <label>Описание товара</label>
                                        <textarea class="textEditor" name="description_1"></textarea>
                                    </div>
                                    <div class="col-md-12 mb-5">
                                        <label>Как использовать</label>
                                        <textarea class="textEditor" name="description_2"></textarea>
                                    </div>
                                    <div class="col-md-12 mb-5">
                                        <label>Доп. описание</label>
                                        <textarea class="textEditor" name="description_3"></textarea>
                                    </div>
                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Зберегти</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_3_4">

{{--                            <form action="{{ route('admin.blog.update.seo') }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="blog_id">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>H1</label>--}}
{{--                                            <input type="text" name="h1" class="form-control"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta title</label>--}}
{{--                                            <input type="text" name="meta_title" class="form-control"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta robots</label>--}}
{{--                                            <input type="text" name="meta_robots" class="form-control"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta description</label>--}}
{{--                                            <textarea class="form-control" id="meta_description"--}}
{{--                                                      name="meta_description"></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta keywords</label>--}}
{{--                                            <textarea class="form-control" id="meta_keywords"--}}
{{--                                                      name="meta_keywords"></textarea>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="card-footer">--}}
{{--                                    <button type="submit" class="btn btn-primary mr-2">Зберегти</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}

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
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/3h27q9hxq81txaaz86zvgxqs5cuixqt8167b543rwzusizui/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
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

        tinymce.init({
            selector: '.textEditor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss grid',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | grid',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            language: 'uk',
            height: "1000"
        });

        $(function () {
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




