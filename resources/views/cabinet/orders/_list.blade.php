@foreach($orders as $order)
<tr>
    <td data-title="Номер заказа">{{ $order->id }}</td>
    <td data-title="Дата">{{ $order->pretty_created_at }}</td>
    <td data-title="Статус">
        <span class="status status--success">{{ $order->status_title }}</span>
    </td>
    <td data-title="Сумма">{{ $order->total_sum }} Р</td>
    <td><a href="{{ route('profile.orders.show', $order) }}">Подробнее</a></td>
</tr>
@endforeach
