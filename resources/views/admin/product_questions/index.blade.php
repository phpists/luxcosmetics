@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Вопросы по товарам</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Главная</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.product_questions') }}" class="text-muted">Вопросы по товарам</a>
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

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">

            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card gutter-b col-lg-12 ml-0">
                    @include('admin.product_questions.parts.filter')
                </div>
                @include('admin.layouts.includes.messages')
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Вопросы</h3>
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
{{--                                    </span>Активировать--}}
{{--                                </button>--}}
{{--                            </div>--}}
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::QUESTIONS_EDIT))
                            <div class="dropdown dropdown-inline mr-2">
                                <button class="btn btn-success font-weight-bolder deactivateChat" data-status="{{\App\Models\FeedbackChat::CLOSED}}">
                                    <span class="svg-icon svg-icon-md"><i class="fas fa-toggle-off"></i></span>Закрыть
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body pb-3" id="table-container">
                        <!--begin::Table-->
                        @include('admin.product_questions.parts.table', ['questions' => $questions])
                        <!--end::Table-->
                    </div>
                    <div id="pagination">
                        {{$questions->links('vendor.pagination.super_admin_pagination')}}
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Container-->
        <!--end::Entry-->
        @include('admin.product_questions.modals.update')
    </div>
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/Sortable.js') }}"></script>
    <script src="{{ asset('super_admin/js/category.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/product_question.js') }}"></script>
@endsection


