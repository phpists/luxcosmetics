@extends('admin.layouts.app')
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
                        <a href="{{ route('admin.categories') }}" class="text-muted">Меню</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.category.create') }}" class="text-muted">Создание меню</a>
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
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        Создание Меню
                    </h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                            <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="{{$menu_type}}">
                    <input type="hidden" name="position" value="{{$pos}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
{{--                                    <div class="col-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Тип меню</label>--}}
{{--                                            <select class="form-control status" id="kt_select2_1" name="type">--}}
{{--                                                <option value="{{\App\Models\Menu::TOP_MENU}}">{{\App\Services\SiteService::getMenuType(\App\Models\Menu::TOP_MENU)}}</option>--}}
{{--                                                <option value="{{\App\Models\Menu::FOOTER_MENU}}">{{\App\Services\SiteService::getMenuType(\App\Models\Menu::FOOTER_MENU)}}</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Ссылка</label>
                                            <input type="text" name="link" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Родительская категория</label>
                                            <select class="form-control select2" id="cat_select" name="parent_id">
                                                <option></option>
                                                @foreach($menu_items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Название</label>
                                            <input type="text" name="title" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" @if($item->is_active) checked @endif name="is_active" id="updateActive">
                                                    <span></span>
                                                    Показать на сайте
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>

        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->


@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script>
        $("#cat_select").select2(
            {
                placeholder: "Категория",
                allowClear: true
            }
        );
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection




