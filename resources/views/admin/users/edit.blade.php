@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Редактирования: {{ $user->email }}</h5>
                <!--end::Page Title-->
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>Основная информация</h2>
                            <form action="{{ route('admin.user.update') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="row">
                                    <div class="col px-0">
                                        <div class="form-group w-100">
                                            <label for="createShopCityTitle"
                                                   class="col-auto col-form-label font-weight-bold">Имя</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="createShopCityTitle"
                                                       name="name" value="{{ $user->name }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col px-0">
                                        <div class="form-group w-100">
                                            <label for="createShopCityTitle"
                                                   class="col-auto col-form-label font-weight-bold">Фамилия</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="createShopCityTitle"
                                                       name="surname" value="{{ $user->surname }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="createShopCityTitle" class="font-weight-bold">Email</label>
                                            <input type="text" class="form-control" id="createShopCityTitle" name="email" value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="createShopCityTitle" class="font-weight-bold">Телефон</label>
                                            <input type="text" class="form-control" id="createShopCityTitle" name="phone" value="{{ $user->phone }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="createShopCityTitle" class="font-weight-bold">Адрес</label>
                                            <input type="text" class="form-control" id="createShopCityTitle" name="address" value="{{ $user->address }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="createShopCityTitle" class="font-weight-bold">Номер карты</label>
                                            <input type="text" class="form-control" id="createShopCityTitle" name="bonus_card" value="{{ $user->bonus_card }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="editUserPoints" class="font-weight-bold">Бонусы</label>
                                            <input type="text" class="form-control" id="editUserPoints" name="points" value="{{ $user->points }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Статус в накопительной системе</label>
                                            <select class="form-control" id="editUserLoyaltyStatusId" name="loyalty_status_id">
                                                <option></option>
                                                @foreach($loyaltyStatuses as $loyaltyStatus)
                                                    <option value="{{ $loyaltyStatus->id }}" @selected($user->loyalty_status_id === $loyaltyStatus->id)>{{ $loyaltyStatus->full_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Принудительный % скидки в накопительной системе</label>
                                            <input type="text" class="form-control" id="editUserLoyaltyDiscountPercent" name="loyalty_discount_percent" value="{{ $user->custom_loyalty_discount_percent }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="col-12 col-form-label">Активировать пользователя</label>
                                            <div class="col-3">
                                                <span class="switch switch-lg">
                                                    <label>
                                                        <input type="checkbox" @if($user->is_active) checked @endif name="is_active"/>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
    <!--end::Entry-->


@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
@endsection




