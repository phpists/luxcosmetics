@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Социальные медиа</h5>
@endsection
@section('styles')
    <style>
        .image-input-wrapper {
            width: 80px!important;
            height: 80px!important;
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

            <div class="row">
                <div class="col-md-6">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon-network text-primary"></i>
                                </span>
                                <h3 class="card-label">
                                    Социальные сети
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <button data-toggle="modal" data-target="#createModal" data-type="{{ \App\Models\SocialMedia::TYPE_NETWORK }}" data-pos="{{ $network_next_pos }}" class="btn btn-primary font-weight-bold createBtn">
                                    <i class="fas fa-plus mr-2"></i>Добавить
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
                                            Иконка
                                        </th>
                                        <th class="pr-0 text-center">
                                            Ссылка
                                        </th>
                                        <th class="pr-0 text-center">
                                            Контакты
                                        </th>
                                        <th class="pr-0 text-center">
                                            Футер
                                        </th>
                                        <th class="pr-0 text-center">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($networks as $network)
                                        <tr data-id="{{ $network->id }}">
                                            <td class="handle text-center pl-0" style="cursor: pointer">
                                                <i class="flaticon2-sort"></i>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg">
                                                    <img src="{{ $network->iconSrc }}" height="24">
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ $network->link }}" target="_blank" class="d-block font-size-lg">
                                                    {{ mb_strimwidth($network->link, 0, 12, "...") }}
                                                    <i class="ml-2 fas fa-external-link-alt"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                        <span class="switch">
                                            <label>
                                                <input class="active_switch" type="checkbox" @if($network->is_active_in_contacts) checked="checked" @endif data-id="{{ $network->id }}" data-type="contacts">
                                                <span></span>
                                            </label>
                                        </span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                        <span class="switch">
                                            <label>
                                                <input class="active_switch" type="checkbox" @if($network->is_active_in_footer) checked="checked" @endif data-id="{{ $network->id }}" data-type="footer">
                                                <span></span>
                                            </label>
                                        </span>
                                                </div>
                                            </td>
                                            <td class="text-center pr-0">
                                                <form action="{{ route('admin.settings.social.destroy') }}" method="POST">
                                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon editSocial"
                                                       data-toggle="modal" data-target="#updateModal"
                                                       data-id="{{ $network->id }}">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $network->id }}">
                                                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                            onclick="return confirm('Ви впевнені, що хочете видалити мережу?')"
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
                <div class="col-md-6">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-chat-2 text-primary"></i>
                                </span>
                                <h3 class="card-label">
                                    Мессенджеры
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <button data-toggle="modal" data-target="#createModal" data-type="{{ \App\Models\SocialMedia::TYPE_MESSENGER }}" data-pos="{{ $messenger_next_pos }}" class="btn btn-primary font-weight-bold createBtn">
                                    <i class="fas fa-plus mr-2"></i>Добавить
                                </button>
                            </div>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body pb-3">

                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table id="messengerTable" class="table table-head-custom table-vertical-center">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 text-center">
                                            #
                                        </th>
                                        <th class="pr-0 text-center">
                                            Иконка
                                        </th>
                                        <th class="pr-0 text-center">
                                            Ссылка
                                        </th>
                                        <th class="pr-0 text-center">
                                            Контакты 
                                        </th>
                                        <th class="pr-0 text-center">
                                            Футер
                                        </th>
                                        <th class="pr-0 text-center">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($messengers as $messenger)
                                        <tr data-id="{{ $messenger->id }}">
                                            <td class="handle text-center pl-0" style="cursor: pointer">
                                                <i class="flaticon2-sort"></i>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg">
                                                    <img src="{{ $messenger->iconSrc }}" height="24">
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ $messenger->link }}" target="_blank" class="d-block font-size-lg">
                                                    {{ mb_strimwidth($messenger->link, 0, 12, "...") }}
                                                    <i class="ml-2 fas fa-external-link-alt"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                        <span class="switch">
                                            <label>
                                                <input class="active_switch" type="checkbox" @if($messenger->is_active_in_contacts) checked="checked" @endif data-id="{{ $messenger->id }}" data-type="contacts">
                                                <span></span>
                                            </label>
                                        </span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                        <span class="switch">
                                            <label>
                                                <input class="active_switch" type="checkbox" @if($messenger->is_active_in_footer) checked="checked" @endif data-id="{{ $messenger->id }}" data-type="footer">
                                                <span></span>
                                            </label>
                                        </span>
                                                </div>
                                            </td>
                                            <td class="text-center pr-0">
                                                <form action="{{ route('admin.settings.social.destroy') }}" method="POST">
                                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon editSocial"
                                                       data-toggle="modal" data-target="#updateModal"
                                                       data-id="{{ $messenger->id }}">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $messenger->id }}">
                                                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                            onclick="return confirm('Ви впевнені, що хочете видалити мережу?')"
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
                    <br>
                    
                    <div class="card card-custom text-center">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon-network text-primary"></i>
                                </span>
                                @foreach ($phone as $item)
                                <h3 class="card-label">
                                    Ваш номер: {{$item->number}}
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <form action="{{ route('admin.settings.telephone.edit') }}">
                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon editSocial"
                                       data-toggle="modal" data-target="#telephonModal"
                                       data-id="{{ $item->number }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                </form>
                            </div>
                            @endforeach       
                        </div>
                    </div>
                    
                    <!--end::Card-->
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->

