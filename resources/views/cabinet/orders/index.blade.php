@extends('cabinet.layouts.cabinet')

@section('title', 'История заказов')

@section('page_content')
    <main class="cabinet-page__main">
        <table class="myorders">
            <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Дата</th>
                <th>Статус</th>
                <th>Сумма</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if($orders->isNotEmpty())
                @include('cabinet.orders._list')
            @else
                <tr>
                    <td colspan="5" style="text-align: center">Заказов ещё не было</td>
                </tr>
            @endif
            </tbody>
        </table>

            {{ $orders->withQueryString()->links('vendor.pagination.products_pagination') }}

    </main>
@endsection
