@extends('admin.layouts.app')
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
                        <a href="{{ route('admin.categories') }}" class="text-muted">Категорії</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.category.show', $category->id) }}"
                           class="text-muted">{{ $category->title }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Редагування</a>
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
                                    <span class="nav-text">Редагування</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                    <span class="nav-text">Редагування SEO</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_1_4">
                            <form action="{{ route('admin.category.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Статус</label>
                                            <select class="form-control status" id="kt_select2_1" name="status">
                                                <option value="1" @if($category->status == true) selected @endif>
                                                    Активний
                                                </option>
                                                <option value="0" @if($category->status == false) selected @endif>
                                                    Неактивний
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Alias</label>
                                            <input type="text" name="alias" class="form-control"
                                                   value="{{ $category->alias }}"/>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Ref Key</label>
                                            <input type="text" name="key" readonly class="form-control"
                                                   value="{{ $category->key }}" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Назва</label>
                                            <input type="text" name="name" class="form-control"
                                                   value="{{ $category->title }}" required/>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Це аксесуар</label>
                                            <div class="checkbox-list">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="is_accessories"
                                                           @if($category->is_accessories == true) checked @endif/>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Підкатегорії</label>
                                            <select class="form-control select2" id="kt_select2_3"
                                                    name="child_categories[]" multiple="multiple">
                                                @foreach($categories as $item)
                                                    <option value="{{ $item->id }}"
                                                            @if($item->isChild($category->id)) selected @endif>{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @if($category->key == \App\Models\Category::ACCESSORIES || $category->key == \App\Models\Category::NOVELTY || $category->key == \App\Models\Category::COLLECTIONS)
                                    <div class="row">
                                        @php
                                            $products = \App\Models\Product::get()->pluck('code', 'id');
                                        @endphp
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Товари</label>
                                                <select class="form-control select2" id="kt_select2_4"
                                                        name="category_products[]" multiple="multiple">
                                                    @foreach($products as $product_id => $code)
                                                        <option @if($category->isCategoryProduct($product_id)) selected
                                                                @endif value="{{ $product_id }}">{{ $code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Google Product Category</label>
                                            <input type="text" name="google_product_category" class="form-control"
                                                   value="{{ $category->google_product_category }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Adwords Grouping</label>
                                            <input type="text" name="adwords_grouping" class="form-control"
                                                   value="{{ $category->adwords_grouping }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Custom Label 0</label>
                                            <input type="text" name="custom_label_0" class="form-control"
                                                   value="{{ $category->custom_label_0 }}"/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Цена</label>
                                            <input type="number" name="price" class="form-control" step="any"
                                                   value="{{ $category->price }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea class="form-control" id="description"
                                                      name="description"
                                                      required>{{ $category->description }}
                                                </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Текст</label>
                                            <textarea class="form-control" id="text"
                                                      name="text"
                                                      required>{{ $category->text }}
                                                </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Зберегти</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_2_4">
{{--                            <form action="{{ route('admin.category.update.seo') }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="category_id" value="{{ $category->id }}">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>H1</label>--}}
{{--                                            <input type="text" name="h1" class="form-control"--}}
{{--                                                   value="{{ $seo->h1 ?? '' }}"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta title</label>--}}
{{--                                            <input type="text" name="meta_title" class="form-control"--}}
{{--                                                   value="{{ $seo->meta_title ?? '' }}"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta robots</label>--}}
{{--                                            <input type="text" name="meta_robots" class="form-control"--}}
{{--                                                   value="{{ $seo->meta_robots ?? '' }}"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta description</label>--}}
{{--                                            <textarea class="form-control" id="meta_description"--}}
{{--                                                      name="meta_description">{{ $seo->meta_description ?? '' }}</textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta keywords</label>--}}
{{--                                            <textarea class="form-control" id="meta_keywords"--}}
{{--                                                      name="meta_keywords">{{ $seo->meta_keywords ?? '' }}</textarea>--}}

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
    <!--end::Container-->
    <!--end::Entry-->
    @include('admin.categories.modals.create')
    @include('admin.categories.modals.update')

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/file-upload/image-input.js') }} "></script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/category.js') }}"></script>

    <script>
        $(document).ready(function () {
            ClassicEditor
                .create(document.querySelector('#description'))
                .then(editor => {
                    paymentDescriptionEditor = editor;
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#text'))
                .then(editor => {
                    paymentDescriptionEditor = editor;
                })
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script>
        var KTSummernoteDemo = function () {
            // Private functions
            var demos = function () {
                $('.summernote').summernote($.extend(summernoteDefaultOptions, {
                    height: 450
                }));
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            KTSummernoteDemo.init();

            let tbody = document.querySelector('tbody#faqs_table')
            new Sortable(tbody, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    var list = [];
                    $.each($('tbody#faqs_table tr'), function (idx, el) {
                        list.push({
                            id: $(el).data('id'),
                            pos: idx + 1
                        })
                    });

                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.category.faq.update_positions') }}',
                        data: {
                            positions: list,
                        },
                        success: function (response) {
                            $.each(response, function(i, item) {
                                $(`tr[data-id="${i}"]`).find('.position').text(item)
                            })
                        }
                    });

                }
            });
        });


        $(document).on('click', '.updateFaq', loadFaq);

        function loadFaq() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.category.faq.show') }}',
                data: {
                    'id': id
                },
                success: function (response) {
                    $('#updateFaqId').val(id);

                    $('#updateFaqQuestion').val(response.question);
                    $('#updateFaqPos').val(response.pos);

                    document.getElementById('updateFaqIsActive').checked = (response.is_active == 1)

                    $('#updateFaqAnswer').summernote('code', response.answer)
                }, error: function (response) {
                    console.log(response)
                }
            });
        }

        $(document).on('change', '.active_switch', function(e) {
            let switch_input = this,
                status = switch_input.checked;

            let data = {
                id: switch_input.dataset.id,
            }



            data.is_active = !!status;

            $.ajax({
                url: '{{ route('admin.category.faq.update_status') }}',
                method: "POST",
                data: data,
                success: function (data) {
                    switch_input.checked = status
                },
                error: function () {
                    console.log("error")
                    switch_input.checked = !status
                }
            })

        })

        $(document).on('keyup', '#search_input', function (e) {
            let q = $(this).val()
            let category_id = $("#category_id").val()

            $.ajax({
                url: '{{ route('admin.category.faq.search') }}',
                data: {
                    'search': q,
                    'category_id': category_id
                },
                success: function (response) {
                    $('#table_data').html(response)
                }, error: function (response) {
                    console.log(response)
                }
            });
        })
    </script>
@endsection




