@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Банери</h5>
@endsection
@section('styles')
    <style>
        .image-input-wrapper {
            width: 80px !important;
            height: 80px !important;
            background-position: center !important;
        }
    </style>
@endsection
@section('content')


    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Банери
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <button data-toggle="modal" data-target="#createModal"
                                        class="btn btn-primary font-weight-bold createBtn">
                                    <i class="fas fa-plus mr-2"></i> Додати
                                </button>
                            </div>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body pb-3">

                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table id="networkTable" class="table table-head-custom table-vertical-center">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 text-center">
                                            #
                                        </th>
                                        <th class="pr-0 text-center">
                                            Назва
                                        </th>
                                        <th class="pr-0 text-center">
                                            Заголовок
                                        </th>
                                        <th class="pr-0 text-center">
                                            Посилання
                                        </th>
                                        <th class="pr-0 text-center">
                                            Колір
                                        </th>
                                        <th class="pr-0 text-center">
                                            Статус
                                        </th>
                                        <th class="pr-0 text-center">
                                            Дії
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banners as $banner)
                                        <tr>
                                            <td class="handle text-center pl-0">
                                                {{ $banner->id }}
                                            </td>
                                            <td class="text-center">
                                                {{ $banner->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $banner->title }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ $banner->link }}" target="_blank" class="d-block font-size-lg">
                                                    {{ $banner->link }}
                                                    <i class="ml-2 fas fa-external-link-alt"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <span style="color: {{ $banner->color }}">{{ $banner->color }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{ $banner->status == true ? 'Активний' : 'Деактивований' }}
                                            </td>
                                            <td class="text-center pr-0">
                                                <form action="{{ route('admin.settings.banner.delete') }}" method="POST">
                                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon editBanner"
                                                       data-toggle="modal" data-target="#updateModal"
                                                       data-id="{{ $banner->id }}">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $banner->id }}">
                                                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                            onclick="return confirm('Ви впевнені, що хочете банер?')"
                                                            title="Видалити"><i class="las la-trash"></i>
                                                    </button>
                                                </form>
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

            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->

    @include('admin.settings.banners.modals.create')
    @include('admin.settings.banners.modals.update')
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        $(document).on('click', '.editBanner', loadModel);

        function loadModel() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.settings.banner.show') }}',
                data: {
                    'id': id
                },
                success: function (response) {
                    $('#updateId').val(id);
                    $('#updateName').val(response.name);
                    $('#updateTitle').val(response.title);
                    $('#updateSubTitle').val(response.sub_title);
                    $('#updateLink').val(response.link);
                    $('#updateColor').val(response.color);
                    document.getElementById('updateStatus').checked = (response.status == 1);
                    $('#updateBannerCategories').select2();
                    // $('#kt_select2_3').trigger('change.select2');
                    let categories = [];
                    $.each(response.categories, function(i, item) {
                        categories.push(item.category_id);
                    })


                    // console.log(categories)
                    // $.each(categories, function(i, category_id) {
                    //
                    //     $('#kt_select2_3 option[value="'+category_id+'"]').prop('selected', true)
                    //     console.log($('#kt_select2_3 option[value="'+category_id+'"]'))
                    // })
                    $('#updateBannerCategories').val(categories);
                    $('#updateBannerCategories').trigger('change');

                }, error: function (response) {
                    console.log(response)
                }
            });
        }
    </script>
@endsection

