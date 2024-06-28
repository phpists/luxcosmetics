@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Модуль ценников</h5>
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
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>

    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">

            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-body">
                    <div class="row justify-content-end">
                        @if(auth()->user()->isSuperAdmin())
                            <button data-toggle="modal" data-target="#createProductPriceModal"
                                    class="btn btn-success font-weight-bolder mx-5">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Добавить условие
                            </button>
                        @endif
                    </div>
                    <hr class="my-8">
                    <div id="content">
                        @include('admin.product-prices._table')
                    </div>

                    @include('admin.product-prices._create')
                    @include('admin.product-prices._edit')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/jquery.pjax.js') }}"></script>
    <script src="{{ asset('super_admin/js/select2.ru.js') }}"></script>
    <script>
        let arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }

        $(function () {
            $('.select2').select2({
                language: 'ru'
            });

            $('#createDateRange').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                templates: arrows
            });
            $('#editDateRange').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                templates: arrows
            });

            $(document).on('click', '.btn_edit', function (e) {
                let showUrl = $(this).data('show-url'),
                    updateUrl = $(this).data('update-url');

                $.ajax({
                    url: showUrl,
                    dataType: 'json',
                    success: function (response) {
                        $('#editProductPriceForm').attr('action', updateUrl);

                        $('#editProductPriceTitle').val(response.title)
                        $('#editProductPriceIsActive').attr('checked', response.is_active === 1)
                        $('#editProductPriceType').val(response.type).trigger('change')
                        $('#editProductPriceAmount').val(response.amount)
                        $('#editProductPriceRounding').val(response.rounding)
                        $('#editProductPriceStartDate').val(response.start_date)
                        $('#editProductPriceEndDate').val(response.end_date)

                        $('#editProductPriceBrand').val(response.case_brands).trigger('change')
                        $('#editProductPriceCategory').val(response.case_categories).trigger('change')
                        $('#editProductPriceProduct').val(response.case_products).trigger('change')

                        $('#editProductPriceExceptBrand').val(response.except_brands).trigger('change')
                        $('#editProductPriceExceptCategory').val(response.except_categories).trigger('change')
                        $('#editProductPriceExceptProduct').val(response.except_products).trigger('change')
                    }, error: function (response) {
                        console.log(response)
                    }
                });
            });

            $(document).on('change', '.active_switch', function(e) {
                let switch_input = this,
                    status = switch_input.checked;

                let data = {
                    id: switch_input.dataset.id,
                }

                if (status) {
                    data.is_active = true
                }

                $.ajax({
                    url: '{{ route('admin.product-prices.update-status') }}',
                    method: "POST",
                    data: data,
                    success: function (data) {
                        switch_input.checked = status
                    },
                    error: function () {
                        switch_input.checked = !status
                    }
                })

            })
        })
    </script>
@endsection


