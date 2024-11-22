@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Товары</h5>
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
                <div class="card gutter-b col-lg-12 ml-0">
                    @include('admin.products.parts.filter')
                </div>
                @include('admin.layouts.includes.messages')
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Товар</h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_DELETE))
                            <div class="dropdown dropdown-inline mr-2">
                                <button class="btn btn-danger font-weight-bolder deletedProducts">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="las la-trash"></i>
                                    </span>Удалить
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

                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_CREATE))
                            <div class="dropdown dropdown-inline mr-2">
                                <a href="{{ route('admin.product.create') }}"
                                   class="btn btn-success font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Добавить товар
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
                                    <th class="pl-0 text-center">
                                        #
                                    </th>
                                    <th class="pr-0 text-center">
                                        Название
                                    </th>
                                    <th class="pr-0 text-center">
                                        Категория
                                    </th>
                                    <th class="pr-0 text-center">
                                        Бренды
                                    </th>
                                    <td class="text-center pr-0">
                                        Артикул
                                    </td>
                                    <td class="text-center pr-0">
                                        Статус
                                    </td>
                                    <th class="pr-0 text-center">
                                        Действие
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="table">
                                    @include('admin.products.parts.table', ['products' => $products])
                                </tbody>
                            </table>
                        </div>
                       <div id="pagination">
                           {{ $products->appends(request()->all())->links('vendor.pagination.product_pagination') }}
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
    <script src="{{ asset('super_admin/js/Sortable.js') }}"></script>
    <script src="{{ asset('super_admin/js/product.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        let variations_select = $('#cat_select');
        variations_select.select2({
            allowClear: true,
            placeholder: 'Выберите категорию',
            ajax: {
                url: '{{route('admin.categories.search')}}',
                data: function (params) {
                    var query = {
                        search: params.term,
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    data = data.map((x) => {
                        return {
                            text: x.name,
                            id: x.id
                        }
                    })
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    };
                }
            },
            minimumInputLength: 1
        });
        $('#brand_select').select2({
            allowClear: true,
            placeholder: 'Выберите Бренд',
            ajax: {
                url: '{{route('admin.brands.search')}}',
                data: function (params) {
                    var query = {
                        search: params.term,
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    data = data.map((x) => {
                        return {
                            text: x.name,
                            id: x.id
                        }
                    })
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    };
                }
            },
            minimumInputLength: 1
        });
    </script>
@endsection


