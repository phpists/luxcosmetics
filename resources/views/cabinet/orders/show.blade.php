@extends('cabinet.layouts.cabinet')

@section('title', 'Заказ №' . $order->id)

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
                </div>
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
