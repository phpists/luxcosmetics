@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Головна</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories') }}" class="text-muted">Категорії</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.category.show', $category->id) }}"
                           class="text-muted">{{ $category->title }}</a>
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
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline mr-2 mb-6">
                        <a href="{{ route('admin.category.edit', $category->id) }}"
                           class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md"></span>Редактировать
                        </a>
                    </div>
                    <div class="dropdown dropdown-inline mr-2 mb-6">
                        <a href="{{ route('admin.category.delete', $category->id) }}"
                           class="btn btn-danger font-weight-bolder"
                           onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                            <span class="svg-icon svg-icon-md"></span>Удалить
                        </a>
                    </div>
                </div>
            </div>
            <div class="card card-custom">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <th>{{ $category->id }}</th>
                                </tr>
                                <tr>
                                    <th>Ref Key</th>
                                    <th>{{ $category->key }}</th>
                                </tr>
                                <tr>
                                    <th>Назва</th>
                                    <th>{{ $category->title }}</th>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <th>{!! $category->description !!}</th>
                                </tr>
                                <tr>
                                    <th>Alias</th>
                                    <th>{{ $category->alias }}</th>
                                </tr>
                                <tr>
                                    <th>Position</th>
                                    <th>{{ $category->position }}</th>
                                </tr>
                                <tr>
                                    <th>Обнавлено</th>
                                    <th>{{ $category->updated_at->format('m Y, H:i:s') }}</th>
                                </tr>
                                <tr>
                                    <th>Создано</th>
                                    <th>{{ $category->created_at->format('m Y, H:i:s') }}</th>
                                </tr>
                                <tr>
                                    <th>Status Detail</th>
                                    <th>{{ \App\Services\SiteService::getStatus($category->status) }}</th>
                                </tr>
                                <tr>
                                    <th>Custom Label 0</th>
                                    <th>{{ $category->custom_label_0 }}</th>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <th @if(!$category->prcie) style="color: red" @endif>{{ $category->prcie ?? '(не задано)' }}</th>
                                </tr>
                                <tr>
                                    <th>Путь</th>
                                    <th style="color: red">(не задано)</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->


@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endsection




