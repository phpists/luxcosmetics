@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Накопительная система</h5>
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
                        <h3 class="card-label">Статусы накопительной системы</h3>
                    </div>
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::LOYALTY_STATUS_CREATE))
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button data-toggle="modal" data-target="#createModal"
                                    class="btn btn-primary font-weight-bold">
                                <i class="fas fa-plus mr-2"></i>Создать
                            </button>
                        </div>
                    </div>
                    @endif
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
                                    Сума для получения
                                </th>
                                <th class="text-center pr-0">
                                    Скидка в %
                                </th>
                                <th class="pr-0 text-center">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($loyaltyStatuses as $loyaltyStatus)
                                <tr id="gift_card_{{ $loyaltyStatus->id }}" data-id="{{ $loyaltyStatus->id }}">
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $loyaltyStatus->id }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $loyaltyStatus->title }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $loyaltyStatus->achieve_sum }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $loyaltyStatus->discount_percent }}
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        @if(auth()->user()->isSuperAdmin()|| auth()->user()->can(\App\Services\Admin\PermissionService::LOYALTY_STATUS_EDIT))
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon edit-model"
                                               data-toggle="modal" data-target="#editModal" data-id="{{ $loyaltyStatus->id }}"
                                               data-show-url="{{ route('admin.loyalty-statuses.show', $loyaltyStatus) }}"
                                               data-update-url="{{ route('admin.loyalty-statuses.update', $loyaltyStatus) }}">
                                                <i class="las la-edit"></i>
                                            </a>
                                        @endif
                                        @if($loyaltyStatus->id != 1)
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::LOYALTY_STATUS_DELETE))
                                        <form action="{{ route('admin.promo_codes.destroy', $loyaltyStatus) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                                    onclick="return confirm('Вы уверенны?')"
                                                    title="Delete"><i class="las la-trash"></i>
                                            </button>
                                        </form>
                                        @endif
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

    @include('admin.loyalty-statuses.modals.create')
    @include('admin.loyalty-statuses.modals.edit')
@endsection

@section('js_after')
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.edit-model', function () {
                const $modal = $('#editModal');

                $modal.find('form').attr('action', this.dataset.updateUrl)

                $.ajax({
                    url: $(this).data('show-url'),
                    dataType: 'json',
                    success: function (item) {
                        $modal.find('#editTitle').val(item.title);
                        $modal.find('#editAchieveSum').val(item.achieve_sum);
                        $modal.find('#editDiscountPercent').val(item.discount_percent);
                        $modal.find('#editIsOverPp').prop('checked', item.is_over_pp);
                        if (item.id == 1)
                            $modal.find('#editAchieveSum').prop('readonly', true);
                    }
                });
            })

            $(document).on('change', '[name="type"]', function (e) {
                let $form = $(this).parents('form:first');

                if (this.value === 'category') {
                    $form.find('[name="category_ids[]"]').parents('div.column:first').show()
                    $form.find('[name="product_ids[]"]').val('').parents('div.column:first').hide()
                    $form.find('[name="brand_ids[]"]').val('').parents('div.column:first').hide()
                    $form.find('[name="min_sum"]').val('').parents('div.column:first').hide()
                } else if (this.value === 'product') {
                    $form.find('[name="product_ids[]"]').parents('div.column:first').show()
                    $form.find('[name="category_ids[]"]').val('').parents('div.column:first').hide()
                    $form.find('[name="brand_ids[]"]').val('').parents('div.column:first').hide()
                    $form.find('[name="min_sum"]').val('').parents('div.column:first').hide()
                } else if (this.value === 'brand') {
                    $form.find('[name="brand_ids[]"]').parents('div.column:first').show()
                    $form.find('[name="category_ids[]"]').val('').parents('div.column:first').hide()
                    $form.find('[name="product_ids[]"]').val('').parents('div.column:first').hide()
                    $form.find('[name="min_sum"]').val('').parents('div.column:first').hide()
                } else {
                    $form.find('[name="min_sum"]').parents('div.column:first').show()
                    $form.find('[name="product_ids[]"]').val('').parents('div.column:first').hide()
                    $form.find('[name="category_ids[]"]').val('').parents('div.column:first').hide()
                    $form.find('[name="brand_ids[]"]').val('').parents('div.column:first').hide()
                }
            })

            $(document).on('input', '[name="amount"]', function(e) {
                let $form = $(this).parents('form:first');
                if (this.value)
                    $form.find('[name="percent"]').prop('disabled', true).prop('required', false)
                else
                    $form.find('input[name="percent"]').prop('disabled', false).prop('required', true)
            })

            $(document).on('input', '[name="percent"]', function(e) {
                let $form = $(this).parents('form:first');
                if (this.value)
                    $form.find('[name="amount"]').prop('disabled', true).prop('required', false)
                else
                    $form.find('input[name="amount"]').prop('disabled', false).prop('required', true)
            })

        })


        $(document).on('click', '.btn-show', loadModel);

        function loadModel() {
            $.ajax({
                url: $(this).data('url'),
                dataType: 'json',
                success: function (item) {
                    $('#showCode').val(item.code);
                    $('#showType').val(item.type);
                    if (item.category_id)
                        $('#showCategory').val(item.category_id).parents('div.column:first').show();
                    if (item.product_id)
                        $('#showProduct').val(item.product_id).parents('div.column:first').show();
                    $('#showAmount').val(item.amount);
                    $('#showPercent').val(item.percent);
                    $('#showQuantity').val(item.quantity);
                    $('#showStarts').val(item.starts_at);
                    $('#showEnds').val(item.ends_at);

                    if (Object.keys(item.orders).length > 0) {
                        let uses = [];
                        for (const key in item.orders) {
                            uses.push(`<a href="${item.orders[key]}" target="_blank">${key}</a>`)
                        }
                        $('#showPromoCodeUses').html(uses.join('<br>'))
                    } else {
                        $('#showPromoCodeUses').html('<h6>Не было использований</h6>')
                    }
                }
            });
        }

    </script>
@endsection

