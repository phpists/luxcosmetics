<x-mail::message>
    <h1 style="text-align: center">
        Привет, {{ $order->full_name }}
    </h1>
    Статус заказа №{{ $order->id }} изменился на - <span style="color: {{ $order->status->color ?? 'black' }}">{{ $order->status->title ?? 'UNDEFINED' }}
    <x-mail::button :url="route('profile.orders.show', $order)">Информация о заказе</x-mail::button>
</x-mail::message>
