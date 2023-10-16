@foreach($orders as $order)
<tr>
    <td data-title="Номер заказа">{{ $order->num }}</td>
    <td data-title="Дата">{{ $order->pretty_created_at }}</td>
    <td data-title="Статус">
        @if($order->status)
        <span class="status status--success" style="color:{{ $order->status->color }}">{{ $order->status->title }}</span>
        @endif
    </td>
    <td data-title="Сумма">{{ $order->total_sum }} Р</td>
    <td><a href="{{ route('profile.orders.show', $order) }}">Подробнее</a></td>
</tr>
@endforeach
