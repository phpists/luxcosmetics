@extends('admin.layouts.app')

@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Заказы</h5>
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


                <div class="row">
                    <div class="col-xl-3">
                        <!--begin::Stats Widget 25-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="d-flex">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Calculator.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="4" width="10" height="4"/>
                                        <path
                                            d="M7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,20 C19,21.1045695 18.1045695,22 17,22 L7,22 C5.8954305,22 5,21.1045695 5,20 L5,4 C5,2.8954305 5.8954305,2 7,2 Z M8,12 C8.55228475,12 9,11.5522847 9,11 C9,10.4477153 8.55228475,10 8,10 C7.44771525,10 7,10.4477153 7,11 C7,11.5522847 7.44771525,12 8,12 Z M8,16 C8.55228475,16 9,15.5522847 9,15 C9,14.4477153 8.55228475,14 8,14 C7.44771525,14 7,14.4477153 7,15 C7,15.5522847 7.44771525,16 8,16 Z M12,12 C12.5522847,12 13,11.5522847 13,11 C13,10.4477153 12.5522847,10 12,10 C11.4477153,10 11,10.4477153 11,11 C11,11.5522847 11.4477153,12 12,12 Z M12,16 C12.5522847,16 13,15.5522847 13,15 C13,14.4477153 12.5522847,14 12,14 C11.4477153,14 11,14.4477153 11,15 C11,15.5522847 11.4477153,16 12,16 Z M16,12 C16.5522847,12 17,11.5522847 17,11 C17,10.4477153 16.5522847,10 16,10 C15.4477153,10 15,10.4477153 15,11 C15,11.5522847 15.4477153,12 16,12 Z M16,16 C16.5522847,16 17,15.5522847 17,15 C17,14.4477153 16.5522847,14 16,14 C15.4477153,14 15,14.4477153 15,15 C15,15.5522847 15.4477153,16 16,16 Z M16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 C15.4477153,18 15,18.4477153 15,19 C15,19.5522847 15.4477153,20 16,20 Z M8,18 C7.44771525,18 7,18.4477153 7,19 C7,19.5522847 7.44771525,20 8,20 L12,20 C12.5522847,20 13,19.5522847 13,19 C13,18.4477153 12.5522847,18 12,18 L8,18 Z M7,4 L7,8 L17,8 L17,4 L7,4 Z"
                                            fill="#000000"/>
                                    </g>
                                    </svg><!--end::Svg Icon--></span>
                                    <span class="card-title text-dark-75 font-size-h3 mb-0 ml-3">За всё время</span>
                                </div>
                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">₽{{ $total_sum }}</span>
                                <span
                                    class="font-weight-bold text-muted  font-size-sm">Общая сумма завершенных заказов</span>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 25-->
                    </div>
                    <div class="col-xl-3">
                        <!--begin::Stats Widget 26-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::ody-->
                            <div class="card-body">
                                <div class="d-flex">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Chart-bar1.svg--><svg
        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
        viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"/>
        <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"/>
        <path
            d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
            fill="#000000" fill-rule="nonzero"/>
        <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                    <span class="card-title text-dark-75 font-size-h3 mb-0 ml-3">За месяц</span>
                                </div>
                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">₽{{ $total_sum_current_month }}</span>
                                <span class="font-weight-bold text-muted font-size-sm">Общая сумма завершенных заказов от начала месяца</span>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 26-->
                    </div>
                    <div class="col-xl-3">
                        <!--begin::Stats Widget 27-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="d-flex">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Thunder-move.svg--><svg
        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
        viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z"
            fill="#000000"/>
        <path
            d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z"
            fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                    <span class="card-title text-dark-75 font-size-h3 mb-0 ml-3">За сегодня</span>
                                </div>
                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">₽{{ $total_sum_today }}</span>
                                <span class="font-weight-bold text-muted  font-size-sm">Общая сумма завершенных заказов за сегодня</span>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 27-->
                    </div>
                    <div class="col-xl-3">
                        <!--begin::Stats Widget 27-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="d-flex">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Text/Filter.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                    <span class="card-title text-dark-75 font-size-h3 mb-0 ml-3">Фильтр</span>
                                </div>
                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">₽<span id="filteredTotalSum" class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6">{{ $current_sum }}</span></span>
                                <span class="font-weight-bold text-muted  font-size-sm">Общая сумма отфильтрованных заказов</span>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 27-->
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Заказы
                                </h3>
                                <div class="card-toolbar">
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary font-weight-bolder mr-5">Сбросить фильтр</a>

                                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::ORDERS_CREATE))
                                    <a href="{{ route('admin.orders.create') }}"
                                       class="btn btn-success font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Создать заказ
                                    </a>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body pb-3">
                                <form id="filter">
                                    <input type="hidden" name="per_page" value="{{ request()->get('per_page') }}">
                                    <div class="row">
                                        <div class="col col-md-2">
                                            <div class="form-group">
                                                <label>Статус</label>
                                                <select name="status_id[]" class="form-control selectpicker" multiple>
                                                    @foreach($statuses as $status)
                                                        <option value="{{ $status->id }}"
                                                                data-content="<i class='fas fa-circle mr-2' style='color: {{ $status->color }}'></i>{{ $status->title }}" @selected(is_array(request()->get('status_id')) && in_array($status->id, request()->get('status_id')))>{{ $status->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-2">
                                            <div class="form-group">
                                                <label>Покупатель</label>
                                                <input type="text" name="customer" class="form-control" value="{{ request()->get('customer') }}"/>
                                                <span class="form-text text-muted">Email, имя, телефон</span>
                                            </div>
                                        </div>
                                        <div class="col col-md-2">
                                            <div class="form-group">
                                                <label>Сумма от/до</label>
                                                <div class="row row-cols-1 row-cols-md-2">
                                                    <div class="col pr-0">
                                                        <input type="text" name="sum_from" class="form-control rounded-right-0" value="{{ request()->get('sum_from') }}"/>
                                                    </div>
                                                    <div class="col pl-0">
                                                        <input type="text" name="sum_to" class="form-control rounded-left-0" value="{{ request()->get('sum_to') }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-2">
                                            <div class="form-group">
                                                <label>Скидка от/до</label>
                                                <div class="row row-cols-1 row-cols-md-2">
                                                    <div class="col pr-0">
                                                        <input type="text" name="discount_from" class="form-control rounded-right-0" value="{{ request()->get('discount_from') }}"/>
                                                    </div>
                                                    <div class="col pl-0">
                                                        <input type="text" name="discount_to" class="form-control rounded-left-0" value="{{ request()->get('discount_to') }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-2">
                                            <div class="form-group">
                                                <label>Дата от/до</label>
                                                <div class="row row-cols-1 row-cols-md-2">
                                                    <div class="col pr-0">
                                                        <input type="date" name="date_from" class="form-control rounded-right-0" value="{{ request()->get('date_from') }}"/>
                                                    </div>
                                                    <div class="col pl-0">
                                                        <input type="date" name="date_to" class="form-control rounded-left-0" value="{{ request()->get('date_to') }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div id="content">
                                    @include('admin.orders.includes.table')
                                </div>
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
            </div>
        </div>
    </div>


            @endsection

            @section('js_after')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.uk.min.js"></script>
                <script src="{{ asset('super_admin/js/jquery.pjax.js') }}"></script>
                <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
                <script src="{{ asset('super_admin/js/users.js') }}"></script>
                <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
                <script>
                    let filterTimeout;

                    $(function () {
                        $(document).on('change', 'select.change-status', function (e) {
                            let $this = $(this),
                                url = $(this).data('url'),
                                value = $(this).val();

                            $.ajax({
                                url: url,
                                type: 'PUT',
                                dataType: 'json',
                                data: {
                                    status_id: value
                                },
                                success: function (response) {
                                    if (response && response.completed)
                                        $this.prop('disabled', true).next().addClass('disabled')
                                }
                            })
                        })


                        $(document).on('change', "#filter", function (e) {
                            filter.call(this)
                        })

                        $(document).on('input', "#filter", function (e) {
                            clearTimeout(filterTimeout)
                            let $this = this

                            filterTimeout = setTimeout(function () {
                                filter.call($this)
                            }, 1000)
                        })

                        $(document).pjax('[data-pjax]', '#content')

                        $(document).on('pjax:end', function(e) {
                            $('.selectpicker').selectpicker()
                            $('#paginate').val($('#filter [name="per_page"]').val())
                            $('#filteredTotalSum').text($('#filteredTotalSumValud').val())
                        })

                        $(document).on('change', '#paginate', function (e) {
                            $('#filter [name="per_page"]').val(this.value).trigger('change')
                        })

                    })

                    function filter() {
                        let $form = $(this);
                        console.log($form.serialize())
                        $.pjax.reload({
                            container: '#content',
                            url: location.pathname + '?' + $form.serialize()
                        })
                    }

                </script>
@endsection


