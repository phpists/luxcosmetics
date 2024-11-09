@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Причины обращения</h5>
@endsection

@section('styles')
    <style>
        .image-input-wrapper {
            width: 170px!important;
            height: 170px!important;
            background-size: auto!important;
            background-position: center!important;
        }
    </style>
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
                        <h3 class="card-label">Причины обращения пользователей</h3>
                    </div>
                    <div class="card-toolbar">
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::FEEDBACKS_CREATE))
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button data-toggle="modal" data-target="#createModal" class="btn btn-primary font-weight-bold">
                                <i class="fas fa-plus mr-2"></i>Добавить
                            </button>
                        </div>
                        @endif
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::FEEDBACKS_DELETE))
                        <div class="dropdown dropdown-inline mr-2">
                            <button class="btn btn-danger font-weight-bolder deletedCares">
                                <span class="svg-icon svg-icon-md"><i class="las la-trash"></i></span>Удалить
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
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::FEEDBACKS_DELETE))
                                <th class="pl-0 text-center">
                                    <span style="width: 20px;">
                                        <label class="checkbox checkbox-single checkbox-all">
                                            <input id="checkbox-all" type="checkbox"
                                                   name="checkbox[]">&nbsp;<span></span>
                                        </label>
                                    </span>
                                </th>
                                @endif
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
                            @foreach($feedback_reasons as $reason)
                                <tr>
                                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::FEEDBACKS_DELETE))
                                    <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $reason->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
                                    </td>
                                    @endif
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $reason->id }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $reason->reason }}
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::FEEDBACKS_EDIT))
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit"
                                               data-toggle="modal" data-target="#updateModal"
                                               data-id="{{ $reason->id }}">
                                                <i class="las la-edit"></i>
                                            </a>
                                        @endif
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::FEEDBACKS_DELETE))
                                            <form action="{{ route('admin.feedback-reason.delete')}}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $reason->id }}">
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                    onclick="return confirm('Вы уверены, что хотите удалить способ доставки {{ $reason->reason }}?')"
                                                    title="Delete"><i class="las la-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div id="pagination">
                            {{ $feedback_reasons->links('vendor.pagination.super_admin_pagination_new') }}
                        </div>
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

    @include('admin.feedback_reasons.modals.create')
    @include('admin.feedback_reasons.modals.update')
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let tbody = document.querySelector('tbody')

            $('#statusBtn').on('change', function(){
                this.value = this.checked ? 1 : 0;
                // alert(this.value);
            }).change();
            $('#updateStatusBtn').on('change', function(){
                this.value = this.checked ? 1 : 0;
                // alert(this.value);
            }).change();

        })


        $(document).on('click', '.btn_edit', loadModel);

        function loadModel() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.feedback-reason.show') }}',
                data: {
                    'id': id
                },
                success: function (response) {
                    $('#updateId').val(response.id);
                    $('#updateReason').val(response.reason);
                }, error: function (response) {
                    console.log(response)
                }
            });
        }
    </script>
    <script src="{{ asset('super_admin/js/care.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endsection

