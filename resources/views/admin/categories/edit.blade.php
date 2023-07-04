@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Редактирование категории</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}" class="text-muted">Главная</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories') }}" class="text-muted">Категории</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.category.edit', $category->id) }}"
                           class="text-muted">{{ $category->name }}</a>
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
                                    <span class="nav-text">SEO</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
                                    <span class="nav-text">Характеристики</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_4">
                                    <span class="nav-text">Теги</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_1_4">
                            <form action="{{ route('admin.category.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Статус</label>
                                                        <select class="form-control status" id="kt_select2_1" name="status">
                                                            <option value="1">Активний</option>
                                                            <option value="0">Неактивний</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Alias</label>
                                                        <input type="text" name="alias" class="form-control" value="{{$category->alias}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Назва</label>
                                                        <input type="text" name="name" class="form-control" required value="{{$category->name}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label>Родительская категория</label>
                                                        <select class="form-control select2" id="cat_select" name="category_id">
                                                            <option></option>
                                                            @foreach($categories as $s_category)
                                                                <option value="{{ $s_category->id }}" @if($s_category->id === $category->category_id) selected @endif>{{ $s_category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="add_to_top_menu">Добавить к верхнему меню</label>
                                                        <div class="checkbox-list">
                                                            <label class="checkbox">
                                                                <input type="checkbox" name="add_to_top_menu" @if($category->status) checked @endif id="add_to_top_menu">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>ИЗОБРАЖЕНИЕ</label>
                                                <div class="col-auto ml-2">
                                                    <div class="image-input image-input-outline" id="createImagePlugin">
                                                        <div class="image-input-wrapper" id="updateImageBackground" style="background-image: url('{{ asset('images/uploads/categories/' . $category->image) }}')"></div>
                                                        <label
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="change" data-toggle="tooltip"
                                                            data-original-title="Change avatar">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="image" accept="image/*"/>
                                                            <input type="hidden" name="image_remove"/>
                                                        </label>
                                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
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
                        <div class="tab-pane fade show" id="kt_tab_pane_3_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_3_4">
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 text-center">
                                            #
                                        </th>
                                        <th class="pl-0 text-center">
                                            ID
                                        </th>
                                        <th class="pr-0 text-center">
                                            Позиция
                                        </th>
                                        <th class="text-center pr-0">
                                            Название
                                        </th>
                                        <th class="pr-0 text-center">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="properties-table">
                                    @foreach($properties as $property)
                                        <tr data-id="{{ $property->id }}">
                                            <td class="handle text-center pl-0" style="cursor: pointer">
                                                <i class="flaticon2-sort"></i>
                                            </td>
                                            <td class="text-center pl-0">
                                                {{ $property->id }}
                                            </td>
                                            <td class="text-center position">
                                        <span class="text-dark-75 d-block font-size-lg sort_col">
                                            {{ $property->position }}
                                        </span>
                                            </td>
                                            <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $property->name }}
                                        </span>
                                            </td>
                                            <td class="text-center pr-0">
                                                <a href="{{route('admin.properties.edit', $property->property->id)}}" class="btn btn-sm btn-clean btn-icon updateFaq">
                                                    <i class="las la-edit"></i>
                                                </a>
{{--                                                <form action="{{ route('admin.faq.delete') }}" method="POST">--}}
{{--                                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateFaq"--}}
{{--                                                       data-toggle="modal" data-target="#updateFaqModal"--}}
{{--                                                       data-id="{{ $property->id }}">--}}
{{--                                                        <i class="las la-edit"></i>--}}
{{--                                                    </a>--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <input type="hidden" name="id" value="{{ $property->id }}">--}}
{{--                                                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"--}}
{{--                                                            onclick="return confirm('Ви впевнені, що хочете видалити питання \'{{ $property->name }}\'?')"--}}
{{--                                                            title="Delete"><i class="las la-trash"></i>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                            {{ $properties->links('vendor.pagination.super_admin_pagination') }}
                        </div>
                        <div class="tab-pane fade show" id="kt_tab_pane_4_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_4_4">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Теги</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createTagModal"
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
                                            ID
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
                                    <tbody id="properties-table">
                                    @foreach($tags as $tag)
                                        <tr data-id="{{ $tag->id }}">
                                            <td class="text-center pl-0">
                                                {{ $tag->id }}
                                            </td>
                                            <td class="text-center position">
                                                <div class="mx-auto rounded-circle overflow-hidden" style="width: fit-content">
                                                    <img src="{{ $tag->getImageSrcAttribute() }}" width="50" height="50" alt="">
                                                </div>
                                            </td>
                                            <td class="text-center position">
                                                <span class="text-dark-75 d-block font-size-lg sort_col">
                                                    {{ $tag->name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg">
                                                    {{ $tag->link }}
                                                </span>
                                            </td>
                                            <td class="text-center pr-0">
                                                    <form action="{{ route('admin.tag.delete') }}" method="POST">
                                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateTag"
                                                           data-toggle="modal" data-target="#updateFaqModal"
                                                           data-id="{{ $tag->id }}">
                                                            <i class="las la-edit"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $tag->id }}">
                                                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                                onclick="return confirm('Ви впевнені, що хочете видалити питання \'{{ $tag->name }}\'?')"
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
                            {{ $tags->links('vendor.pagination.super_admin_pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->
    @include('admin.categories.modals.create-tag')
    @include('admin.categories.modals.update-tag')

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/file-upload/image-input.js') }} "></script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/category.js') }}"></script>

    <script>
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

            $(document).on('click', '.updateTag', loadTag);

            function loadTag() {
                let id = $(this).data('id');

                $.ajax({
                    url: '{{ route('admin.tag.show') }}',
                    data: {
                        'id': id
                    },
                    success: function (response) {
                        $('#updateTagId').val(id);

                        $(`#addToTop option[value="${response.add_to_top}"]`).attr('selected','selected');
                        $('#updateName').val(response.name);
                        $('#updateLink').val(response.link);
                        $('#imageWindow').css({
                            'background-image': 'url({{asset('/')}}images/uploads/tags/' +response.image_path + ')'
                        });

                        // document.getElementById('updateFaqIsActive').checked = (response.is_active == 1)

                        // $('#updateFaqAnswer').summernote('code', response.answer)
                    }, error: function (response) {
                        console.log(response)
                    }
                });
            }
        });
    </script>
@endsection




