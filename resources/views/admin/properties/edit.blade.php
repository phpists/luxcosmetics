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
                        <a href="#" class="text-muted">Редактирование характеристики</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.properties.edit', $property->id) }}"
                           class="text-muted">{{ $property->name }}</a>
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
                                    <span class="nav-text">Основное</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                    <span class="nav-text">Редактирование значений</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_1_4">
                            <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $property->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col col-md-10 px-0">
                                                    <div class="form-group w-100">
                                                        <label for="createFaqQuestion" class="col-auto col-form-label font-weight-bold">Название</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="updatePropertyName" name="name" value="{{$property->name}}" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col col-md-2 px-0">
                                                    <div class="form-group w-100">
                                                        <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Ед. измерения</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="updateMeasure" name="measure" value="{{$property->measure}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Категорії</label>
                                                        <select class="form-control select2" id="kt_select2_4"
                                                                name="category_id[]" required multiple>
                                                            @foreach($categories as $category)
                                                                <option @if(in_array($category->id, $property->category_idx())) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                                <input type="checkbox" @if($property->show_in_filter) checked @endif name="show_in_filter" id="updateShowInFilter">
                                                                <span></span>
                                                                Показать в фильтре
                                                            </label>
                                                            <label class="checkbox">
                                                                <input type="checkbox" @if($property->show_in_product) checked @endif name="show_in_product" id="updateShowInCatalog">
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
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Показывать текст</label>
                                                        <div class="radio-list">
                                                            <label class="radio">
                                                                <input type="radio" @if($property->show_text === \App\Models\Property::VERTICAL) checked @endif value="1" name="show_text"/>
                                                                <span></span>
                                                                Вертикально
                                                            </label>
                                                            <label class="radio">
                                                                <input type="radio" @if($property->show_text === \App\Models\Property::HORIZONTAL) checked @endif  value="2" name="show_text"/>
                                                                <span></span>
                                                                Горизонтально
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <label>Описание характеристик</label>
                                                <textarea class="textEditor" name="description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_2_4">
                            <div class="col-auto">
                                <a href="javascript:;" class="btn btn-primary"
                                   data-toggle="modal" data-target="#createPropertyValueModal">
                                    <i class="las la-plus me-2"></i>Добавить
                                </a>
                            </div>

                            <div class="row px-3 py-2 mt-5">
                                @foreach($property->values as $property_value)
                                    <div class="item col-md-4 px-6 py-3">
                                        <div class="row">
                                            <div class="col pr-0">
                                                <input readonly class="form-control form-control-sm w-100" type="text" name="value" value="{{ $property_value->value }}">
                                            </div>
                                            <div class="col-auto pl-2">
                                                <button type="button" class="btn btn-sm btn-icon btn-light-warning edit-property-value" data-id="{{ $property_value->id }}">
                                                    <i class="flaticon-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-icon btn-light-success save-property-value d-none" data-id="{{ $property_value->id }}">
                                                    <i class="flaticon2-checkmark"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-icon btn-light-danger drop-property-value" data-id="{{ $property_value->id }}">
                                                    <i class="flaticon-delete"></i>
                                                </button>
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
    <!--end::Container-->
    <!--end::Entry-->
    @include('admin.properties.modals.create_value')
    @include('admin.properties.modals.update_value')

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/category.js') }}"></script>

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





        $(document).on('click', '.edit-property-value', function() {
            let $edit_button = $(this),
                $save_button = $edit_button.next('.save-property-value');

            $edit_button.addClass('d-none');
            $save_button.removeClass('d-none');

            $edit_button.parents('div.item').find('input[name="value"]').attr('readonly', false)
        })


        $(document).on('click', '.save-property-value', function() {
            let $save_button = $(this),
                $edit_button = $save_button.prev('.edit-property-value');

            let id = $save_button.data('id'),
                value = $edit_button.parents('div.item').find('input[name="value"]').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('admin.property-values.update') }}',
                method: "POST",
                data: {
                    id: id,
                    value: value
                },
                success: function (data) {
                    $edit_button.removeClass('d-none');
                    $save_button.addClass('d-none');

                    $edit_button.parents('div.item').find('input[name="value"]').attr('readonly', true)
                },
            })
        })


        $(document).on('click', '.drop-property-value', function(e) {
            let button = this;

            if (!confirm('Вы уверены, что хотите удалить запись?')) return

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('admin.property-values.drop') }}',
                method: "POST",
                data: {
                    id: button.dataset.id
                },
                success: function (data) {
                    $(button).parents('div.item').remove()
                },
            })
        })
    </script>
@endsection




