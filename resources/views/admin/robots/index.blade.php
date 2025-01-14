@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Robots.txt</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection

@section('styles')
@endsection

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">

            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-body">
                    <div class="row justify-content-end">
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::ROBOTS_EDIT))
                            <button type="submit" form="robotsForm"
                                    class="btn btn-success font-weight-bolder mx-5">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fas fa-plus"></i>
                                    </span>Сохранить
                            </button>
                        @endif
                    </div>
                    <hr class="my-8">
                    <div id="content">
                        <form id="robotsForm" action="{{ route('admin.robots.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <textarea name="content" class="form-control" rows="40">{{ $content }}</textarea>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js_after')
@endsection


