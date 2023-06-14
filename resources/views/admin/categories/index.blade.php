@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
@endsection

@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Категории</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Головна</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories') }}" class="text-muted">Категории</a>
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
    <style>

        .cf:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }

        * html .cf {
            zoom: 1;
        }

        *:first-child + html .cf {
            zoom: 1;
        }

        html {
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 100%;
            margin: 0;
            padding: 1.75em;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }

        h1 {
            font-size: 1.75em;
            margin: 0 0 0.6em 0;
        }

        a {
            color: #2996cc;
        }

        a:hover {
            text-decoration: none;
        }

        p {
            line-height: 1.5em;
        }

        .small {
            color: #666;
            font-size: 0.875em;
        }

        .large {
            font-size: 1.25em;
        }

        /**
         * Nestable Extras
         */

        .nestable-lists {
            display: block;
            clear: both;
            padding: 30px 0;
            width: 100%;
            border: 0;
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
        }

        #nestable-menu {
            padding: 0;
            margin: 20px 0;
        }

        #nestable-output,
        #nestable2-output {
            width: 100%;
            height: 7em;
            font-size: 0.75em;
            line-height: 1.333333em;
            font-family: Consolas, monospace;
            padding: 5px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        #nestable2 .dd-handle {
            color: #fff;
            border: 1px solid #999;
            background: #bbb;
            background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
            background: -moz-linear-gradient(top, #bbb 0%, #999 100%);
            background: linear-gradient(top, #bbb 0%, #999 100%);
        }

        #nestable2 .dd-handle:hover {
            background: #bbb;
        }

        #nestable2 .dd-item > button:before {
            color: #fff;
        }

        @media only screen and (min-width: 700px) {

            .dd {
                float: left;
                width: 48%;
            }

            .dd + .dd {
                margin-left: 2%;
            }

        }

        .dd-hover > .dd-handle {
            background: #2ea8e5 !important;
        }

        /**
         * Nestable Draggable Handles
         */

        .dd3-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd3-content:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .dd-dragel > .dd3-item > .dd3-content {
            margin: 0;
        }

        .dd3-item > button {
            margin-left: 30px;
        }

        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            height: 100%;
            width: 30px;
            text-indent: 30px;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .dd3-handle:before {
            content: '≡';
            display: block;
            position: absolute;
            left: 0;
            top: 3px;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: normal;
        }

        .dd3-handle:hover {
            background: #ddd;
        }

        .dd-item.dd3-item {
            margin-left: 5px;
        }

        button.dd-collapse, button.dd-expand {
            position: absolute;
            left: -60px;
            height: 20px;
            width: 30px;
            border-radius: 30px;
            font-size: 20px;
            color: #0b0b0b;
            z-index: 2;
            background: whitesmoke;

        }
    </style>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">

            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card gutter-b col-lg-12 ml-0">
                    @include('admin.categories.parts.filter')
                </div>
                @include('admin.layouts.includes.messages')
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Категории</h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
{{--                            <div class="dropdown dropdown-inline mr-2">--}}
{{--                                <button class="btn btn-danger font-weight-bolder deletedCategories">--}}
{{--                                    <span class="svg-icon svg-icon-md">--}}
{{--                                        <i class="las la-trash"></i>--}}
{{--                                    </span>Видалити--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown dropdown-inline mr-2">--}}
{{--                                <button class="btn btn-success font-weight-bolder activeCategories" data-status="1">--}}
{{--                                    <span class="svg-icon svg-icon-md">--}}
{{--                                        <i class="fas fa-toggle-on"></i>--}}
{{--                                    </span>Активувати--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown dropdown-inline mr-2">--}}
{{--                                <button class="btn btn-success font-weight-bolder activeCategories" data-status="0">--}}
{{--                                    <span class="svg-icon svg-icon-md"><i class="fas fa-toggle-off"></i></span>Деактивувати--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown dropdown-inline mr-2">--}}
{{--                                <button class="btn btn-primary font-weight-bolder">--}}
{{--                                    <span class="svg-icon svg-icon-md">--}}
{{--                                        <i class="fas fa-toggle-off"></i>--}}
{{--                                    </span>Імпортувати--}}
{{--                                </button>--}}
{{--                            </div>--}}
                            <div class="dropdown dropdown-inline mr-2">
                                <a href="{{ route('admin.category.create') }}"
                                   class="btn btn-success font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Добавить категорию
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="dd w-100" id="nestable3">
                                    <ol class="dd-list">
                                        @include('admin.categories.parts.table', ['categories' => $categories])

                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!--begin::Table-->
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-head-custom table-vertical-center">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="pl-0 text-center">--}}
{{--                                    <span style="width: 20px;">--}}
{{--                                        <label class="checkbox checkbox-single checkbox-all">--}}
{{--                                            <input id="checkbox-all" type="checkbox"--}}
{{--                                                   name="checkbox[]">&nbsp;<span></span>--}}
{{--                                        </label>--}}
{{--                                    </span>--}}
{{--                                    </th>--}}
{{--                                    <th class="pl-0 text-center">--}}
{{--                                        #--}}
{{--                                    </th>--}}
{{--                                    <th class="pr-0 text-center">--}}
{{--                                        Навзва--}}
{{--                                    </th>--}}
{{--                                    <th class="pr-0 text-center">--}}
{{--                                        Alias--}}
{{--                                    </th>--}}
{{--                                    <td class="text-center pr-0">--}}
{{--                                        Оновлено--}}
{{--                                    </td>--}}
{{--                                    <td class="text-center pr-0">--}}
{{--                                        Статус--}}
{{--                                    </td>--}}
{{--                                    <th class="pr-0 text-center">--}}
{{--                                        Дія--}}
{{--                                    </th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody id="table">--}}
{{--                                @foreach($categories as $category)--}}
{{--                                    <tr id="category_{{$category->id}}" data-id="{{ $category->id }}">--}}
{{--                                        <td class="text-center pl-0">--}}
{{--                                            <span style="width: 20px;">--}}
{{--                                                <label class="checkbox checkbox-single">--}}
{{--                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"--}}
{{--                                                           value="{{ $category->id }}">&nbsp;<span></span>--}}
{{--                                                </label>--}}
{{--                                            </span>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-center pl-0">--}}
{{--                                            {{ $category->id }}--}}
{{--                                        </td>--}}
{{--                                        <td class="text-center pr-0">--}}
{{--                                            {{ $category->title }}--}}
{{--                                        </td>--}}
{{--                                        <td class="text-center pr-0">--}}
{{--                                            {{ $category->alias }}--}}
{{--                                        </td>--}}
{{--                                        <td class="text-center pr-0">--}}
{{--                                            {{ $category->created_at->format('m Y, H:i:s') }}--}}
{{--                                        </td>--}}
{{--                                        <td class="text-center pr-0 status">--}}
{{--                                            {{ \App\Services\SiteService::getStatus($category->status) }}--}}
{{--                                        </td>--}}
{{--                                        <td class="text-center pr-0">--}}
{{--                                            <i class="handle flaticon2-sort" style="cursor:pointer;"></i>--}}
{{--                                            <a href="{{ route('admin.category.edit', $category->id) }}"--}}
{{--                                               class="btn btn-sm btn-clean btn-icon">--}}
{{--                                                <i class="las la-edit"></i>--}}
{{--                                            </a>--}}
{{--                                            <a href="{{ route('admin.category.delete', $category->id) }}"--}}
{{--                                               class="btn btn-sm btn-clean btn-icon"--}}
{{--                                               onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">--}}
{{--                                                <i class="las la-trash"></i>--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div id="pagination">--}}
{{--                            {{ $categories->appends(request()->all())->links('vendor.pagination.category_pagination') }}--}}
{{--                        </div>--}}
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Container-->
        <!--end::Entry-->

    </div>
@endsection

@section('js_after')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script>
        let csrf = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': csrf}});
        $('.dd').nestable({
            callback: function(l,e){
                $.ajax({
                    url: '{{route('admin.categories.updatePosition')}}',
                    method: "POST",
                    data: {
                        data: l.nestable('toArray')
                    },
                    success: function (resp) {
                        console.log(resp);
                    }
                })
            }
        });

    </script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/category.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endsection


