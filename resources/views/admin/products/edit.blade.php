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
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="text-muted">{{$product->title}}</a>
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
                                    <span class="nav-text">Обновить</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                    <span class="nav-text">Изображения</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
                                    <span class="nav-text">Модификации</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_4">
                                    <span class="nav-text">Характеристики</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <button type="submit" form="blog_post" class="btn btn-primary">Сохранить</button>
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
                                            <label for="exampleSelect2">Название</label>
                                            <input type="text" name="title" class="form-control" value="{{$product->title}}" required/>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Категории</label>
                                                    <select class="form-control select2" id="kt_select2_4"
                                                            name="category_id" required>
                                                        @foreach($categories as $category)
                                                            <option @if($product->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>ЧПУ</label>
                                                    <input type="text" name="alias" value="{{$product->alias}}" class="form-control" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Бренд</label>
                                                    <select class="form-control select2" id="kt_select2_3"
                                                            name="brand_id">
                                                        @foreach($brands as $brand)
                                                            <option @if($product->brand_id == $brand->id) @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleSelect2">Цена</label>
                                                <input type="number" step="any" name="price" value="{{$product->price}}" class="form-control" required/>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleSelect2">Скидка</label>
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
                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_2_4">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Редактировать изображение</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createProductImageModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>
                                        Добавить
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
                                                ИЗОБРАЖЕНИЕ
                                            </th>
                                            <th class="pr-0 text-center">
                                                ГЛАВНОЕ
                                            </th>
                                            <th class="pr-0 text-center">
                                                Действия
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
                                                       data-target="#updateProductImageModal"
                                                       data-id="{{ $image->id }}"
                                                       class="btn btn-sm btn-clean btn-icon updateCategoryImage edit-btn-img">
                                                        <i class="las la-edit"></i>
                                                    </a>

                                                    <a href="{{ route('admin.product.image.remove', $image->id) }}"
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
                        <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_2_4">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Редактировать модификации</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createProductVariationModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>
                                        Добавить
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
                                                Объем
                                            </th>
                                            <th class="pr-0 text-center">
                                                Цена
                                            </th>
                                            <th class="pr-0 text-center">
                                                Скидка
                                            </th>
                                            <th class="pr-0 text-center">
                                                Дії
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->product_variations as $product_variation)
                                            <tr data-id="{{ $product_variation->id }}">
                                                <td class="text-center pl-0">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="text-center pl-0">
                                                    {{$product_variation->size}}
                                                </td>
                                                <td class="text-center pl-0">
                                                    {{$product_variation->price}}
                                                </td>
                                                <td class="text-center pl-0">
                                                    {{$product_variation->discount_price??"-"}}
                                                </td>
                                                <td class="text-center pr-0">
                                                    <button class="btn btn-sm btn-clean btn-icon">
                                                        <i class="handle_cat_image flaticon2-sort"
                                                           style="cursor:pointer;"></i>
                                                    </button>
                                                    <a href="javascript:;" data-toggle="modal"
                                                       data-target="#updateProductVariationModal"
                                                       data-id="{{ $product_variation->id }}"
                                                       class="btn btn-sm btn-clean btn-icon updateCategoryImage edit-btn-variation">
                                                        <i class="las la-edit"></i>
                                                    </a>

                                                    <a href="{{ route('admin.product.variation.remove', $product_variation->id) }}"
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
                        <div class="tab-pane fade" id="kt_tab_pane_4_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_2_4">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Редактировать модификации</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createProductVariationModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>
                                        Добавить
                                    </button>
                                </div>
                            </div>
                            <div>
                                <!--begin::Table-->
                                @foreach($product->category->properties as $property)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h2>{{$property->name}}</h2>
                                                <select class="form-control select2 property_values" id="prop_{{$property->id}}" name="availability">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    @include('admin.products.modals.create')
    @include('admin.products.modals.update')
    @include('admin.products.modals.create-variation')
    @include('admin.products.modals.update-variation')
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
        $('.select2.property_values').each((idx, el) => {
            console.log(el);
           $('#'+el.id).select2({
               allowClear: true
           });
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
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
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

            var createImagePlugin = new KTImageInput('kt_image_1');
            var createPageImagePlugin = new KTImageInput('kt_image_1');
        });
        $(document).on('click', ".edit-btn-img", loadModel);

        function loadModel() {
            let id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.image.show", $image->id) }}',
                data: {
                    id: id
                },
                success: function (response) {
                    {{--let img_url = 'url("{{ asset('images/uploads/products/') }}/' + response.path + '")';--}}
                    {{--$('#updateImageBackground').css('background-image', img_url);--}}
                    let is_main = response.is_main;
                    let is_active = response.is_active;
                    $(`#updateActive option[value="${is_active}"]`).attr('selected', 'selected');
                    $(`#updateIsMain option[value="${is_main}"]`).attr('selected', 'selected');
                    if(is_main === 1) {
                        $(`#updateIsMain`).attr('disabled', true);
                    }
                    else {
                        $(`#updateIsMain`).attr('disabled', false);
                    }
                    $('#imageId').val(id);
                },
                error: function (response) {
                    console.log(response)
                }
            })
        }
        $(document).on('click', ".edit-btn-variation", loadModelVariation);

        function loadModelVariation() {
            let id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.product.variation.show", $image->id) }}',
                data: {
                    id: id
                },
                success: function (response) {
                    {{--let img_url = 'url("{{ asset('images/uploads/products/') }}/' + response.path + '")';--}}
                    {{--$('#updateImageBackground').css('background-image', img_url);--}}
                    $('#updateVariationSize').val(response.size);
                    $('#updateVariationPrice').val(response.price);
                    $('#updateVariationDiscountPrice').val(response.discount_price);
                    $('#variationId').val(id);
                },
                error: function (response) {
                    console.log(response)
                }
            })
        }
    </script>

@endsection




