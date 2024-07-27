@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Ожидаемые товары</h5>
@endsection

@section('styles')

@endsection

@section('content')

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">


            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Ожидаемые товары</h3>
                    </div>
                </div>
                <div class="card-body pb-3">

                    <div class="col-3 d-flex flex-column mb-4">
                        <label>Товар</label>
                        <div class="input-group input-group-sm">
                            <select class="form-control status" id="filterProductSelect" onchange="location.href = '{{ route('admin.product-availability-waiters.index', ['product_id' => '']) }}' + this.value">
                                <option value="">Все</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center">
                            <thead>
                            <tr>
                                <th class="pl-0 text-center">
                                    #
                                </th>
                                <th class="text-center pr-0">
                                    Товар
                                </th>
                                <th class="text-center pr-0">
                                    Имя
                                </th>
                                <th class="text-center pr-0">
                                    Email
                                </th>
                                <th class="text-center pr-0">
                                    Пользователь
                                </th>
                                <th class="text-center pr-0">
                                    Дата добавления
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productAvailabilityWaiters as $productAvailabilityWaiter)
                                <tr id="gift_card_{{ $productAvailabilityWaiter->id }}" data-id="{{ $productAvailabilityWaiter->id }}">
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $productAvailabilityWaiter->id }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            <a href="{{ route('products.product', ['alias' => $productAvailabilityWaiter->product->alias]) }}" target="_blank">{{ $productAvailabilityWaiter->product->title }}</a>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $productAvailabilityWaiter->name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $productAvailabilityWaiter->email }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($productAvailabilityWaiter->user)
                                        <span class="text-dark-75 d-block font-size-lg">
                                            <a href="{{ route('admin.user.show', $productAvailabilityWaiter->user) }}" target="_blank">{{ $productAvailabilityWaiter->user->name }}</a>
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $productAvailabilityWaiter->created_at->format('H:i d.m.y') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $productAvailabilityWaiters->withQueryString()->links('vendor.pagination.super_admin_pagination') }}
                    <!--end::Table-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->

@endsection

@section('js_after')
@endsection

