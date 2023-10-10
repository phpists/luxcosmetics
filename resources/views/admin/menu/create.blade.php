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
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="">Сгенерировать ссылку на категорию автоматически?</label>
                                            <div class="">
                                                <span class="switch">
                                                    <label>
                                                        <input type="checkbox" checked id="static_check" name="select"/>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Категория</label>
                                            <select class="form-control select2" id="cat_select"
                                                    name="category_id" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Ссылка</label>
                                            <input type="text" id="link" name="link" class="form-control" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Родительский пункт меню</label>
                                            <select class="form-control" id="menu_select" name="parent_id">
                                                <option></option>
                                                @foreach($menu_items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
        $("#menu_select").select2(
            {
                placeholder: "Родительский пункт меню",
                allowClear: true
            }
        );
        $('#static_check').on('change', function (ev) {
            if (ev.currentTarget.checked) {
                $('#cat_select').attr('disabled', false)
                $('#link').attr('disabled', true)
                $('#cat_select').attr('required', false)
                $('#link').attr('required', true)
            }
            else {
                $('#cat_select').attr('disabled', true)
                $('#link').attr('disabled', false)
                $('#cat_select').attr('required', true)
                $('#link').attr('required', false)
            }
        })
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $(document).ready(function () {
            let cat_select = $('#cat_select');
            cat_select.select2({
                placeholder: 'Выберите категорию',
                ajax: {
                    url: '{{route('admin.categories.search')}}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'public'
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function (data) {
                        data = data.map((x) => {
                            return {
                                text: x.name, id: x.id
                            }
                        })
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data
                        };
                    }
                },
                minimumInputLength: 1
            });


        })
    </script>
@endsection




