@extends('admin.layouts.app')

@section('styles')
    <style>
        .tox-tinymce {
            height: 600px !important;
            width: 100%;
        }
        .select2-container--default {
            width: 100% !important;
        }
    </style>
@endsection

@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Главная</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.orders.index') }}" class="text-muted">Заказы</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-muted">Заказ №{{ $order->id }}</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')

            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center pt-8 px-8 pt-md-27 px-md-0">
                        <div class="col-md-10">
                            <a class="btn btn-secondary btn-sm mb-5" href="{{ url()->previous() }}">Вернутся назад</a>
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                <h1 class="display-4 font-weight-boldest mb-10">Заказ №{{ $order->id }}</h1>
                                <div class="d-flex flex-column align-items-md-end px-0">
                                    <span class=" d-flex flex-column align-items-md-end opacity-70">
                                    <span>Статус: <span class="color: {{ $order->status->color }}"><i class='fas fa-circle mr-2 ml-4' style='color: {{ $order->status->color }}'></i>{{ $order->status->title }}</span></span>
                                </span>
                                </div>
                            </div>
                            <div class="border-bottom w-100"></div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Создан</span>
                                    <span class="opacity-70">{{ $order->created_at->format('d.m.y') }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Покупатель</span>
                                    <span class="opacity-70"><a
                                            href="{{ route('admin.user.show', $order->user) }}" target="_blank">{{ $order->user->email }}</a></span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Доставка</span>
                                    <span class="opacity-70">{{ \App\Models\Order::ALL_DELIVERY_TYPES[$order->delivery_type] ?? 'UNDEFINED' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->

                    <div class="row justify-content-center pb-8 pb-md-20 pt-15">
                        <div class="col-md-10">
                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col">
                                    <ul class="list-group list-group-flush w-100">
                                        <li class="list-group-item"><span class="opacity-70">Имя:</span> {{ $order->full_name }}</li>
                                        <li class="list-group-item"><span class="opacity-70">Телефон:</span> {{ $order->phone }}</li>
                                        <li class="list-group-item"><span class="opacity-70">Подарочная коробка:</span> {{ $order->gift_box ? 'Да' : 'Нет' }}</li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <ul class="list-group list-group-flush w-100">
                                        <li class="list-group-item"><span class="opacity-70">Регион:</span> {{ $order->region }}</li>
                                        <li class="list-group-item"><span class="opacity-70">Город:</span> {{ $order->city }}</li>
                                        <li class="list-group-item"><span class="opacity-70">Адреcс:</span> {{ $order->address }}</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- begin: Invoice body-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted  text-uppercase">Товар</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Кол-во</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Цена</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->orderProducts as $orderProduct)
                                    <tr class="font-weight-boldest">
                                        <td class="border-0 pl-0 pt-7 d-flex align-items-center">{{ "[{$orderProduct->product->code}] {$orderProduct->product->brand->name} > {$orderProduct->product->title}" }}</td>
                                        <td class="border-top-0 text-right pt-7 align-middle">{{ $orderProduct->quantity }}</td>
                                        <td class="border-top-0 text-right pt-7 align-middle">{{ $orderProduct->price }}</td>
                                        <td class="border-top-0 text-primary pr-0 pt-7 text-right align-middle">{{ $orderProduct->quantity * $orderProduct->price }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice body-->

                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 mx-0" style="background-color: #fbfbfb!important">
                        <div class="col-md-10">
                            @php($total_discount = $order->getTotalDiscount())
                            @if($total_discount)
                                <ul class="list-group list-group-flush col col-md-4">
                                    @if($order->gift_card_id)
                                        <li class="list-group-item" style="background-color: #fbfbfb!important">{{ '-' . $order->gift_card_discount }}
                                        @if($order->giftCard)
                                            <a href="javascript:;" class="show-giftCard" data-toggle="modal" data-target="#showGiftCardModal"
                                               data-url="{{ route('admin.gift_cards.show', $order->giftCard) }}">Подарочная карта</a>
                                        @else
                                            <span class="opacity-70">Подарочная карта (удалена)</span>
                                        @endif
                                        </li>
                                    @endif
                                    @if($order->promo_code_id)
                                        <li class="list-group-item" style="background-color: #fbfbfb!important">{{ '-' . $order->promo_code_discount }}
                                            @if($order->promoCode)
                                                <a href="javascript:;" class="show-promoCode"
                                                   data-toggle="modal" data-target="#showPromoCodeModal"
                                                   data-url="{{ route('admin.promo_codes.show', $order->promoCode) }}">Промо код</a>
                                            @else
                                                <span class="opacity-70">Промо код (удалён)</span>
                                            @endif
                                        </li>
                                    @endif
                                    @if($order->bonuses_discount)
                                        <li class="list-group-item" style="background-color: #fbfbfb!important">{{ '-' . $order->bonuses_discount }} использовано баллов</li>
                                    @endif
                                </ul>
                            @endif

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="font-weight-bold text-muted text-uppercase">Сумма заказа</th>
                                        <th class="font-weight-bold text-muted text-uppercase">Сумма скидок</th>
                                        <th class="font-weight-bold text-muted text-uppercase text-right">К оплате</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>{{ $order->orderProducts->sum(function ($item) { return $item->quantity * $item->price; }) }}</td>
                                        <td>{{ $total_discount ? '-' . $total_discount : 0 }}</td>
                                        <td class="text-primary font-size-h3 font-weight-boldest text-right">{{ $order->total_sum }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->

                    <!-- end: Invoice-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>

    @include('admin.gift-cards.modals.show')
    @include('admin.promo-codes.modals.show')


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


        $(document).on('click', '.show-giftCard', function(e) {
            let $modal = $($(this).data('target'))
            $.ajax({
                url: $(this).data('url'),
                dataType: 'json',
                success: function (item) {
                    $modal.find('#showColor').val(item.color).css('background-color', item.color);
                    $modal.find('#showSum').val(item.sum);
                    $modal.find('#showBalance').val(item.balance);
                    $modal.find('#showFrom').val(item.from_whom);
                    $modal.find('#showReceiver').val(item.receiver);
                    $modal.find('#showReceiverEmail').val(item.receiver_email);
                    $modal.find('#showDescription').text(item.description);
                    $modal.find('#showCode').val(item.code);
                    $modal.find('#showActivated').val(item.activated_date);
                    $modal.find('#showActivatedBy').val(item.activated_by_email);
                }
            });
        });

        $(document).on('click', '.show-promoCode', function (e) {
            let $modal = $($(this).data('target'))
            $.ajax({
                url: $(this).data('url'),
                dataType: 'json',
                success: function (item) {
                    $modal.find('#showCode').val(item.code);
                    $modal.find('#showType').val(item.type);
                    if (item.category_id)
                        $modal.find('#showCategory').val(item.category_id).parents('div.column:first').show();
                    if (item.product_id)
                        $modal.find('#showProduct').val(item.product_id).parents('div.column:first').show();
                    $modal.find('#showAmount').val(item.amount);
                    $modal.find('#showPercent').val(item.percent);
                    $modal.find('#showQuantity').val(item.quantity);
                    $modal.find('#showStarts').val(item.starts_at);
                    $modal.find('#showEnds').val(item.ends_at);
                }
            });
        });


    </script>
@endsection




