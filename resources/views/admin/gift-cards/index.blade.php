@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Подарочные карты</h5>
@endsection

@section('styles')

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
                        <h3 class="card-label">Подарочные карты</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button data-toggle="modal" data-target="#createModal" class="btn btn-primary font-weight-bold">
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
                                    Сумма
                                </th>
                                <th class="text-center pr-0">
                                    От кого
                                </th>
                                <th class="text-center pr-0">
                                    Кому
                                </th>
                                <th class="text-center pr-0">
                                    Активирована
                                </th>
                                <th class="pr-0 text-center">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($giftCards as $giftCard)
                                <tr id="gift_card_{{ $giftCard->id }}" data-id="{{ $giftCard->id }}">
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $giftCard->id }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $giftCard->sum }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $giftCard->buyer->email ?? 'UNDEFINED' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $giftCard->receiver_email }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $giftCard->activated_at ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        <form action="{{ route('admin.gift_cards.destroy', $giftCard) }}" method="POST">
                                            <a href="javascript:;"
                                               class="btn btn-sm btn-clean btn-icon btn-show"
                                               data-toggle="modal" data-target="#showModal"
                                               data-url="{{ route('admin.gift_cards.show', $giftCard) }}">
                                                <i class="las la-eye"></i>
                                            </a>
{{--                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit"--}}
{{--                                               data-toggle="modal" data-target="#updateModal"--}}
{{--                                               data-id="{{ $giftCard->id }}">--}}
{{--                                                <i class="las la-edit"></i>--}}
{{--                                            </a>--}}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                    onclick="return confirm('Вы уверенны? Это действия не отменит уже полученные пользователем средства, если карта уже была активирована')"
                                                    title="Delete"><i class="las la-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $giftCards->links('vendor.pagination.super_admin_pagination') }}
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

    @include('admin.gift-cards.modals.create')
    @include('admin.gift-cards.modals.show')
@endsection

@section('js_after')
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        })


        $(document).on('click', '.btn-show', loadModel);

        function loadModel() {
            $.ajax({
                url: $(this).data('url'),
                dataType: 'json',
                success: function (item) {
                    $('#showColor').val(item.color);
                    $('#showSum').val(item.sum);
                    $('#showFrom').val(item.from_whom);
                    $('#showReceiver').val(item.receiver);
                    $('#showReceiverEmail').val(item.receiver_email);
                    $('#showDescription').text(item.description);
                    $('#showCode').val(item.code);
                    $('#showActivated').val(item.activated_at);
                    $('#showActivatedBy').val(item.activated_by);
                }
            });
        }

    </script>
@endsection

