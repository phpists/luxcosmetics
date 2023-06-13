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
                        <a href="{{ route('admin.properties.index') }}" class="text-muted">Характеристики</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.properties.edit', $property->id) }}"
                           class="text-muted">{{ $property->title }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Редактирование</a>
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
                                    <span class="nav-text">Редактирование</span>
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
                                                                Добавить к фильтру
                                                            </label>
                                                            <label class="checkbox">
                                                                <input type="checkbox" @if($property->show_in_catalog) checked @endif name="show_in_catalog" id="updateShowInCatalog">
                                                                <span></span>
                                                                Добавить к каталогу
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
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <label>Описание товара</label>
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
    <!--end::Container-->
    <!--end::Entry-->
{{--    @include('admin.categories.modals.create')--}}
{{--    @include('admin.categories.modals.update')--}}

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="https://cdn.tiny.cloud/1/3h27q9hxq81txaaz86zvgxqs5cuixqt8167b543rwzusizui/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
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

        tinymce.init({
            selector: '.textEditor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            language: 'uk',
            height: "1000"
        });
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

            var createImagePlugin = new KTImageInput('createImagePlugin');
            var createPageImagePlugin = new KTImageInput('createPageImagePlugin');
        });
    </script>
@endsection




