@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Переклади</h5>
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
                                    Переводы
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <button data-toggle="modal" data-target="#createModal"
                                        class="btn btn-primary font-weight-bold createBtn">
                                    <i class="fas fa-plus mr-2"></i> Добавить
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
                                            Название
                                        </th>
                                        <th class="pr-0 text-center">
                                           Перевод
                                        </th>
                                        <th class="pr-0 text-center">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($translates as $translate)
                                            <tr>
                                                <td class="handle text-center pl-0">
                                                    {{ $translate->id }}
                                                </td>
                                                <td class="handle text-center pl-0">
                                                    {{ $translate->title }}
                                                </td>
                                                <td class="text-center">
                                                    {!! $translate->translation !!}
                                                </td>
                                                <td class="text-center pr-0">
                                                    <form action="{{ route('admin.settings.translation.delete') }}" method="POST">
                                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon editTranslate"
                                                           data-toggle="modal" data-target="#updateModal"
                                                           data-id="{{ $translate->id }}">
                                                            <i class="las la-edit"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $translate->id }}">
                                                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                                onclick="return confirm('Ви впевнені, що хочете переклад?')"
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

    @include('admin.settings.translation.modals.create')
    @include('admin.settings.translation.modals.update')
@endsection

@section('js_after')
    <script>
        $(document).on('click', '.editTranslate', loadModel);

        function loadModel() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.settings.translation.show') }}',
                data: {
                    'id': id
                },
                success: function (response) {
                    $('#updateId').val(id);
                    $('#updateTitle').val(response.title);
                    $('.updateTranslation').summernote('code', response.translation);

                }, error: function (response) {
                    console.log(response)
                }
            });
        }

        $('.summernote-sm').summernote($.extend(summernoteDefaultOptions, {
            height: 300
        }));
    </script>
@endsection

