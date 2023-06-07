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
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="text-muted">Создание товара</a>
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
                                    <span class="nav-text">Оновити</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                    <span class="nav-text">Редагувати зображення</span>
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
                            <form id="blog_post" action="{{ route('admin.product.update', $product->id) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Назва</label>
                                            <input type="text" name="title" class="form-control" value="{{$product->title}}" required/>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Категорії</label>
                                                    <select class="form-control select2" id="kt_select2_4"
                                                            name="category_id" required>
                                                        @foreach($categories as $category)
                                                            <option @if($product->category_id == $category->id) @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Alias</label>
                                                    <input type="text" name="alias" value="{{$product->alias}}" class="form-control" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Brand</label>
                                                    <select class="form-control select2" id="kt_select2_3"
                                                            name="brand_id">
                                                        @foreach($brands as $brand)
                                                            <option @if($product->brand_id == $brand->id) @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleSelect2">Ціна</label>
                                                <input type="number" step="any" name="price" value="{{$product->price}}" class="form-control" required/>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleSelect2">Знижка</label>
                                                <input type="number" step="any" name="discount_price" value="{{$product->discount_price}}" class="form-control"/>
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
                                                    <option @if(\App\Services\SiteService::getProductStatus($product->availability) == \App\Services\SiteService::getProductStatus($value)) selected @endif value="{{$value}}">{{\App\Services\SiteService::getProductStatus($value)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Артикул</label>
                                            <input type="text" name="code" value="{{$product->code}}" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Артикул 1C</label>
                                            <input type="text" name="code_1c" value="{{$product->code_1c}}" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-5">
                                        <label>Описание товара</label>
                                        <textarea class="textEditor" name="description_1">{{$product->description_1}}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-5">
                                        <label>Как использовать</label>
                                        <textarea class="textEditor" name="description_2">{{$product->description_2}}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-5">
                                        <label>Доп. описание</label>
                                        <textarea class="textEditor" name="description_3">{{$product->description_3}}</textarea>
                                    </div>
                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Зберегти</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_2_4">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Редагувати зображення</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createCategoryImageModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>
                                        Додати
                                    </button>
                                </div>
                            </div>
                            <div>
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table table-head-custom table-vertical-center">
                                        <thead>
                                        <tr>
                                            <th class="pl-0 text-center">
                                                #
                                            </th>
                                            <th class="pl-0 text-center">
                                                Зображення
                                            </th>
                                            <th class="pr-0 text-center">
                                                Головне
                                            </th>
                                            <th class="pr-0 text-center">
                                                Дії
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product_images as $image)
                                            <tr data-id="{{ $image->id }}">
                                                <td class="text-center pl-0">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="text-center pl-0">
                                                    <img src="/images/uploads/products/{{ $image->path }}" width="100" height="100">
                                                </td>
                                                <td class="text-center pl-0">
                                                    {{ \App\Services\SiteService::getIsMain($image->id===$product->image_print_id) }}
                                                </td>
                                                <td class="text-center pr-0">
                                                    <button class="btn btn-sm btn-clean btn-icon">
                                                        <i class="handle_cat_image flaticon2-sort"
                                                           style="cursor:pointer;"></i>
                                                    </button>
                                                    <a href="javascript:;" data-toggle="modal"
                                                       data-target="#updateCategoryImageModal"
                                                       data-id="{{ $image->id }}"
                                                       class="btn btn-sm btn-clean btn-icon updateCategoryImage">
                                                        <i class="las la-edit"></i>
                                                    </a>

                                                    <a href="{{ route('admin.product.image.delete', $image->id) }}"
                                                       class="btn btn-sm btn-clean btn-icon"
                                                       onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
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




