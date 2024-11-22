@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Настройки сайта</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <!--end::Breadcrumb-->
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
                            <h3 class="card-label">Настройки</h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CONFIG_MANAGE))
                            <div class="col-auto">
                                <button data-toggle="modal" data-target="#createConfigModal" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus mr-2"></i>Добавить
                                </button>
                            </div>
                            @endif
                            <!--
                            <div class="dropdown dropdown-inline mr-2">
                               <button class="btn btn-success font-weight-bolder activeproducts" data-status="1">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-toggle-on"></i>
                                    </span>Активувати
                               </button>
                            </div>
                           <div class="dropdown dropdown-inline mr-2">
                                <button class="btn btn-success font-weight-bolder activeproducts" data-status="0">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-toggle-off"></i></span>Деактивувати
                                </button>
                            </div>
                            <div class="dropdown dropdown-inline mr-2">
                                <button class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-toggle-off"></i>
                                    </span>Імпортувати
                                </button>
                            </div>-->
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-head-custom table-vertical-center">
                                <thead>
                                <tr>
                                    <th class="pr-0 text-center">
                                        Название
                                    </th>
                                    <th class="pr-0 text-center">
                                        Значение
                                    </th>
                                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CONFIG_MANAGE))
                                    <th class="pr-0 text-center">
                                        Действие
                                    </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody id="table">
                                @foreach($params as $param=>$cfg)
                                    <tr id="{{$param}}">
                                        <td class="text-center pl-0">
                                            {{ $param }}
                                        </td>
                                        <td class="text-center pr-0">
                                            @if($cfg['type'] === \App\Services\SiteConfigService::BOOL)
                                                {{ $cfg['value']? 'Да': 'Нет' }}
                                            @elseif($cfg['type'] == \App\Services\SiteConfigService::WYSIWYG)
                                                {{ Str::words(strip_tags($cfg['value']), 5) }}
                                            @else
                                                {{ $cfg['value'] }}
                                            @endif
                                        </td>
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CONFIG_MANAGE))
                                        <td class="text-center pr-0">
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateCfg"
                                               data-toggle="modal" data-target="#updateConfigModal"
                                               data-id="{{ $param }}" data-value="{{$cfg['value']}}" data-label="{{$cfg['type']}}">
                                                <i class="las la-edit"></i>
                                            </a>
{{--                                            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"--}}
{{--                                               class="btn btn-sm btn-clean btn-icon">--}}
{{--                                                <i class="las la-edit"></i>--}}
{{--                                            </a>--}}
{{--                                            <a href="{{ route('admin.product.delete', $product->id) }}"--}}
{{--                                               class="btn btn-sm btn-clean btn-icon"--}}
{{--                                               onclick="return confirm('Вы уверены, что хотите удалить запись?')">--}}
{{--                                                <i class="las la-trash"></i>--}}
{{--                                            </a>--}}
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
    @include('admin.settings.config.modals.create')
    @include('admin.settings.config.modals.update')
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>

    {{--    <script src="{{ asset('super_admin/js/Sortable.js') }}"></script>--}}
{{--    <script src="{{ asset('super_admin/js/product.js') }}"></script>--}}
    <script>
        function change_val_input(container_id, type, id, value=null) {
            let element = document.getElementById(container_id);
            if (element.firstChild) {
                element.firstChild.remove();
            }
            if (type === '{{\App\Services\SiteConfigService::TEXT}}') {
                element.innerHTML = `<input type="text" required name="value" value="${value}" class="form-control" id="${id}">`
            }
            else if (type === '{{\App\Services\SiteConfigService::BOOL}}') {
                element.innerHTML = `
                    <select id="${id}" class="form-control" required name="value">
                        <option value="1">Да</option>
                        <option value="0">Нет</option>
                    </select>
                `
                if (value !== null) {
                    $(`#${id} option[value='` + value + "']").select();
                }
            }
            else if (type === '{{\App\Services\SiteConfigService::NUMERIC}}') {
                element.innerHTML = `<input type="number" required name="value" value="${value}" class="form-control" id="${id}">`
            }
            else if (type === '{{\App\Services\SiteConfigService::WYSIWYG}}') {
                element.innerHTML = `<textarea required id="${id}" name="value">${value}</textarea>`
                CKEDITOR.replace( id );
            }
        }
        $('.updateCfg').on('click', function (ev) {
            let el = ev.currentTarget;

            $('#cfg_upd_name').val(el.getAttribute('data-id'));
            let d_type = el.getAttribute('data-label');
            $("#type_upd option[value='" + d_type + "']").attr('selected', true);
            $('#type_upd_val').val(d_type);
            change_val_input('inp_upd_val', d_type, 'cfg_upd_value', el.getAttribute('data-value'));
        })
        $('#type').on('change', function (ev) {
            let type = $('select[name="type"]').find(':selected').val();
            change_val_input('inp_val', type, 'cfg_value')

        })
    </script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endsection


