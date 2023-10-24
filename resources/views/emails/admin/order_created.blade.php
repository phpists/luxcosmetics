<x-mail::message>
    <h1 style="text-align: center">
        Новый заказ №{{ $order->id }}
    </h1>

    <x-mail::button :url="route('admin.orders.show', $order->id)">Просмотр</x-mail::button>
</x-mail::message>
