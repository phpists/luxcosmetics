@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Способі доставки</h5>
                <!--end::Page Title-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                @include('admin.layouts.includes.messages')
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Способы доставки</h3>
                        </div>
                        <div class="card-toolbar">
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::DELIVERY_METHODS_EDIT))
                            <div class="dropdown dropdown-inline mr-2">
                                <button class="btn btn-danger font-weight-bolder activePost" data-status="0" data-url="{{ route('admin.delivery-methods.bulk-change-status') }}">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-toggle-off"></i></span>Деактивировать
                                </button>
                            </div>
                            <div class="dropdown dropdown-inline mr-2">
                                <button class="btn btn-success font-weight-bolder activePost" data-status="1" data-url="{{ route('admin.delivery-methods.bulk-change-status') }}">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-toggle-on"></i>
                                    </span>Активировать
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-head-custom table-vertical-center">
                                <thead>
                                <tr>
                                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::DELIVERY_METHODS_EDIT))
                                    <th class="pl-0 text-center">
                                    <span style="width: 20px;">
                                        <label class="checkbox checkbox-single checkbox-all">
                                            <input id="checkbox-all" type="checkbox"
                                                   name="checkbox[]">&nbsp;<span></span>
                                        </label>
                                    </span>
                                    </th>
                                    <th class="pl-0 text-center">
                                        #
                                    </th>
                                    @endif
                                    <th class="pr-0 text-center">
                                        ID
                                    </th>
                                    <th class="pr-0 text-center">
                                        Название
                                    </th>
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::DELIVERY_METHODS_EDIT))
                                    <th class="pr-0 text-center">
                                        Статус
                                    </th>
                                        @endif
                                </tr>
                                </thead>
                                <tbody id="table" class="banner-table" data-update-positions-url="{{ route('admin.delivery-methods.update-positions') }}">
                                    @foreach($delivery_methods as $item)
                                    <tr id="delivery-method_{{$item->id}}" data-id="{{ $item->id }}" data-label="{{ $item->pos }}">
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::DELIVERY_METHODS_EDIT))
                                        <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $item->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td class="handle text-center pl-0" style="cursor: pointer">
                                            <i class="flaticon2-sort"></i>
                                        </td>
                                        @endif
                                        <td class="text-center pl-0">
                                            {{ $item->id }}
                                        </td>
                                        <td class="pr-0">
                                            {{ $item->title }}
                                        </td>
                                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::DELIVERY_METHODS_EDIT))
                                        <td class="pr-0">
                                            <div class="d-flex justify-content-center">
                                            <span class="switch">
                                                <label>
                                                    <input class="active_switch" type="checkbox" @checked($item->is_active) name="is_active" data-url="{{ route('admin.delivery-methods.update', $item) }}">
                                                    <span></span>
                                                </label>
                                            </span>
                                            </div>
                                        </td>
                                            @endif
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Container-->
        <!--end::Entry-->

    </div>
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let tbody = document.querySelector('tbody')
            new Sortable(tbody, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    var list = [];
                    $.each($('tbody.banner-table tr'), function (idx, el) {
                        list.push({
                            id: $(el).data('id'),
                            cat_id: $(el).data('label'),
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
                            $.each(response, function(i, item) {
                                let id = item['id'];
                                let position = item['position'];
                                $(`tr[data-id="${id}"]`).find('.position').text(position)
                            })
                        }
                    });

                }
            });

            $(document).on('change', '.active_switch', function (e) {
                let url = this.dataset.url,
                    name = this.name,
                    value = this.checked ? 1 : 0;

                let data = {};
                data[name] = value;

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        toastr.success('Статус обновлен');
                    }
                })
            })



            /* Чекбокс */
            $(document).on('click', '#checkbox-all', function (e) {
                let isChecked = $(this)[0].checked
                if (isChecked) {
                    $('.checkbox-item').prop('checked', true);
                } else {
                    $('.checkbox-item').prop('checked', false);
                }
            });

            /**
             * Активація/Деактивація статей
             */

            $(document).on('click', '.activePost', function (e) {
                let status = $(this).data('status');
                let ids = $(".checkbox-item:checkbox:checked").map(function () {
                    return $(this).val();
                }).get();

                $.ajax({
                    type: "POST",
                    url: $(this).data('url'),
                    data: {
                        ids: ids,
                        status: status,
                    },
                    success: function (response) {
                        console.log(ids)
                        ids.forEach(function (id, i) {
                            $(`tr[data-id="${id}"]`).find('.active_switch').attr('checked', status == 1)
                            console.log(id, $(`tr[data-id="${id}"]`))
                        })
                        toastr.success('Статусы обновлены');
                    }
                });
            });
        });
    </script>
@endsection
