@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Администраторы</h5>
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
    <style>
        .select2-container--default {
            width: 100% !important;
        }
    </style>
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
                            <h3 class="card-label">Администраторы</h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">
                                <button data-toggle="modal" data-target="#createAdminModal"
                                        class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus mr-2"></i>Создать
                                </button>
                            </div>

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
                                        Дата создания
                                    </td>
                                    <td class="text-center pr-0">
                                        Статус
                                    </td>
                                    <th class="pr-0 text-center" style="min-width: 300px">
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
                                            {{ date('H:i | d.m.y', strtotime($user->created_at)) }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $user->getStatus() }}
                                        </td>
                                        <td class="text-center pr-0">
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit"
                                               data-toggle="modal" data-target="#editAdminModal"
                                               data-show-url="{{ route('admin.admins.show', $user) }}"
                                               data-update-url="{{ route('admin.admins.update', $user) }}">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.admins.destroy', $user) }}" method="POST" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                        onclick="return confirm('Вы уверенны?')"
                                                        title="Delete"><i class="las la-trash"></i>
                                                </button>
                                            </form>
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


    @include('admin.admin-users.modals.create')
    @include('admin.admin-users.modals.edit')

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.select2').select2()

            $('#createAdminEmail').select2({
                tags: true,
                placeholder: 'Email'
            }).on('change.select2', function (e) {
                let userData = $(this).find('option:selected').data('user');

                if (userData) {
                    $('#createAdminName').val(userData.name);
                    $('#createAdminSurname').val(userData.surname);
                    $('#createAdminPassword').prop('required', false);
                } else {
                    $('#createAdminPassword').prop('required', true);
                }
            })

        })


        $(document).on('click', '.btn_edit', loadModel);

        function loadModel() {
            let updateUrl = $(this).data('update-url')
            $.ajax({
                url: $(this).data('show-url'),
                dataType: 'json',
                success: function (item) {
                    $('#editAdminForm').attr('action', updateUrl)
                    $('#editAdminName').val(item.name);
                    $('#editAdminSurname').val(item.surname);
                    $('#editAdminEmail').val(item.email);
                    $('#editAdminEmail').val(item.email);
                    let roles = [];
                    $.each(item.roles, function (i, role) {
                        roles.push(role.name)
                    })
                    $('#editAdminRoles').val(roles).trigger('change')
                    $('#editAdminIsActive').prop('checked', item.is_active === 1)

                }
            });
        }

    </script>
@endsection


