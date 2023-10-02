@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Подписчики</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">

            <!--begin::Container-->
            <div class="container-fluid">
                @include('admin.layouts.includes.messages')
                <div class="card card-custom">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                        <span class="nav-text">Основное</span>
                                    </a>
                                </li>
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::SUBSCRIPTIONS_EDIT))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                        <span class="nav-text">Рассылка</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                                 aria-labelledby="kt_tab_pane_1_4">
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::SUBSCRIPTIONS_EDIT))
                                <div class="row mb-10 mt-10">
                                    <div class="col-md-12">
                                        <form>
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <h3>Обновить категорию подписки</h3>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="">Категория подписки</label>
                                                        </div>
                                                        <select class="form-control" name="subscriber_category_id" id="subscriber_category_id">
                                                            @foreach($subscription_categories as $s_category)
                                                                <option value="{{$s_category->id}}">{{$s_category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-primary" id="updCat">Обновить</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                                <div class="row mb-10">
                                    <input type="hidden" id="filterUrl" data-url="{{ route('admin.subscribers.index') }}">
                                    <form id="subscribers_form" class="w-100">
                                        <table class="table table-hover rounded ">
                                            <div class="row mb-2">
{{--                                                <div class="col-lg-3 mb-lg-0 d-flex flex-column">--}}
{{--                                                    <label>Имя</label>--}}
{{--                                                    <div class="input-group input-group-sm">--}}
{{--                                                        <input type="text" id="username_filter" name="name" class="form-control">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                                                    <label>Email</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" id="email_filter" name="email" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </table>
                                    </form>
                                </div>
                                <!--begin::Table-->
                                <div class="table-responsive" id="subscribers_table">
                                    @include('admin.subscriptions.parts.subscribers_table', ['subscribers' => $subscribers])
                                </div>
                                <div id="pagination">
                                    @include('admin.subscriptions.parts.subscribers_pagination', ['subscribers' => $subscribers])
                                </div>
                                <!--end::Table-->
                            </div>
                            <div class="tab-pane fade show" id="kt_tab_pane_2_4" role="tabpanel"
                                 aria-labelledby="kt_tab_pane_2_4">
                                <form method="POST" action="{{route('admin.subscribers.send-newsletter')}}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Тема рассылки</label>
                                                            <input type="text" name="subject" placeholder="Тема рассылки" class="form-control"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Категория подписок</label>
                                                            <select class="form-control" id="cat_select" name="category_id">
                                                                <option value="-1">Все категории</option>
                                                                @foreach($subscription_categories as $s_category)
                                                                    <option value="{{ $s_category->id }}">{{ $s_category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <textarea class="summernote" name="message"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-2">Отправить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
{{--    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>--}}
{{--    <script src="{{ asset('super_admin/js/product.js') }}"></script>--}}
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        var KTSummernoteDemo = function () {
            // Private functions
            var demos = function () {
                $('.summernote').summernote($.extend(summernoteDefaultOptions, {
                    height: 650
                }));
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();
        $(function () {
            KTSummernoteDemo.init();

            $('#checkbox-all').on('click', function (ev) {
                $('.checkbox-item').attr('checked', ev.currentTarget.checked)
            })

            $('#updCat').on('click', function (ev) {
                ev.preventDefault();
                let checkbox = Array.prototype.map.call(document.querySelectorAll('.checkbox-item:checked'), function (el, idx) {
                    return el.value;
                });
                if (checkbox.length === 0) {
                    return false;
                }
                $.ajax({
                    url: '{{route('admin.subscribers.update_category')}}',
                    method: 'POST',
                    data: {
                        checkbox: checkbox,
                        category_id: document.querySelector('select#subscriber_category_id').value
                    },
                    success: function () {
                        location.href = "";
                    }
                })
                return false;
            })
        });

        function numberSelected() {

            var data = $('#subscribers_form').serializeArray();

            var counts = [];

            data.forEach(function (element) {
                if (!counts[element.name]) {
                    counts[element.name] = 0;
                }
                counts[element.name] += 1;
            });
        }
        function request(url) {

            numberSelected();

            if (typeof url === 'undefined') {
                url = $('#filterUrl').data('url') + '?' + $('#subscribers_form').serialize();
            }

            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (response) {
                    $('#subscribers_table').html(response.tableHtml);
                    $('#pagination').html(response.paginateHtml);

                    window.history.pushState(null, null, url);
                }
            });

        }

        $(document).ready(function () {
            $(document).on('keyup', '#email_filter', function (e) {
                e.preventDefault();
                request();
            });
        });
    </script>
@endsection


