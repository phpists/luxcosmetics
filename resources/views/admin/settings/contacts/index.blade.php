@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Загальні налаштування</h5>
@endsection

@section('content')
    <style>
        td {
            vertical-align: middle!important;
        }
    </style>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">

        <!--begin::Container-->
        <div class="container-fluid">

                        <!--begin::Card-->
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="card-label">
                                        Контактні дані
                                    </h2>
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body pb-3">

                                <div class="row">
                                    <div class="col col-md-5">
                                        <h4 class="text-dark font-weight-bold mb-5">{{ $feedback_email->title  }}</h4>

                                        <div class="mb-15 mx-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="value" value="{{ $feedback_email->value }}" readonly/>
                                                <div class="input-group-append">
                                                    <button class="btn btn-icon btn-light-warning edit-setting rounded-right border border-left-0" type="button" data-id="{{ $feedback_email->id }}"><i class="flaticon-edit"></i></button>
                                                    <button class="btn btn-icon btn-light-success save-setting d-none border border-left-0" type="button" data-id="{{ $feedback_email->id }}"><i class="flaticon2-checkmark"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row row-cols-1 row-cols-md-2">
                                    @foreach(\App\Models\Contact::ALL_GROUPS as $group_id => $group_title)
                                        @continue($group_id == \App\Models\Contact::GROUP_DEPARTMENT || $group_id == \App\Models\Contact::GROUP_HEAD_OF_CLIENTS)
                                        <div class="col mb-5">
                                            <h4 class="text-dark font-weight-bold mb-2">{{ $group_title }}</h4>
                                            <div class="mb-15 mx-4">
                                                <table class="table table-sm">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Тип</th>
                                                        <th scope="col">Контакт</th>
                                                        <th scope="col">Дод.інфо</th>
                                                        <th scope="col" class="text-center">
                                                            <button type="button" class="btn btn-sm btn-icon btn-light-primary create-contact" data-toggle="modal" data-target="#createContact" data-group-id="{{ $group_id }}">
                                                                <i class="flaticon2-plus"></i>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contacts->where('group_id', $group_id) as $contact)
                                                        <tr>
                                                            <td>{{ $contact->type_title }}</td>
                                                            <td><input class="form-control w-100" name="value" type="text" value="{{ $contact->value }}" readonly></td>
                                                            <td><input class="form-control w-100" name="info" type="text" value="{{ $contact->info }}" readonly></td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-sm btn-icon btn-light-warning edit-contact" data-id="{{ $contact->id }}">
                                                                    <i class="flaticon-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-icon btn-light-success save-contact d-none" data-id="{{ $contact->id }}">
                                                                    <i class="flaticon2-checkmark"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-icon btn-light-danger drop-contact" data-id="{{ $contact->id }}">
                                                                    <i class="flaticon-delete"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <h4 class="text-dark font-weight-bold mb-2">{{ \App\Models\Contact::ALL_GROUPS[\App\Models\Contact::GROUP_DEPARTMENT] }}</h4>
                                        <div class="mb-15 mx-4">
                                            <table class="table table-sm">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Відділ</th>
                                                    <th scope="col">Тип</th>
                                                    <th scope="col">Контакт</th>
                                                    <th scope="col">Дод.інфо</th>
                                                    <th scope="col" class="text-center">
                                                        <button type="button" class="btn btn-sm btn-icon btn-light-primary create-contact" data-toggle="modal" data-target="#createContact" data-group-id="{{ \App\Models\Contact::GROUP_DEPARTMENT }}">
                                                            <i class="flaticon2-plus"></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($contacts->where('group_id', \App\Models\Contact::GROUP_DEPARTMENT) as $contact)
                                                    <tr data-department-id="{{ $contact->department_id }}">
                                                        <td class="department-title">{{ $contact->department->title }}</td>
                                                        <td>{{ $contact->type_title }}</td>
                                                        <td><input class="form-control w-100" name="value" type="text" value="{{ $contact->value }}" readonly></td>
                                                        <td><input class="form-control w-100" name="info" type="text" value="{{ $contact->info }}" readonly></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-sm btn-icon btn-light-warning edit-contact" data-id="{{ $contact->id }}">
                                                                <i class="flaticon-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-icon btn-light-success save-contact d-none" data-id="{{ $contact->id }}">
                                                                <i class="flaticon2-checkmark"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-icon btn-light-danger drop-contact" data-id="{{ $contact->id }}">
                                                                <i class="flaticon-delete"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col mb-5">
                                        <h4 class="text-dark font-weight-bold mb-2">Відділи компанії</h4>
                                        <div class="mb-15 mx-4">
                                            <table class="table table-sm">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Назва</th>
                                                    <th scope="col" class="text-center">
                                                        <button type="button" class="btn btn-sm btn-icon btn-light-primary" data-toggle="modal" data-target="#createDepartmentModal">
                                                            <i class="flaticon2-plus"></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($departments as $department)
                                                    <tr>
                                                        <td><input class="form-control w-100" name="title" type="text" value="{{ $department->title }}" readonly></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-sm btn-icon btn-light-warning edit-department" data-id="{{ $department->id }}">
                                                                <i class="flaticon-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-icon btn-light-success save-department d-none" data-id="{{ $department->id }}">
                                                                <i class="flaticon2-checkmark"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-icon btn-light-danger drop-department" data-id="{{ $department->id }}">
                                                                <i class="flaticon-delete"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-cols-1 row-cols-md-2">
                                    @php
                                        $group_id = \App\Models\Contact::GROUP_HEAD_OF_CLIENTS;
                                        $group_title = \App\Models\Contact::ALL_GROUPS[\App\Models\Contact::GROUP_HEAD_OF_CLIENTS]
                                    @endphp
                                        <div class="col mb-5">
                                            <h4 class="text-dark font-weight-bold mb-2">{{ $group_title }}</h4>
                                            <div class="mb-15 mx-4">
                                                <table class="table table-sm">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Тип</th>
                                                        <th scope="col">Контакт</th>
                                                        <th scope="col">Дод.інфо</th>
                                                        <th scope="col" class="text-center">
                                                            <button type="button" class="btn btn-sm btn-icon btn-light-primary create-contact" data-toggle="modal" data-target="#createContact" data-group-id="{{ $group_id }}">
                                                                <i class="flaticon2-plus"></i>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contacts->where('group_id', $group_id) as $contact)
                                                        <tr>
                                                            <td>{{ $contact->type_title }}</td>
                                                            <td><input class="form-control w-100" name="value" type="text" value="{{ $contact->value }}" readonly></td>
                                                            <td><input class="form-control w-100" name="info" type="text" value="{{ $contact->info }}" readonly></td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-sm btn-icon btn-light-warning edit-contact" data-id="{{ $contact->id }}">
                                                                    <i class="flaticon-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-icon btn-light-success save-contact d-none" data-id="{{ $contact->id }}">
                                                                    <i class="flaticon2-checkmark"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-icon btn-light-danger drop-contact" data-id="{{ $contact->id }}">
                                                                    <i class="flaticon-delete"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>


                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->
    @include('admin.settings.contacts.modals.create_contact')
    @include('admin.settings.contacts.modals.create_department')


