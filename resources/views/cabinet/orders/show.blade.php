@extends('cabinet.layouts.cabinet')

@section('title', 'Заказ №' . $order->num)

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Информация о заказе</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="chars">
                    <div class="chars__item">
                        <div class="chars__name"><span>Статус заказа</span></div>
                        <div class="chars__value">
                            @if($order->status)
                            <span><b class="status status--new" style="color:{{ $order->status->color }}">{{ $order->status->title }}</b></span>
                            @endif
                        </div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>Дата заказа</span></div>
                        <div class="chars__value"><span>{{ $order->pretty_created_at }}</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>Заказчик</span></div>
                        <div class="chars__value"><span>{{ $order->full_name }}</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>Телефон заказчика</span></div>
                        <div class="chars__value"><span>{{ $order->phone }}</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>E-mail</span></div>
                        <div class="chars__value"><span>{{ $order->user->email }}</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>Способ доставки</span></div>
                        <div class="chars__value"><span>{{ \App\Models\Order::ALL_DELIVERIES[$order->delivery_type] ?? "???" }}</span></div>
                    </div>
                    @if($order->delivery_type == \App\Models\Order::DELIVERY_SELF_PICKUP)
                        <div class="chars__item">
                            <div class="chars__name"><span>Служба доставки</span></div>
                            <div class="chars__value"><span>{{ \App\Models\Order::ALL_DELIVERY_SERVICES[$order->service] ?? '???' }}</span></div>
                        </div>
                    @endif
                    <div class="chars__item">
                        <div class="chars__name"><span>Адресс доставки</span></div>
                        <div class="chars__value"><span>{{ $order->address }}</span></div>
                    </div>
                </div>

                @if($order->status_id == \App\Models\Order::STATUS_PAYED && $order->canBeCancelled())
                <a href="{{ route('profile.orders.cancel', $order) }}" class="btn btn--accent">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#repeat')}}"></use>
                    </svg>
                    Отменить заказ
                </a>
                @endif

                @if($order->status_id == \App\Models\Order::STATUS_NEW)
                <a href="{{ route('orders.payment', $order) }}" class="btn btn--accent">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#repeat')}}"></use>
                    </svg>
                    Оплатить заказ
                </a>
                @endif
                @if($order->status_id == \App\Models\Order::STATUS_COMPLETED)
                <a href="{{ route('profile.orders.repeat', $order) }}" class="btn btn--accent">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#repeat')}}"></use>
                    </svg>
                    Повторить заказ
                </a>
                @endif
            </div>
        </div>

        @include('cart.includes.cabinet_list')

    </main>
@endsection
