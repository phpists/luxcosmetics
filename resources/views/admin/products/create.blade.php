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
                <h5 class="text-dark font-weight-bold my-1 mr-5">Создание товара</h5>
                <!--end::Page Title-->
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
                                    <span class="nav-text">Создать</span>
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
                            <form id="blog_post" action="{{ route('admin.products.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Название</label>
                                            <input type="text" name="title" class="form-control" required/>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Категории</label>
                                                    <select class="form-control select2" id="category_select"
                                                            name="category_id" required>
                                                        <option value=""></option>
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="variations_container">
                                                    <label>Главная характеристика</label>
                                                    <select class="form-control select2" id="base_property_select_new"
                                                            name="base_property_id" required>
                                                        @foreach(\App\Models\Product::ALL_TYPES as $id => $name)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Другие категории</label>
                                                    <select class="form-control select2" id="product_categories" multiple="multiple"
                                                            name="product_categories[]">
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
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
                                                <label for="exampleSelect2">Цена</label>
                                                <input type="number" step="any" name="price" class="form-control"
                                                       required/>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="exampleSelect2">Старая цена</label>
                                                <input type="number" step="any" name="old_price" class="form-control"/>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="exampleSelect2">Скидка в %</label>
                                                <input type="number" step="any" name="discount" class="form-control"/>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Размер</label>
                                                <input type="text" name="size" required class="form-control"/>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Бонусные баллы</label>
                                                <input type="number" step="1" min="0" value="0" name="points" required class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Изображение</label>
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
                                            <select class="form-control status" name="availability">
                                                @foreach(array_column(\App\Enums\AvailableOptions::cases(), 'value') as $value)
                                                    <option
                                                        value="{{$value}}">{{\App\Services\SiteService::getProductStatus($value)}}</option>
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="show_in_sales_page"/>
                                                    <span></span>
                                                    Отобразить на странице акции
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="show_in_percent_discount_page"/>
                                                    <span></span>
                                                    Отобразить на странице Товары со скидкой до -50%
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="show_in_new_page"/>
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
                                                    <input type="checkbox" name="show_in_popular"/>
                                                    <span></span>
                                                    Добавить в популярные
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="show_in_discount"/>
                                                    <span></span>
                                                    Добавить в товары со скидкой
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="show_in_new"/>
                                                    <span></span>
                                                    Добавить в новинки
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-5">
                                        <label>Описание товара</label>
                                        <textarea class="textEditor" name="description_1"></textarea>
                                    </div>
                                    <div class="col-12 mb-5">
                                        <div class="form-group">
                                            <label>Как использовать</label>
                                            <textarea class="textEditor form-control" name="description_2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-5">
                                        <label>Доп. описание</label>
                                        <textarea class="textEditor" name="description_3"></textarea>
                                    </div>
                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
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
                            {{--                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>--}}
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
    <script>
        $('#category_select').select2({
            placeholder: "Выбрать...",
        });

        $('#product_categories').select2({
            placeholder: 'Другие категории',
            allowClear: true
        });


        $(document).ready(function () {
            let variations_select = $('#variations_select');
            variations_select.select2({
                allowClear: true,
                ajax: {
                    url: '{{route('search_products')}}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'public'
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function (data) {
                        data = data.map((x) => {
                            return {
                                text: x.title, id: x.id
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


            $(document).on('change', '#category_select', function (e) {
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

        })
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
                    height: 450
                }));
            }

            return {
                // public functions
                init: function () {
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
        });
    </script>

@endsection




