@extends('admin.layouts.app')

@section('styles')
    <style>
        .tox-tinymce {
            height: 600px !important;
            width: 100%;
        }
        .select2-container--default {
            width: 100% !important;
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
                <h5 class="text-dark font-weight-bold my-1 mr-5">Главная</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products') }}" class="text-muted">Товары</a>
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
                <div class="card-header card-header-tabs-line" style="gap: 10px">
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
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_4">
                                    <span class="nav-text">Характеристики</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#banners">
                                    <span class="nav-text">Статьи</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar" style="gap: 10px; margin-bottom: 10px">
                        <a href="{{ route('products.product', ['alias' => $product->alias]) }}" class="btn btn-primary me-3">Посмотреть товар</a>
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
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="exampleSelect2">Название</label>
                                                    <input type="text" name="title" class="form-control" value="{{$product->title}}" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Размер</label>
                                                <input type="text" name="size" class="form-control" required value="{{$product->size}}"/>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Бонусные баллы</label>
                                                <input type="number" step="1" min="0" value="{{$product->points}}" name="points" required class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Категория</label>
                                                    <select class="form-control select2" id="kt_select2_4"
                                                            name="category_id" required>
                                                        @foreach($categories as $category)
                                                            <option @if($product->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" id="variations_container">
                                                    <label>Главная характеристика</label>
                                                    <select class="form-control select2" id="base_property_select_new"
                                                            name="base_property_id" required>
{{--                                                        @foreach($product->category->properties as $category_property)--}}
{{--                                                            <option value="{{ $category_property->id }}" @selected($product->base_property_id === $category_property->id)>{{ $category_property->name }}</option>--}}
{{--                                                        @endforeach--}}

                                                        @foreach(\App\Models\Product::ALL_TYPES as $id => $name)
                                                            <option value="{{ $id }}" @selected($product->base_property_id === $id)>{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" id="variations_container">
                                                    <label>Модификации</label>
                                                    <select class="form-control select2" id="variations_select"
                                                            name="variations_id[]" data-property="{{ $product->base_property_id }}" data-product="{{ $product->id }}" multiple>
                                                        @foreach($product_variations as $variation)
                                                            <option value="{{$variation->id}}" selected>{{ $variation->title . (isset($variation->base_property_value) ? ' (' . $variation->base_property_value . ($variation->base_property_measure ?? '') . ')' : '' )}}</option>
                                                        @endforeach
                                                    </select>
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
                                            <div class="col-md-2">
                                                <label for="exampleSelect2">Цена</label>
                                                <input type="number" step="any" name="price" value="{{$product->price}}" class="form-control" required/>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="exampleSelect2">Старая цена</label>
                                                <input type="number" step="any" name="old_price" value="{{$product->old_price}}" class="form-control"/>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="exampleSelect2">Скидка в %</label>
                                                <input type="number" step="any" name="discount" value="{{$product->discount}}" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Статус</label>
                                            <select class="form-control status" name="availability">
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>ЧПУ</label>
                                            <input type="text" name="alias" value="{{$product->alias}}" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" @if($product->show_in_sales_page) checked @endif name="show_in_sales_page"/>
                                                    <span></span>
                                                    Отобразить на странице акции
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" @if($product->show_in_percent_discount_page) checked @endif name="show_in_percent_discount_page"/>
                                                    <span></span>
                                                    Отобразить на странице Товары со скидкой до -50%
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" @if($product->show_in_new_page) checked @endif name="show_in_new_page"/>
                                                    <span></span>
                                                    Отобразить на странице Новинки
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" @if($product->show_in_popular) checked @endif name="show_in_popular"/>
                                                    <span></span>
                                                    Добавить в популярные
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" @if($product->show_in_discount) checked @endif name="show_in_discount"/>
                                                    <span></span>
                                                    Добавить в товары со скидкой
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" @if($product->show_in_new) checked @endif name="show_in_new"/>
                                                    <span></span>
                                                    Добавить в новинки
                                                </label>
                                            </div>
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
                        <div class="tab-pane fade" id="kt_tab_pane_4_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_2_4">
                            <div class="row">
                            @foreach($product->category->properties as $property)
                                    <div class="col-md-4 px-10">
                                        <div class="form-group row props-select" data-product-id="{{ $product->id }}" data-property-id="{{ $property->id }}">
                                            <label class="col-form-label text-right col-auto">{{$property->name}}</label>
                                            <div class="col">
                                            <select class="form-control select2 property_values" id="prop_{{$property->id}}" name="property[{{ $property->id }}]">
                                                <option value=""></option>
                                                @foreach($property->values as $value)
                                                    <option value="{{ $value->id }}" @if($product->values->contains(function($item, $ket) use ($value) { return $item->id === $value->id; })) selected @endif>{{ $value->value }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            </div>

                        </div>
                        <div class="tab-pane fade" id="banners" role="tabpanel"
                             aria-labelledby="kt_tab_pane_4_4">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Статьи</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createArticleModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>
                                        Добавить
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
                                            Изображение
                                        </th>
                                        <th class="text-center pr-0">
                                            Название
                                        </th>
                                        <th class="pr-0 text-center">
                                            Ссылка
                                        </th>
                                        <th class="pr-0 text-center">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="product_banners-table">
                                    @foreach($articles as $article)
                                        <tr data-id="{{ $article->id }}">
                                            <td class="handle text-center pl-0" style="cursor: pointer">
                                                <i class="flaticon2-sort"></i>
                                            </td>
                                            <td class="text-center position">
                                                <div class="mx-auto rounded-circle overflow-hidden" style="width: fit-content">
                                                    <img src="{{ $article->getImageSrcAttribute() }}" width="50" height="50" alt="">
                                                </div>
                                            </td>
                                            <td class="text-center position">
                                                <span class="text-dark-75 d-block font-size-lg sort_col">
                                                    <a href="{{$article->link}}">{{ $article->title }}</a>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg">
                                                    {{$article->link}}
                                                </span>
                                            </td>
                                            <td class="text-center pr-0">
                                                <form action="{{ route('admin.article.delete') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $article->id }}">
                                                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                            onclick="return confirm('Вы уверены, что хотите удалить ссылку на статью \'{{ $article->title }}\'?')"
                                                            title="Delete"><i class="las la-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
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

    @include('admin.products.modals.create-article')

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>

    <script>
        $('#kt_select2_4').select2();

        $(document).ready(function () {
            $('.select2.property_values').select2({
                placeholder: 'Выберете или добавьте значение',
                tags: true,
            }).on('select2:select', function (e) {
                let product_id = $(this).parents('div.props-select').data('product-id'),
                    data = e.params.data;

                console.log(data);

                if (!data.element) {
                    let property_id = $(this).parents('div.props-select').data('property-id')

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.property-values.store') }}',
                        data: {
                            property_id: property_id,
                            value: data.id
                        },
                        success: function (response) {
                            if (response) {
                                setPropertyValue(product_id, response.id)
                            }
                        }
                    })
                } else {
                    setPropertyValue(product_id, data.id)
                }
            });

            $('.props-select .select2-search__field').keyup(function (ev) {
                if(ev.key === 'Enter') {
                    console.log(this.value)
                }
            });
            let variations_select = $('#variations_select');
            variations_select.select2({
                allowClear: true,
                ajax: {
                    url: '{{route('getProductsByBaseValue')}}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'public',
                            property_id: this.data('property'),
                            product_id: this.data('product'),
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function (data) {
                        console.log(data)
                        data = data.map((x) => {
                            let title = x.title,
                                sub_title = ` (${x.value}`;
                            if (x.measure) {
                                sub_title += `${x.measure})`
                            } else {
                                sub_title += ')'
                            }

                            return {
                                text: title + sub_title,
                                id: x.id
                            }
                        })
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data
                        };
                    }
                },
                minimumInputLength: 1
            });



            $(document).on('change', '#category_select', function(e) {
                let category_id = this.value
                if (category_id) {
                    $.ajax({
                        url: '{{ route('admin.product.properties') }}',
                        dataType: 'json',
                        data: {
                            category_id: category_id
                        },
                        success: function (response) {
                            $('#base_property_select').html('').prop('disabled', false)
                            response.forEach(function (item, i) {
                                $('#base_property_select').append(`<option value="${item.id}">${item.name}</option>`)
                            })
                            $('#base_property_select').select2()
                        }
                    })
                }
            })

            $('#base_property_select_new').select2({
                minimumResultsForSearch: Infinity,
            })

        });
        // $('property_values').on('keyup', function() {
        //     console.log(this.value)
        // })
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
                $('.textEditor').summernote($.extend(summernoteDefaultOptions, {
                    height: 1000
                }));
                $('.summernote').summernote($.extend(summernoteDefaultOptions, {
                    height: 350
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

            var createImagePlugin = new KTImageInput('kt_image_1');
            var createPageImagePlugin = new KTImageInput('kt_image_1');
            var createArticleImage = new KTImageInput('createArticleImage');


            $('#product_banner_create_select').select2();

            let benners = document.getElementById('product_banners-table')
            new Sortable(benners, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    var list = [];
                    $.each($(benners).find('tr'), function (idx, el) {
                        list.push({
                            id: $(el).data('id'),
                            position: idx + 1
                        })
                    });

                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.article.sort') }}',
                        data: {
                            positions: list,
                        },
                    });

                }
            });

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


        function setPropertyValue(product_id, property_value_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.product-property-values.store') }}',
                data: {
                    product_id: product_id,
                    property_value_id: property_value_id
                },
                success: function (response) {
                    console.log('property saved successfully')
                }
            })
        }
    </script>

@endsection




