@extends('admin.layouts.app')

@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Заказы</h5>
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
                            <h3 class="card-label">Заказы</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.orders.create') }}" class="btn btn-success font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Создать заказ
                            </a>
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
                                    <th class="pr-0 text-center">
                                        Статус
                                    </th>
                                    <th class="pr-0 text-center">
                                        Email
                                    </th>
                                    <th class="pr-0 text-center">
                                        Клиент
                                    </th>
                                    <td class="text-center pr-0">
                                        Телефон
                                    </td>
                                    <td class="text-center pr-0">
                                        Сума
                                    </td>
                                    <td class="text-center pr-0">
                                        Скидка
                                    </td>
                                    <td class="text-center pr-0">
                                        Дата
                                    </td>
                                    <th class="pr-0 text-center">
                                        Действия
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="table">
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="text-center pl-0">
                                            {{ $order->id }}
                                        </td>
                                        <td class="text-center pr-0">
                                            <div class="form-group row my-auto">
                                                <div class="col-12">
                                                    <select data-url="{{ route('admin.orders.change-status', $order) }}" class="form-control selectpicker change-status">
                                                        @foreach($statuses as $status)
                                                            <option value="{{ $status->id }}" @selected($order->status_id == $status->id)
                                                                    data-content="<i class='fas fa-circle mr-2' style='color: {{ $status->color }}'></i>{{ $status->title }}">{{ $status->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $order->user->email ?? '' }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $order->full_name }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $order->phone }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $order->total_sum }}
                                        </td>
                                        <td class="text-center pr-0">
                                                @if($order->giftCard)
                                                    Подарочная карта: {{ $order->gift_card_discount }}<br>
                                                @endif
                                                @if($order->isUsedBonuses())
                                                    Бонусы: {{ $order->bonuses_discount }}<br>
                                                @endif
                                                @if($order->promoCode)
                                                    Промо код: {{ $order->promo_code_discount }}
                                                @endif
                                            {{ $order->discount }}
                                        </td>
                                        <td class="text-center pr-0">
                                            {{ $order->pretty_created_at }}
                                        </td>
                                        <td class="text-center pr-0">
                                            <a href="{{ route('admin.orders.edit', $order->id) }}"
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
                            {{ $orders->links('vendor.pagination.product_pagination') }}
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
    <script>
        $(function() {
            $(document).on('change', 'select.change-status', function(e) {
                let url = $(this).data('url'),
                    value = $(this).val();

                $.ajax({
                    url: url,
                    type: 'PUT',
                    dataType: 'json',
                    data: {
                        status_id: value
                    }
                })
            })
        })
    </script>
@endsection


