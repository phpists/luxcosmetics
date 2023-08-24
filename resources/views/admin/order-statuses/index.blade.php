@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Статусы заказов</h5>
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
                        <h3 class="card-label">Статусы заказов</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button data-toggle="modal" data-target="#createModal"
                                    class="btn btn-primary font-weight-bold">
                                <i class="fas fa-plus mr-2"></i>Добавить
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
                                <th class="text-center pr-0">
                                    Название
                                </th>
                                <th class="text-center pr-0">
                                    Цвет
                                </th>
                                <th class="pr-0 text-center">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $status->title }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge" style="background-color: {{ $status->color }}">
                                            {{ $status->color }}
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon edit-btn"
                                           data-toggle="modal" data-target="#editModal"
                                           data-show-url="{{ route('admin.order_statuses.show', $status) }}"
                                           data-update-url="{{ route('admin.order_statuses.update', $status) }}"
                                           data-id="{{ $status->id }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        @if($status->isDeletable())
                                        <form action="{{ route('admin.order_statuses.destroy', $status) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                    onclick="return confirm('Вы уверенны?')"
                                                    title="Delete"><i class="las la-trash"></i>
                                            </button>
                                        </form>
                                        @endif
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

    @include('admin.order-statuses.modals.create')
    @include('admin.order-statuses.modals.edit')
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


        $(document).on('click', '.edit-btn', loadModel);

        function loadModel() {
            let $button = $(this),
                $form = $('#editForm');

            $.ajax({
                url: $(this).data('show-url'),
                dataType: 'json',
                success: function (item) {
                    $form.attr('action', $button.data('update-url'));

                    $form.find('#editColor').val(item.color);
                    $form.find('#editTitle').val(item.title);
                }
            });
        }

    </script>
@endsection

