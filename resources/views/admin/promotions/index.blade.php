@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Акции</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection

@section('styles')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
@endsection

@section('content')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>

    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">

            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-body">
                    <div class="row justify-content-end">
                        <a href="{{ route('promotions.index') }}" class="btn btn-secondary" target="_blank">
                            <i class="las la-eye"></i>
                            Акции
                        </a>
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROMOTIONS_CREATE))
                            <button data-toggle="modal" data-target="#createPromotionModal"
                                    class="btn btn-success font-weight-bolder mx-5">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Создать акцию
                            </button>
                        @endif
                    </div>
                    <hr class="my-8">
                    <div id="content">
                        @include('admin.promotions._table')
                    </div>

                    @include('admin.promotions.modals.create')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/filepond/filepond-plugin-image-preview.js') }}"></script>
    <script src="{{ asset('super_admin/js/filepond/filepond.js') }}"></script>
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
    <script>
        let arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }

        FilePond.registerPlugin(FilePondPluginImagePreview);

        let filePonds = {};

        setInterval(() => {
            $('.filepond-container:not(.initialized)').each(function (i, el) {
                let input = $(el).find('input:file')[0],
                    options = {
                        storeAsFile: true,
                        required: input.required,
                    };


                console.log(input, input.id)
                filePonds[input.id] = FilePond.create(input, options);
                el.classList.add('initialized')
            })
        });

        CKEDITOR.stylesSet.add('promotions', [
            {
                name: 'Зеленый',
                element: 'p',
                attributes: {
                    class: 'green'
                }
            },
            {
                name: 'Синий',
                element: 'p',
                attributes: {
                    class: 'blue'
                }
            },
            {
                name: 'Красный',
                element: 'p',
                attributes: {
                    class: 'red'
                }
            },
        ])
        CKEDITOR.config.stylesSet = 'promotions'

        $(function () {
            $(document).on('change', '.active_switch', function (e) {
                let switch_input = this,
                    status = switch_input.checked;

                $.ajax({
                    url: switch_input.dataset.url,
                    method: "POST",
                    data: {
                        is_active: status
                    },
                    success: function (data) {
                        switch_input.checked = status
                    },
                    error: function () {
                        switch_input.checked = !status
                    }
                })

            })

            CKEDITOR.replace( 'promotionShortContent' );
        })
    </script>
@endsection


