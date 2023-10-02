@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Баннеры</h5>
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
                <div class="card gutter-b col-lg-12 ml-0">
                    @include('admin.banner.parts.filter')
                </div>
                @include('admin.layouts.includes.messages')
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Баннеры</h3>
                        </div>
                        <div class="card-toolbar">
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BANNERS_EDIT))
                            <div class="dropdown dropdown-inline mr-2">
                                <button class="btn btn-danger font-weight-bolder activePost" data-status="0">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-toggle-off"></i></span>Деактивировать
                                </button>
                            </div>
                            <div class="dropdown dropdown-inline mr-2">
                                <button class="btn btn-success font-weight-bolder activePost" data-status="1">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-toggle-on"></i>
                                    </span>Активировать
                                </button>
                            </div>
                            @endif
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BANNERS_CREATE))
                            <div class="dropdown dropdown-inline mr-2">
                                <a href="{{ route('admin.banner.create') }}"
                                   class="btn btn-success font-weight-bolder">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-plus mr-2"></i></span>Добавить
                                </a>
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
                                    <th class="pl-0 text-center">
                                    <span style="width: 20px;">
                                        <label class="checkbox checkbox-single checkbox-all">
                                            <input id="checkbox-all" type="checkbox"
                                                   name="checkbox[]">&nbsp;<span></span>
                                        </label>
                                    </span>
                                    </th>
                                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BANNERS_EDIT))
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
                                    <th class="pr-0 text-center">
                                        Позиция
                                    </th>
                                    <th class="pr-0 text-center">
                                        Номер баннера
                                    </th>
                                    <th class="pr-0 text-center">
                                        Изображения
                                    </th>
                                    <th class="pr-0 text-center">
                                        Действия
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="table" class="banner-table">
                                    @foreach($banner as $item)
                                    <tr id="banner_{{$item->id}}" data-id="{{ $item->id }}" data-label="{{ $item->position }}">
                                        <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $item->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
                                        </td>
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BANNERS_EDIT))
                                        <td class="handle text-center pl-0" style="cursor: pointer">
                                            <i class="flaticon2-sort"></i>
                                        </td>
                                        @endif
                                        <td class="text-center pl-0">
                                            {{ $item->id }}
                                        </td>
                                        <td class="pr-0">
                                            <a href="{{ route('admin.banner.edit', $item->id) }}">{{ $item->title }}</a>
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $item->position }}
                                        </td>

                                        <td class="text-center pr-0 sort position">
                                            {{ $item->number_position }}
                                        </td>

                                        <td class="text-center pr-0">
                                            <div class="banner__image"><a href="{{ route('index.banner', $item->id) }}"><img src="{{asset('images/uploads/banner/' . $item->image)}}" alt="" style=" width: 100px;"></a></div>
                                        </td>

                                        <td class="text-center pr-0">
                                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BANNERS_EDIT))
                                            <a href="{{ route('admin.banner.edit', $item->id) }}" class="btn btn-sm btn-clean btn-icon">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <button class="activePost btn btn-sm btn-clean btn-icon" data-status="{{ !$item->status ? 1 : 0 }}">
                                                <span>{!! \App\Services\SiteService::statusBanner($item->status) !!}</span>
                                            </button>
                                            @endif
                                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BANNERS_DELETE))
                                            <a href="{{ route('admin.banner.delete', $item->id) }}" class="btn btn-sm btn-clean btn-icon" onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                                                <i class="las la-trash"></i>
                                            </a>
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div id="pagination">
                            {{ $banner->appends(request()->all())->links('vendor.pagination.product_pagination') }}
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
    <script src="{{ asset('super_admin/js/banner.js') }}"></script>
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
                        url: '{{ route('admin.banners.update_positions') }}',
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
        });
    </script>
@endsection
