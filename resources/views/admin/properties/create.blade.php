@extends('admin.layouts.app')
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
                        <a href="{{ route('admin.properties.index') }}" class="text-muted">Характеристики</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.properties.create') }}"
                           class="text-muted">Создание характеристики</a>
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
                            <form action="{{ route('admin.properties.store') }}" method="POST">
                                @csrf
                                @method('post')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col col-md-10 px-0">
                                                    <div class="form-group w-100">
                                                        <label for="createFaqQuestion" class="col-auto col-form-label font-weight-bold">Название</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="updatePropertyName" name="name" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col col-md-2 px-0">
                                                    <div class="form-group w-100">
                                                        <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Ед. измерения</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="updateMeasure" name="measure">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Категории</label>
                                                        <select class="form-control select2" id="cat_select"
                                                                name="category_id[]" required multiple>
                                                            <option class="select_all" value="0">Выбрать все</option>
                                                        @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="show_in_filter" id="updateShowInFilter">
                                                                <span></span>
                                                                Показать в фильтре
                                                            </label>
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="show_in_product" id="updateShowInCatalog">
                                                                <span></span>
                                                                Показать в товаре
                                                            </label>
                                                        </div>
{{--                                                        <label for="add_to_top_menu">Добавить к фильтру</label>--}}
{{--                                                        <div class="checkbox-list">--}}
{{--                                                            <label class="checkbox">--}}
{{--                                                                <input type="checkbox" @if($property->show_in_filter) checked @endif name="show_in_filter" id="updateShowInFilter">--}}
{{--                                                                <span></span>--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label>Показывать текст</label>
                                                    <div class="radio-list">
                                                        <label class="radio">
                                                            <input type="radio" value="1" checked name="show_text"/>
                                                            <span></span>
                                                            Вертикально
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" value="2" name="show_text"/>
                                                            <span></span>
                                                            Горизонтально
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <label>Описание характеристики</label>
                                                <textarea id="createPropertyDescription" name="description"></textarea>
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
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>

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

        var KTSummernote = function () {
            // Private functions
            var demos = function () {
                $('.textEditor').summernote($.extend(summernoteDefaultOptions, {
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
        $('#cat_select').select2({
            placeholder: "Выберите категорию",
            allowClear: true
        });
        $("#cat_select").on('select2:select', function() {
            if($('#cat_select option:selected').hasClass('select_all')){
                $("#cat_select > option").prop("selected", "selected");
                $("#cat_select > option.select_all").prop('selected', false);
                $("#cat_select").trigger("change");
            } else {
                $("#cat_select > option").removeAttr("selected");
                $("#cat_select").trigger("change");
            }
        });
        $(function () {
            CKEDITOR.replace( 'createPropertyDescription' );

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




