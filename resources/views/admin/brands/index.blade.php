@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Бренды</h5>
@endsection

@section('styles')
    <style>
        .image-input-wrapper {
            width: 170px!important;
            height: 170px!important;
            background-size: auto!important;
            background-position: center!important;
        }
    </style>
@endsection

@section('content')


    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">

            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Бренды</h3>
                    </div>
                    <div class="card-toolbar">
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BRANDS_CREATE))
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button data-toggle="modal" data-target="#createModal" class="btn btn-primary font-weight-bold">
                                <i class="fas fa-plus mr-2"></i>Добавить
                            </button>
                        </div>
                        @endif

                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BRANDS_DELETE))
                        <div class="dropdown dropdown-inline mr-2">
                            <button class="btn btn-danger font-weight-bolder deletedCares">
                                <span class="svg-icon svg-icon-md"><i class="las la-trash"></i></span>Удалить
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pb-3">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center">
                            <thead>
                            <tr>
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BRANDS_DELETE))
                                <th class="pl-0 text-center">
                                    <span style="width: 20px;">
                                        <label class="checkbox checkbox-single checkbox-all">
                                            <input id="checkbox-all" type="checkbox"
                                                   name="checkbox[]">&nbsp;<span></span>
                                        </label>
                                    </span>
                                </th>
                                @endif
                                <th class="pl-0 text-center">
                                    #
                                </th>
                                <th class="pr-0 text-center">
                                    Изображение
                                </th>
                                <th class="text-center pr-0">
                                    Название
                                </th>
                                <th class="pr-0 text-center">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr id="care_{{$brand->id}}" data-id="{{ $brand->id }}">
                                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BRANDS_DELETE))
                                    <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $brand->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
                                    </td>
                                    @endif
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $brand->id }}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ $brand->getImageSrcAttribute() }}" height="48">
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $brand->name }}
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BRANDS_EDIT))
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit"
                                               data-toggle="modal" data-target="#updateModal"
                                               data-id="{{ $brand->id }}">
                                                <i class="las la-edit"></i>
                                            </a>
                                        @endif
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::BRANDS_DELETE))
                                            <form action="{{ route('admin.brands.delete', app()->getLocale()) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $brand->id }}">
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                    onclick="return confirm('Ви впевнені, що хочете видалити спосіб доставки {{ $brand->title }}?')"
                                                    title="Delete"><i class="las la-trash"></i>
                                            </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->

    @include('admin.brands.modals.create')
    @include('admin.brands.modals.update')
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var createImagePlugin = new KTImageInput('createImagePlugin');
            var createPageImagePlugin = new KTImageInput('createPageImagePlugin');
            var updateImagePlugin = new KTImageInput('updateImagePlugin');
            var updatePageImagePlugin = new KTImageInput('updatePageImagePlugin');

            let tbody = document.querySelector('tbody')

            $('#statusBtn').on('change', function(){
                this.value = this.checked ? 1 : 0;
                // alert(this.value);
            }).change();
            $('#updateStatusBtn').on('change', function(){
                this.value = this.checked ? 1 : 0;
                // alert(this.value);
            }).change();

        })


        $(document).on('click', '.btn_edit', loadModel);

        function loadModel() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.brands.show') }}',
                data: {
                    'id': id
                },
                success: function (response) {
                    $('#updateId').val(response.id);
                    $('#updateName').val(response.name);
                    $('#updateLink').val(response.link);
                    let image_url = 'url("{{ asset('images/uploads/brands/') }}/' + response.image + '")';
                    $('#updateImageBackground').css('background-image', image_url);

                }, error: function (response) {
                    console.log(response)
                }
            });
        }

        function deleteImage() {
            let brandId = $('#updateId').val();
            console.log(brandId)
        if (confirm('Вы уверены, что хотите удалить изображение?')) {
            $.ajax({
                url: '/admin'+'/brands/' + brandId + '/deleteImage',
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload()
                    showSuccessMessage('Фотография успешно удалена');
                },
                error: function() {
                    showErrorMessage('Ошибка при удалении фотографии');
                }
            });
        }
    }
    </script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/care.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
@endsection

