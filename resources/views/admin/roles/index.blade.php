@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Роли</h5>
@endsection

@section('styles')

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
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Роли</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button data-toggle="modal" data-target="#createRoleModal"
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
                                    #
                                </th>
                                <th class="text-center pr-0">
                                    Название
                                </th>
                                <th class="pr-0 text-center">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr data-id="{{ $role->id }}">
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $role->id }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $role->name }}
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit"
                                           data-toggle="modal" data-target="#editRoleModal"
                                           data-show-url="{{ route('admin.roles.show', $role) }}"
                                           data-update-url="{{ route('admin.roles.update', $role) }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display: inline">
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

    @include('admin.roles.modals.create')
    @include('admin.roles.modals.edit')
@endsection

@section('js_after')
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        })


        $(document).on('click', '.btn_edit', loadModel);

        function loadModel() {
            let updateUrl = $(this).data('update-url')

            $.ajax({
                url: $(this).data('show-url'),
                dataType: 'json',
                success: function (item) {
                    $('#editRoleForm').attr('action', updateUrl)

                    $('#editRoleName').val(item.name);
                    $.each(item.permissions, function (i, permission) {
                        $('#editRoleModal').find(`[name="permissions[]"][value="${permission.name}"`).prop('checked', true)
                    })
                }
            });
        }

    </script>
@endsection

