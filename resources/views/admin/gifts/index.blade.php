@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Подарки</h5>
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

    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#gift_products">
                                    <span class="nav-text">Подарочные товары</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#conditions">
                                    <span class="nav-text">Условия</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="gift_products" role="tabpanel"
                             aria-labelledby="gift_products">
                            <div class="row justify-content-between">
                                <div class="col-md-4 col-12">
                                    <input id="searchGiftProducts" class="form-control" type="search" name="search" placeholder="Поиск..." value="{{ request()->input('search') }}">
                                </div>
                                <button data-toggle="modal" data-target="#createGiftProductModal"
                                   class="btn btn-success font-weight-bolder mx-5">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Добавить товар
                                </button>
                            </div>
                            <hr class="my-8">
                            <div id="content">
                                @include('admin.gifts.products.table')
                            </div>

                            @include('admin.gifts.products._create')
                            @include('admin.gifts.products._edit')
                        </div>

                        <div class="tab-pane fade" id="conditions" role="tabpanel"
                             aria-labelledby="conditions">
                            <div class="row justify-content-end">
                                <button data-toggle="modal" data-target="#createGiftConditionModal"
                                        class="btn btn-success font-weight-bolder mx-5">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Добавить условие
                                </button>
                            </div>
                            <hr class="my-8">
                            <div id="content">
                                @include('admin.gifts.conditions.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/jquery.pjax.js') }}"></script>
    <script>
        let filterTimeout;

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let createGiftProductImgPlugin = new KTImageInput('createGiftProductImg');
            let editGiftProductImgPlugin = new KTImageInput('editGiftProductImg');

            $(document).on('change', '.is-available-edit', function(e) {
                let name = $(this).attr('name'),
                    value = this.checked,
                    data = {};

                if (value)
                    data[name] =  value

                $.ajax({
                    type: 'PUT',
                    url: $(this).data('url'),
                    dataType: 'json',
                    data: data
                })
            })


            $(document).pjax('[data-pjax]', '#content')

            $(document).on('input', "#searchGiftProducts", function (e) {
                let url = $(this).data('url')
                clearTimeout(filterTimeout)
                filterTimeout = setTimeout(function () {
                    filter(url)
                }, 1000)
            })


            $(document).on('click', '.btn_edit', function (e) {
                $.ajax({
                    url: $(this).data('url'),
                    dataType: 'json',
                    success: function (response) {
                        $('#editGiftProductForm').attr('action', response.update_url);

                        let image_url = `url("${response.img_src}"`;
                        $('#editGiftProductImgBackground').css('background-image', image_url);
                        $('#editGiftProductTitle').val(response.title);
                        $('#editGiftProductIsAvailable').prop('checked', response.is_available == 1);
                        $('#editGiftProductBrandId').val(response.brand_id).trigger('change');
                        $('#editGiftProductArticle').val(response.article);

                    }, error: function (response) {
                        console.log(response)
                    }
                });
            });
        })

        function filter() {
            $.pjax.reload({
                container: '#content',
                url: location.pathname + '?search=' + $('#searchGiftProducts').val()
            })
        }

    </script>
@endsection


