@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Пользователь: {{ $user->email }}</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::USERS_EDIT))
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline mr-2 mb-6">
                        <a href="{{ route('admin.user.edit', $user->id) }}"
                           class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md"></span>Редактировать
                        </a>
                    </div>
                </div>
            </div>
            @endif
            <div class="card card-custom">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Основная информация</h2>
                            <div class="table-responsive mt-2">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ $user->id }}</th>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>{{ $user->email }}</th>
                                    </tr>
                                    <tr>
                                        <th>Телефон</th>
                                        <th>{{ $user->phone }}</th>
                                    </tr>
                                    <tr>
                                        <th>Имя</th>
                                        <th>{{ $user->name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Фамилия</th>
                                        <th>{{ $user->surname }}</th>
                                    </tr>
                                    <tr>
                                        <th>Дата рождения</th>
                                        <th>{{ date('Y-m-d', strtotime($user->birthday))}} <b>{{ $user->getAge() }}</b>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Адрес</th>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Город</th>
                                                    <th>{{ $user->city }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Регион</th>
                                                    <th>{{ $user->region }}</th>
                                                </tr>
                                                <tr>
                                                    <th>Адрес</th>
                                                    <th>{{ $user->address }}</th>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2>Дополнительная информация</h2>
                            <div class="table-responsive mt-2">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Дата регистарции</th>
                                        <th>{{ date('m Y, H:i:s', strtotime($user->created_at)) }}</th>
                                    </tr>
                                    <tr>
                                        <th>Номер карты</th>
                                        <th></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
    <!--end::Entry-->


@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endsection




