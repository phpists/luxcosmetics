@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Коментарии</h5>
                <!--end::Page Title-->
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
                <div class="card gutter-b col-lg-12 ml-0">
                    @include('admin.comments.parts.filter')
                </div>
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Коментарии</h3>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <div class="table-responsive">
                            <table class="table table-head-custom table-vertical-center">
                                <thead>
                                <tr>
                                    <th class="pr-0 text-center">#</th>
                                    <th class="pr-0 text-center">Пользователь</th>
                                    <th class="pr-0 text-center">Коментарии</th>
                                    <th class="pr-10 text-center">Статус</th>
                                    <th class="pr-0 text-center">Товар</th>
                                    <th class="pr-10 text-center">Действия</th>
                                </tr>
                                </thead>

                                <tbody id="table" class="banner-table">
                                    @include('admin.comments.parts.table', ['comments' => $comment])
                                </tbody>
                            </table>
                        </div>
                        <div id="pagination">
                            {{ $comment->appends(request()->all())->links('vendor.pagination.product_pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/Sortable.js') }}"></script>
    <script src="{{ asset('super_admin/js/comment.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endsection
