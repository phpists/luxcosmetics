@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Характеристики</h5>
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
                    <div class="row justify-content-end">
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROPERTIES_CREATE))
                        <div class="col-auto">
                            <a href="{{route('admin.properties.create')}}" class="btn btn-primary font-weight-bold">
                                <i class="fas fa-plus mr-2"></i>Добавить
                            </a>
                        </div>
                        @endif
                    </div>

                    <div id="table_data">
                    @include('admin.properties._table')
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->

    @include('admin.properties.modals.create')
    @include('admin.properties.modals.update')
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/Sortable.js') }}"></script>
    <script>
    </script>
@endsection

