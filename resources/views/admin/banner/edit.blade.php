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
                <h5 class="text-dark font-weight-bold my-1 mr-5">Редактирования новость</h5>
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
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                    <span class="nav-text">Редактировать</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_8">
                                    <span class="nav-text">Изображения</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">
                        <button type="submit" form="form1" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_1_4">
                            <form id="form1" action="{{ route('admin.banner.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleSelect2">Название</label>
                                                <input type="text" name="title" class="form-control" value="{{ $item->title }}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleSelect2">Ссылка</label>
                                                <input type="text" name="link" class="form-control" value="{{ $item->link }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Статус</label>
                                                <select class="form-control status" id="kt_select2_1" name="status">
                                                    <option value="1" @if($item->status == true) selected @endif>Активный</option>
                                                    <option value="0" @if($item->status == false) selected @endif>Неактивный</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Позиция баннера</label>
                                                <select class="form-control status" name="position">
                                                    <option value="first" {{ $item->position === 'first' ? 'selected' : '' }}>Первая позиция</option>
                                                    <option value="second" {{ $item->position === 'second' ? 'selected' : '' }}>Вторая позиция</option>
                                                    <option value="third" {{ $item->position === 'third' ? 'selected' : '' }}>Третяя позиция</option>
                                                    <option value="fourth" {{ $item->position === 'fourth' ? 'selected' : '' }}>Четвертая позиция</option>
                                                    <option value="fifth" {{ $item->position === 'fifth' ? 'selected' : '' }}>Пятая позиция</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Дата публикации</label>
                                                <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" placeholder="Дата публикации"
                                                           value="{{ date('Y-m-d H:i:s', strtotime($item->published_at)) }}" name="published_at" required
                                                           data-target="#kt_datetimepicker_1"/>
                                                    <div class="input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                                                        <span class="input-group-text">
                                                            <i class="ki ki-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
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
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_2_8" role="tabpanel"
                                    aria-labelledby="kt_tab_pane_2_8">
                                    <div class="form-group">
                                        <label>Изображения</label>
                                        <div class="col-auto ml-2">
                                            <div class="image-input image-input-outline" id="createImagePlugin" style="background-image: url('{{ asset('uploads/banner/' . $item->image) }}')">
                                                <div class="image-input-wrapper" id="updateImageBackground"></div>
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="image" accept="image/*"/>
                                                    <input type="hidden" name="image_remove"/>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

        var KTSummernote = function () {
            // Private functions
            var demos = function () {
                $('#textEditor').summernote($.extend(summernoteDefaultOptions, {
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
