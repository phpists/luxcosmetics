@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Курьерская доставка</h5>
@endsection

@section('styles')

@endsection

@section('content')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>

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
                        <h3 class="card-label">Курьерская доставка</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button data-toggle="modal" data-target="#createModal"
                                    class="btn btn-primary font-weight-bold">
                                <i class="fas fa-plus mr-2"></i>Создать
                            </button>
                        </div>
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
                                    Название
                                </th>
                                <th class="text-center pr-0">
                                    Служба
                                </th>
                                <th class="pr-0 text-center">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($models as $model)
                                <tr id="gift_card_{{ $model->id }}" data-id="{{ $model->id }}">
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $model->id }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $model->title }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $model->deliveryMethod->title }}
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-edit"
                                           data-toggle="modal" data-target="#editModal"
                                           data-show-url="{{ route('admin.courier-delivery-methods.show', $model) }}"
                                           data-update-url="{{ route('admin.courier-delivery-methods.update', $model) }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.courier-delivery-methods.destroy', $model) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                    onclick="return confirm('Вы уверенны?')"
                                                    title="Delete"><i class="las la-trash"></i>
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
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->

    @include('admin.settings.courier-delivery-methods.modals.create')
    @include('admin.settings.courier-delivery-methods.modals.edit')
@endsection

@section('js_after')
    <script>
        const SUGGEST_API_KEY = '05c41b12-223c-47e0-a0df-9403b108f3cd';
        const SEARCH_API_KEY = 'd46bfdd1-d9ca-4f94-959e-5c09d2a427e1';

        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $('.select2-tags').select2({
                placeholder: "Добавьте страну",
                tags: true
            });


            $(".select2-states").select2({
                placeholder: "Добавьте области",
                ajax: {
                    url: "/admin/get-states",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            apikey: SUGGEST_API_KEY,
                            types: 'province',
                            text: params.term
                        };
                    },
                    processResults: function(result, params) {
                        return {
                            results: result.map((item) => {
                                return {
                                    text: item,
                                    id: item
                                }
                            }),
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
            });

            $(".select2-cities").select2({
                placeholder: "Добавьте города",
                ajax: {
                    url: "/admin/get-cities",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            apikey: SUGGEST_API_KEY,
                            types: 'locality',
                            text: params.term
                        };
                    },
                    processResults: function(result, params) {
                        return {
                            results: result.map((item) => {
                                return {
                                    text: item,
                                    id: item
                                }
                            }),
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
            });



            $(document).on('change', '.delivery-method', function(e) {
                $(this)
                    .parents('form:first')
                    .find('input[name="prefix"]')
                    .val($(this).find('option:selected')?.data('prefix') ?? '')
            })






        })


        $(document).on('click', '.btn-edit', loadModel);

        function loadModel() {
            let updateUrl = $(this).data('update-url')

            $.ajax({
                url: $(this).data('show-url'),
                dataType: 'json',
                success: function (response) {
                    let $form = $('#editModal form');

                    $form.attr('action', updateUrl)

                    $form.find('#editCountries').html('')
                    $form.find('#editStates').html('')
                    $form.find('#editCities').html('')

                    for (let attr in response) {
                        if (Array.isArray(response[attr])) {
                            response[attr].forEach(item => {
                                $form.find(`[name="${attr}[]"]`)
                                    .append(`<option value="${item}" selected>${item}</option>`)
                                    .trigger('change');
                            })
                        } else {
                            $form.find(`[name="${attr}"]`)?.val(response[attr]).trigger('change')
                        }
                    }
                }
            });
        }

    </script>
@endsection

