@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">SEO шаблоны</h5>
@endsection

@section('styles')

@endsection

@section('content')

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">

            @include('admin.layouts.includes.messages')
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">SEO шаблоны</h3>
                    </div>
                </div>
                <div class="card-body pb-3">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center">
                            <thead>
                            <tr>
                                <th class="pl-0 text-center">
                                    #
                                </th>
                                <th class="text-center pr-0">
                                    Тип
                                </th>
                                <th class="text-center pr-0">
                                    Title
                                </th>
                                <th class="pr-0 text-center">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($seoTemplates as $seoTemplate)
                                <tr id="gift_card_{{ $seoTemplate->id }}" data-id="{{ $seoTemplate->id }}">
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $loop->index }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $seoTemplate->type }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $seoTemplate->title }}
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit"
                                           data-toggle="modal" data-target="#editSeoTemplateModal"
                                           data-url="{{ route('admin.seo-templates.show', $seoTemplate) }}"
                                            data-update-url="{{ route('admin.seo-templates.update', $seoTemplate) }}">
                                            <i class="las la-edit"></i>
                                        </a>
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

    @include('admin.seo-templates.modals.edit')
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        })

        $(document).on('click', '.btn_edit', function (e) {
            let updateUrl = $(this).data('update-url');

            $.ajax({
                url: $(this).data('url'),
                dataType: 'json',
                success: function (response) {
                    $('#editSeoTemplateForm').attr('action', updateUrl);

                    $('#editSeoTemplateTitle').val(response.title);
                    $('#editSeoTemplateDescription').val(response.description);
                    $('#editSeoTemplateHint').val(response.hint);

                }, error: function (response) {
                    console.log(response)
                }
            });
        });

    </script>
@endsection

