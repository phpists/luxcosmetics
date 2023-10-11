@extends('admin.layouts.app')

@section('styles')
    <style>
        .tox-tinymce {
            height: 1500px !important;
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
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}" class="text-muted">Главная</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.news') }}" class="text-muted">Новости</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.news.edit', $item->id) }}"
                           class="text-muted">Редактирование новости</a>
                    </li>
                </ul>
                <!--end::Page Title-->
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
            @php
                $active_tab = session('active_tab_id');
                if (!$active_tab) {
                    $active_tab = 'main_tab';
                }
            @endphp
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link @if($active_tab === 'main_tab') active @endif" data-toggle="tab"
                                   href="#main_tab">
                                    <span class="nav-text">Редактировать</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($active_tab === 'seo_tab') active @endif" data-toggle="tab"
                                   href="#seo_tab">
                                    <span class="nav-text">Редактировать Seo</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($active_tab === 'micro_seo_tab') active @endif" data-toggle="tab"
                                   href="#micro_seo_tab">
                                    <span class="nav-text">Микро разметка SEO</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($active_tab === 'images_tab') active @endif" data-toggle="tab"
                                   href="#images_tab">
                                    <span class="nav-text">Изображения</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-toolbar">
                        <button type="submit" form="form1" style="margin-right: 20px" class="btn btn-primary">Сохранить</button>
                        <a href="{{route('news.post', $item->link)}}" class="btn btn-secondary">Посмотреть <i class="flaticon-eye"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade @if($active_tab === 'main_tab')show active @endif" id="main_tab"
                             role="tabpanel"
                             aria-labelledby="main_tab">
                            <form id="form1" action="{{ route('admin.news.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="form-group">
                                    <label>Изображения</label>
                                    <div class="col-auto ml-2">
                                        <div class="image-input image-input-outline" id="createImagePlugin"
                                             style="background-image: url('{{ $item->mainImage() }}')">
                                            <div class="image-input-wrapper" id="updateImageBackground"></div>
                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip"
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="image" accept="image/*"/>
                                                <input type="hidden" name="image_remove"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Название</label>
                                            <input type="text" name="title" class="form-control"
                                                   value="{{ $item->title }}" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleSelect2">Слаг</label>
                                            <input type="text" name="link" class="form-control"
                                                   value="{{ $item->link }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Статус</label>
                                            <select class="form-control status" id="kt_select2_1" name="status">
                                                <option value="1" @if($item->status == true) selected @endif>Активный
                                                </option>
                                                <option value="0" @if($item->status == false) selected @endif>
                                                    Неактивный
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Дата публикации</label>
                                            <div class="input-group date" id="kt_datetimepicker_1"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       placeholder="Дата публикации"
                                                       value="{{ date('Y-m-d H:i:s', strtotime($item->published_at)) }}"
                                                       name="published_at" required
                                                       data-target="#kt_datetimepicker_1"/>
                                                <div class="input-group-append" data-target="#kt_datetimepicker_1"
                                                     data-toggle="datetimepicker">
                                                        <span class="input-group-text">
                                                            <i class="ki ki-calendar"></i>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Тип слайдера</label>
                                            <select name="slider_type" id="" class="dropdown form-control">
                                                @foreach(\App\Models\NewsItem::getSliderTypes() as $slider_type)
                                                    <option @if($slider_type === $item->slider_type) selected @endif value="{{$slider_type}}">
                                                        {{\App\Services\SiteService::getNewsSliderType($slider_type)}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Текст</label>
                                        <div style="max-height: 400px; overflow-y: auto;">
                                            <textarea id="textEditor" name="text" required>{{ $item->text }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade @if($active_tab === 'micro_seo_tab')show active @endif"
                             id="micro_seo_tab" role="tabpanel" aria-labelledby="micro_seo_tab">
                            <form action="{{route('admin.news.update.micro-seo')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta:og Title</label>
                                            <input type="text" name="og_title_meta" class="form-control"
                                                   value="{{ $seo->og_title_meta ?? '' }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta:og Description</label>
                                            <textarea class="form-control" id="meta_description"
                                                      name="og_description_meta">{{ $seo->og_description_meta ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade @if($active_tab === 'seo_tab')show active @endif" id="seo_tab"
                             role="tabpanel" aria-labelledby="seo_tab">
                            <form action="{{route('admin.news.update.seo')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta title</label>
                                            <input type="text" name="meta_title" class="form-control"
                                                   value="{{ $seo->title ?? '' }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta description</label>
                                            <textarea class="form-control" id="meta_description"
                                                      name="description_meta">{{ $seo->description_meta ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta keywords</label>
                                            <textarea class="form-control" id="meta_keywords"
                                                      name="keywords_meta">{{ $seo->keywords_meta ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade @if($active_tab === 'images_tab')show active @endif" id="images_tab"
                             role="tabpanel" aria-labelledby="images_tab">
                            <div class="row justify-content-end mb-4">
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createNewsImageModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>
                                        Добавить
                                    </button>
                                </div>
                            </div>
                            <table class="table table-head-custom table-vertical-center">
                                <thead>
                                <tr>
                                    <th class="pl-0 text-center">
                                        #
                                    </th>
                                    <th class="pr-0 text-center">
                                        Позиция
                                    </th>
                                    <th class="pr-0 text-center">
                                        Изображение
                                    </th>
                                    <th class="pr-0 text-center">
                                        Действия
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="image_table">
                                @foreach($item->images->sortBy('position') as $image)
                                    <tr class="image_draggable" id="post_{{$image->id}}" data-id="{{ $image->id }}">
                                        <td class="handle text-center pl-0" style="cursor: pointer">
                                            <i class="flaticon2-sort"></i>
                                        </td>
                                        <td class="text-center pr-0 position_label">
                                            {{ $image->position }}
                                        </td>
                                        <td class="text-center pr-0">
                                            <img src="{{ $image->getImageSrcAttribute() }}" width="100" height="100">
                                        </td>
                                        <td class="text-center pr-0">
                                            <form action="{{route('admin.news.image.delete')}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="id" value="{{$image->id}}">
                                                <button
                                                   class="btn btn-sm btn-clean btn-icon"
                                                   onclick="return confirm('Вы уверенны, что хотите удалить данную запись?')">
                                                    <i class="las la-trash"></i>
                                                </button>
                                            </form>
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
        @include('admin.news.modals.create_image')
        <!--end::Container-->
    </div>

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>

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

        CKEDITOR.replace( 'textEditor' );


        // Initialization
        // jQuery(document).ready(function() {
        //     KTCkeditor.init();
        // });

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var createImagePlugin = new KTImageInput('createImagePlugin');newsImageContainer
            var createPageImagePlugin = new KTImageInput('createPageImagePlugin');
            var newsImageContainer = new KTImageInput('newsImageContainer');
            let image_table = document.getElementById('image_table');
            function updateImagesPos() {
                let data = [];
                image_table.querySelectorAll('.image_draggable').forEach((el) => {
                    data.push(el.dataset.id);
                })
                $.ajax({
                    url: '/admin/news/images/update-positions',
                    data: {
                        images_positions: data
                    },
                    method: 'PUT',
                    success: () => {
                        image_table.querySelectorAll('.image_draggable .position_label').forEach((el, idx) => {
                            el.innerText = idx + 1;
                        })
                    }
                })
            }
            new Sortable(image_table, {
                animation: 150,
                draggable: '.image_draggable',
                onEnd: updateImagesPos
            });
        });
    </script>

@endsection