@endsection

@section('js_after')
    <script>
        $(function(){
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop() || $('html').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });
        });




        $(document).on('click', '.edit-department', function() {
            let $edit_button = $(this),
                $save_button = $edit_button.next('.save-department');

            $edit_button.addClass('d-none');
            $save_button.removeClass('d-none');

            $edit_button.parents('tr').find('input[name="title"]').attr('readonly', false)
        })


        $(document).on('click', '.save-department', function() {
            let $save_button = $(this),
                $edit_button = $save_button.prev('.edit-department');

            let id = $save_button.data('id'),
                title = $edit_button.parents('tr').find('input[name="title"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('admin.settings.department.update') }}',
                method: "POST",
                data: {
                    id: id,
                    title: title,
                },
                success: function (data) {
                    $edit_button.removeClass('d-none');
                    $save_button.addClass('d-none');

                    $edit_button.parents('tr').find('input[name="title"]').attr('readonly', true)
                    $(`tr[data-department-id="${id}"] td.department-title`).text(title)
                },
            })
        })

        $(document).on('click', '.drop-department', function(e) {
            let button = this,
                id = button.dataset.id;

            if (!confirm('Ви впевнені, що хочете видалити відділ? Всі його контактні дані будуть видалені вслід за ним')) return

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('admin.settings.department.drop') }}',
                method: "POST",
                data: {
                    id: id
                },
                success: function (data) {
                    $(button).parents('tr').remove()
                    $(`tr[data-department-id="${id}"]`).remove()
                },
            })
        })


        $(document).on('change', 'select[name="type_id"]', function() {
            if (this.value === '{{ \App\Models\Contact::TYPE_OTHER }}') {
                $('input[name="type_title"]').parents('div.col').removeClass('d-none')
                $('input[name="type_title"]')[0].required = true
            } else {
                $('input[name="type_title"]').val('')
                $('input[name="type_title"]').parents('div.col').addClass('d-none')
                $('input[name="type_title"]')[0].required = false
            }
        })

        $(document).on('click', '.create-contact', function(e) {
            $('#createContactGroupId').val(this.dataset.groupId)
            if (this.dataset.groupId == '{{ \App\Models\Contact::GROUP_DEPARTMENT }}') {
                $('select[name="department_id"]').val($('select[name="department_id"] option:first').val())
                $('select[name="department_id"]').parents('div.col').removeClass('d-none')
                $('select[name="department_id"]')[0].required = true
            } else {
                $('select[name="department_id"]').val('')
                $('select[name="department_id"]').parents('div.col').addClass('d-none')
                $('select[name="department_id"]')[0].required = false
            }
        })


        $(document).on('click', '.edit-contact', function() {
            let $edit_button = $(this),
                $save_button = $edit_button.next('.save-contact');

            $edit_button.addClass('d-none');
            $save_button.removeClass('d-none');

            $edit_button.parents('tr').find('input[name="value"]').attr('readonly', false)
            $edit_button.parents('tr').find('input[name="info"]').attr('readonly', false)
        })


        $(document).on('click', '.save-contact', function() {
            let $save_button = $(this),
                $edit_button = $save_button.prev('.edit-contact');

            let id = $save_button.data('id'),
                value = $edit_button.parents('tr').find('input[name="value"]').val(),
                info = $edit_button.parents('tr').find('input[name="info"]').val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('admin.settings.contact.update') }}',
                method: "POST",
                data: {
                    id: id,
                    value: value,
                    info: info
                },
                success: function (data) {
                    $edit_button.removeClass('d-none');
                    $save_button.addClass('d-none');

                    $edit_button.parents('tr').find('input[name="value"]').attr('readonly', true)
                    $edit_button.parents('tr').find('input[name="info"]').attr('readonly', true)
                },
            })
        })


        $(document).on('click', '.drop-contact', function(e) {
            let button = this;

            if (!confirm('Ви впевнені, що хочете видалити запис?')) return

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('admin.settings.contact.drop') }}',
                method: "POST",
                data: {
                    id: button.dataset.id
                },
                success: function (data) {
                    $(button).parents('tr').remove()
                },
            })
        })




        $(document).on('click', '.edit-setting', function() {
            let $edit_button = $(this),
                $save_button = $edit_button.next('.save-setting');

            $edit_button.addClass('d-none');
            $save_button.removeClass('d-none');

            $edit_button.parents('div.input-group').find('input[name="value"]').attr('readonly', false)
        })


        $(document).on('click', '.save-setting', function() {
            let $save_button = $(this),
                $edit_button = $save_button.prev('.edit-setting');

            let id = $save_button.data('id'),
                value = $edit_button.parents('div.input-group').find('input[name="value"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('admin.setting.update') }}',
                method: "POST",
                data: {
                    id: id,
                    value: value,
                },
                success: function (data) {
                    $edit_button.removeClass('d-none');
                    $save_button.addClass('d-none');

                    $edit_button.parents('div.input-group').find('input[name="value"]').attr('readonly', true)
                },
            })
        })
    </script>
@endsection

