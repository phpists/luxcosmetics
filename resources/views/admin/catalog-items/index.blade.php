@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Главный каталог</h5>
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
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_ITEMS_CREATE))
                            <button data-toggle="modal" data-target="#createCatalogItemModal"
                                    class="btn btn-success font-weight-bolder mx-5">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Добавить элемент
                            </button>
                        @endif
                    </div>
                    <hr class="my-8">
                    <div id="content">
                        @include('admin.catalog-items._table')
                    </div>

                    @include('admin.catalog-items._create')
                    @include('admin.catalog-items._edit')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/filepond/filepond-plugin-image-preview.js') }}"></script>
    <script src="{{ asset('super_admin/js/filepond/filepond.js') }}"></script>
    <script src="{{ asset('super_admin/js/Sortable.js') }}"></script>
    <script>
        let arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }

        FilePond.registerPlugin(FilePondPluginImagePreview);

        let filePonds = {},
            formRepeaters = {};

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

            $($('.catalogItemLinks:not(.initialized)')).each(function (i, el) {
                formRepeaters[el.id] = $(el).repeater({
                    initEmpty: false,
                    isFirstItemUndeletable: true,
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });

                el.classList.add('initialized')
            })
        });

        $(function () {

            $(document).on('click', '.btn_edit', function (e) {
                let showUrl = $(this).data('show-url'),
                    updateUrl = $(this).data('update-url');

                $.ajax({
                    url: showUrl,
                    dataType: 'json',
                    success: function (response) {
                        let catalogItem = response.data;

                        $('#editCatalogItemForm').attr('action', updateUrl);

                        $('#editCatalogItemTitle').val(catalogItem.title)
                        $('#editCatalogItemIsActive').attr('checked', catalogItem.is_active === 1)

                        filePonds['editCatalogItemImg'].addFile(catalogItem.img_src);

                        if (Array.isArray(catalogItem.links))
                            formRepeaters['editCatalogItemLinks'].setList(catalogItem.links)
                    }, error: function (response) {
                        console.log(response)
                    }
                });
            });

            $(document).on('change', '.active_switch', function (e) {
                let switch_input = this,
                    status = switch_input.checked;

                let data = {
                    id: switch_input.dataset.id,
                }

                if (status) {
                    data.is_active = true
                }

                $.ajax({
                    url: '{{ route('admin.catalog-items.update-status') }}',
                    method: "POST",
                    data: data,
                    success: function (data) {
                        switch_input.checked = status
                    },
                    error: function () {
                        switch_input.checked = !status
                    }
                })

            })

            let tbody = document.querySelector('#catalogItemsTable tbody')
            new Sortable(tbody, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    var list = [];
                    $.each($('#catalogItemsTable tbody tr'), function (idx, el) {
                        list.push({
                            id: $(el).data('id'),
                            position: idx + 1
                        })
                    });

                    $.ajax({
                        method: 'post',
                        url: $(tbody).data('update-positions-url'),
                        data: {
                            positions: list,
                        },
                        success: function (response) {
                        }
                    });

                }
            });

        })
    </script>
@endsection


