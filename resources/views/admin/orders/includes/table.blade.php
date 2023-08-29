<input type="hidden" id="filteredTotalSumValud" value="{{ $current_sum }}">
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
                Имя
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
                            <select
                                data-url="{{ route('admin.orders.change-status', $order) }}"
                                class="form-control selectpicker change-status" @disabled($order->status_id == \App\Models\Order::STATUS_COMPLETED)>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"
                                            @selected($order->status_id == $status->id)
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
    {{ $orders->withQueryString()->links('vendor.pagination.product_pagination') }}
</div>
<!--end::Table-->
