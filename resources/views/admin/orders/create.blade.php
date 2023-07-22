@extends('admin.layouts.app')

@section('styles')
    <style>
        .tox-tinymce {
            height: 600px !important;
            width: 100%;
        }
        .select2-container--default {
            width: 100% !important;
        }
    </style>
@endsection

@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Главная</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.orders.index') }}" class="text-muted">Заказы</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.orders.create') }}" class="text-muted">Создать новый заказ</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line" style="gap: 10px">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#general">
                                    <span class="nav-text">Основная информация</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#products">
                                    <span class="nav-text">Товары</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar" style="gap: 10px; margin-bottom: 10px">
                        <button type="submit" form="orderForm" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="orderForm" action="{{ route('admin.orders.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="general" role="tabpanel">
                                @include('admin.orders.includes.form')
                            </div>
                            <div class="tab-pane fade" id="products" role="tabpanel">
                                @include('admin.orders.includes.products_table')
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>

    @include('admin.orders.includes.add_product_modal')

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/js/order.js') }}"></script>

@endsection




