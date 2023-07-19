@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">FAQ</h5>
@endsection
@section('content')


    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body pb-3">
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <div class="mb-7">--}}
{{--                                <form method="GET">--}}
{{--                                    <div class="input-icon">--}}
{{--                                        <input id="search_input" type="text" name="search"--}}
{{--                                               data-type="{{ request()->get('type') }}"--}}
{{--                                               class="form-control form-control-solid"--}}
{{--                                               placeholder="Поиск" value="{{ request()->input('search') }}"/>--}}
{{--                                        <span><i class="flaticon2-search-1 text-muted"></i></span>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <button data-toggle="modal" data-target="#createFaqModal" class="btn btn-primary font-weight-bold">--}}
{{--                                <i class="fas fa-plus mr-2"></i>Добавить--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <form action="{{ route('admin.main-block.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf

                        <input type="hidden" id="updateBlockId" name="id" value="{{$block->id}}">

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Изображение</label>
                                        <div class="col-auto px-0">
                                            <div class="image-input  image-input-outline" id="updateImagePlugin"
                                                 style="max-height: 700px; background-image: url({{$block->getImageSrcAttribute()}})">
                                                <div class="image-input-wrapper" id="updateImageBackground"></div>
                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip"
                                                    data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="image_path" accept="image/*"/>
                                                    <input type="hidden" name="image_remove"/>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="updateFaqQuestion" class="col-form-label font-weight-bold">Заголовок</label>
                                        <input type="text" value="{{$block->title}}" class="form-control" id="updateBlockTitle" name="title" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="updateBlockVideo" class="col-form-label font-weight-bold">Видео</label>
                                            <input type="file" name="video_path" class="form-control" id="updateBlockVideo"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-0">
                                    <label class="col-auto col-form-label" for="updateBlockContent">Текст</label>
                                </div>
                                <div class="col-12">
                                    <textarea name="content" class="summernote" id="updateBlockContent">{{$block->content}}</textarea>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                                Закрыть
                            </button>
                            <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                        </div>

                    </form>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->

    @include('admin.main_block.modals.update')
@endsection

@section('js_after')
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
            var createImagePlugin = new KTImageInput('updateImagePlugin');
            var createPageImagePlugin = new KTImageInput('updatePageImagePlugin');
        });

        {{--$(document).on('change', '.active_switch', function(e) {--}}
        {{--    let switch_input = this,--}}
        {{--        status = switch_input.checked;--}}

        {{--    let data = {--}}
        {{--        id: switch_input.dataset.id,--}}
        {{--    }--}}

        {{--    if (status) {--}}
        {{--        data.is_active = true--}}
        {{--    }--}}

        {{--    $.ajax({--}}
        {{--        url: '{{ route('admin.faq.update') }}',--}}
        {{--        method: "POST",--}}
        {{--        data: data,--}}
        {{--        success: function (data) {--}}
        {{--            switch_input.checked = status--}}
        {{--        },--}}
        {{--        error: function () {--}}
        {{--            switch_input.checked = !status--}}
        {{--        }--}}
        {{--    })--}}

        {{--})--}}
    </script>
@endsection

