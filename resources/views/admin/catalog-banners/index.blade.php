@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Баннеры каталога</h5>
@endsection

@section('styles')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
@endsection

@section('content')

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">

            @include('admin.layouts.includes.messages')

            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Баннеры каталога</h3>
                    </div>
                    @if(auth()->user()->isSuperAdmin()|| auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_CREATE))
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button data-toggle="modal" data-target="#createModal"
                                    class="btn btn-primary font-weight-bold create-banner">
                                <i class="fas fa-plus mr-2"></i>Создать
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-body pb-3">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center">
                            <thead>
                            <tr>
                                <th class="pl-0 text-center">
                                    #
                                </th>
                                <th class="text-center pr-0">
                                    Название
                                </th>
                                <th class="text-center pr-0">
                                    Тип
                                </th>
                                <th class="pr-0 text-center">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($catalogBanners as $catalogBanner)
                                <tr id="gift_card_{{ $catalogBanner->id }}" data-id="{{ $catalogBanner->id }}">
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $catalogBanner->id }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $catalogBanner->title }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $catalogBanner->type_title }}
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        @if(auth()->user()->isSuperAdmin()|| auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_EDIT))
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon edit-banner"
                                           data-toggle="modal" data-target="#editModal" data-id="{{ $catalogBanner->id }}"
                                           data-show-url="{{ route('admin.catalog-banners.show', $catalogBanner) }}"
                                           data-update-url="{{ route('admin.catalog-banners.update', $catalogBanner) }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        @endif
                                            @if(auth()->user()->isSuperAdmin()|| auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_DELETE))
                                        <form action="{{ route('admin.catalog-banners.destroy', $catalogBanner) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                    onclick="return confirm('Вы уверенны?')"
                                                    title="Delete"><i class="las la-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $catalogBanners->links('vendor.pagination.super_admin_pagination') }}
                    <!--end::Table-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->


    @include('admin.catalog-banners.modals.create')
    @include('admin.catalog-banners.modals.edit')
@endsection

@section('js_after')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>

        $(function () {
            FilePond.registerPlugin(FilePondPluginImagePreview);


            setInterval(() => {
                $('.filepond-container:not(.initialized)').each(function(i, el) {
                    let input = $(el).find('input:file')[0],
                        imgSrc = input.dataset.img,
                        options = {
                            storeAsFile: true,
                            required: input.required,
                        };

                    if (imgSrc) {
                        options.files = [
                            {
                                source: imgSrc,
                                options: {
                                    type: 'local'
                                },
                            }
                        ]
                        options.server = {
                            load: (uniqueFileId, load, error, progress, abort, headers) => {
                                fetch(imgSrc).then((res) => {
                                    return res.blob();
                                }).then(load);
                            }
                        }
                    }

                    FilePond.create(input, options);
                    el.classList.add('initialized')
                })
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('change', '[name="type"]', function (e) {
                const $form = $(this).parents('form:first'),
                    loadUrl = $(this).find('option:selected').data('load-url');

                $form.find('div.type-container').load(loadUrl)
            })

            $(document).on('click', '.edit-banner', function () {
                const $modal = $('#editModal'),
                    id = this.dataset.id;

                $modal.find('#editType option').each(function (i, el) {
                    el.dataset.loadUrl = el.dataset.loadUrl + '?id=' + id + "&selector=editModal";
                });
                $modal.find('form').attr('action', this.dataset.updateUrl)

                $.ajax({
                    url: $(this).data('show-url'),
                    dataType: 'json',
                    success: function (item) {
                        $modal.find('#editTitle').val(item.title);
                        $modal.find('#editType').val(item.type).trigger('change');
                    }
                });
            })

        })


        $(document).on('click', '.btn-show', loadModel);

        function loadModel() {
            $.ajax({
                url: $(this).data('url'),
                dataType: 'json',
                success: function (item) {
                    $('#showCode').val(item.code);
                    $('#showType').val(item.type);
                    if (item.category_id)
                        $('#showCategory').val(item.category_id).parents('div.column:first').show();
                    if (item.product_id)
                        $('#showProduct').val(item.product_id).parents('div.column:first').show();
                    $('#showAmount').val(item.amount);
                    $('#showPercent').val(item.percent);
                    $('#showQuantity').val(item.quantity);
                    $('#showStarts').val(item.starts_at);
                    $('#showEnds').val(item.ends_at);

                    if (Object.keys(item.orders).length > 0) {
                        let uses = [];
                        for (const key in item.orders) {
                            uses.push(`<a href="${item.orders[key]}" target="_blank">${key}</a>`)
                        }
                        $('#showPromoCodeUses').html(uses.join('<br>'))
                    } else {
                        $('#showPromoCodeUses').html('<h6>Не было использований</h6>')
                    }
                }
            });
        }

    </script>
@endsection