@include('admin.settings.socials.modals.create')
@include('admin.settings.socials.modals.update')
@include('admin.settings.socials.modals.telephon')
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
            let networkTable = document.querySelector('#networkTable tbody')
            new Sortable(networkTable, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    console.log('drop');
                    var list = [];
                    $.each($(networkTable).find('tr'), function (idx, el) {
                        list.push({
                            id: $(el).data('id'),
                            pos: idx + 1
                        })
                    });

                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.settings.social.update_positions') }}',
                        data: {
                            positions: list,
                        }
                    });

                }
            });

            let messengerTable = document.querySelector('#messengerTable tbody')
            new Sortable(messengerTable, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    console.log('drop');
                    var list = [];
                    $.each($(messengerTable).find('tr'), function (idx, el) {
                        list.push({
                            id: $(el).data('id'),
                            pos: idx + 1
                        })
                    });

                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.settings.social.update_positions') }}',
                        data: {
                            positions: list,
                        }
                    });

                }
            });
        })

        var createImagePlugin = new KTImageInput('createImagePlugin');
        var updateImagePlugin = new KTImageInput('updateImagePlugin');

        $(document).on('click', '.createBtn', function (e) {
            let type_id = $(this).data('type'),
                next_pos = $(this).data('pos')

            $('#createTypeId').val(type_id);
            $('#createPos').val(next_pos);
        })


        $(document).on('change', '.active_switch', function(e) {
            let switch_input = this,
                checked = switch_input.checked,
                request_data = {
                    id: switch_input.dataset.id,
                    type: switch_input.dataset.type
                }
            if (checked) {
                request_data.status = true
            }

            $.ajax({
                url: '{{ route('admin.settings.social.change_status') }}',
                method: "POST",
                data: request_data,
                success: function () {
                    switch_input.checked = checked
                },
                error: function () {
                    switch_input.checked = !checked
                }
            })
        })

        $(document).on('click', '.editSocial', loadModel);

        function loadModel() {
            let id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: '{{ route('admin.settings.social.show') }}',
                data: {
                    'id': id
                },
                success: function (response) {
                    $('#updateId').val(id);

                    $('#updateLink').val(response.link);

                    let icon_url = 'url("{{ asset('uploads/social/') }}/' + response.icon + '")'
                    $('#updateImageBackground').css('background-image', icon_url);

                    document.getElementById('updateIsActiveInContacts').checked = (response.is_active_in_contacts == 1)
                    document.getElementById('updateIsActiveInFooter').checked = (response.is_active_in_footer == 1)
                }, error: function (response) {
                    console.log(response)
                }
            });
        }

    </script>
@endsection

