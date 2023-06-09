@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Пользователи</h5>
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
                            <h3 class="card-label">Пользователи</h3>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-head-custom table-vertical-center">
                                <thead>
                                <tr>
                                    <th class="pl-0 text-center">
                                        Id
                                    </th>
                                    <th class="pr-0 text-center">
                                        Email
                                    </th>
                                    <th class="pr-0 text-center">
                                        Имя
                                    </th>
                                    <td class="text-center pr-0">
                                        Фамилия
                                    </td>
                                    <td class="text-center pr-0">
                                        Телефон
                                    </td>
                                    <td class="text-center pr-0">
                                        Адресс
                                    </td>
                                    <td class="text-center pr-0">
                                        Дата создания
                                    </td>
                                    <th class="pr-0 text-center">
                                        Действия
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="table">
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center pl-0">
                                            {{ $user->id }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $user->email }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $user->name }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $user->surname }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $user->phone }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $user->address }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ date('H:i | d.m.y', strtotime($user->created_at)) }}
                                        </td>
                                        <td class="text-center pr-0">
                                            <a href="{{ route('admin.user.show', $user->id) }}"
                                               class="btn btn-sm btn-clean btn-icon">
                                                <i class="las la-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                               class="btn btn-sm btn-clean btn-icon">
                                                <i class="las la-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="pagination">
                            {{ $users->links('vendor.pagination.product_pagination') }}
                        </div>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </div>


@endsection

@section('js_after')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.uk.min.js"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('super_admin/js/users.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endsection


