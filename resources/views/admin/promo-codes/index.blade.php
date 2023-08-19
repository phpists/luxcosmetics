@extends('admin.layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Промо коды</h5>
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
                        <h3 class="card-label">Промо коды</h3>
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
                                    Код
                                </th>
                                <th class="text-center pr-0">
                                    Доступное кол-во
                                </th>
                                <th class="text-center pr-0">
                                    Использовано раз
                                </th>
                                <th class="text-center pr-0">
                                    Скидка
                                </th>
                                <th class="text-center pr-0">
                                    Тип
                                </th>
                                <th class="text-center pr-0">
                                    Период
                                </th>
                                <th class="pr-0 text-center">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($promo_codes as $promo_code)
                                <tr id="gift_card_{{ $promo_code->id }}" data-id="{{ $promo_code->id }}">
                                    <td class="handle text-center pl-0" style="cursor: pointer">
                                        {{ $promo_code->id }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $promo_code->code }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $promo_code->quantity ?? 'Неограничен' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $promo_code->uses }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $promo_code->percent ? $promo_code->percent . '%' : $promo_code->amount }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            @if($promo_code->type == \App\Models\PromoCode::TYPE_CATEGORY)
                                                Категория: <a href="{{ route('admin.category.edit', $promo_code->category) }}" target="_blank">{{ $promo_code->category->name }}
                                            @elseif($promo_code->type == \App\Models\PromoCode::TYPE_PRODUCT)
                                                        Товар: <a href="{{ route('admin.product.edit', $promo_code->product) }}" target="_blank">{{ $promo_code->product->title }}</a>
                                            @else
                                                Вся корзина
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            @if($promo_code->starts_at) {{ "от {$promo_code->starts_at->format('d.m.y')}" }} @endif
                                            @if($promo_code->ends_at) {{ "до {$promo_code->ends_at->format('d.m.y')}" }} @endif
                                            @if(!$promo_code->starts_at && !$promo_code->ends_at) {{ 'Неограничен' }} @endif
                                        </span>
                                    </td>
                                    <td class="text-center pr-0">
                                        <a href="javascript:;"
                                           class="btn btn-sm btn-clean btn-icon btn-show"
                                           data-toggle="modal" data-target="#showModal"
                                           data-url="{{ route('admin.promo_codes.show', $promo_code) }}">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.promo_codes.destroy', $promo_code) }}" method="POST" style="display: inline">
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
                    {{ $promo_codes->links('vendor.pagination.super_admin_pagination') }}
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

    @include('admin.promo-codes.modals.create')
    @include('admin.promo-codes.modals.show')
@endsection

@section('js_after')
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('change', '[name="type"]', function (e) {
                let $form = $(this).parents('form:first');

                if (this.value === 'category') {
                    $form.find('[name="category_id"]').parents('div.column:first').show()
                    $form.find('[name="product_id"]').val('').parents('div.column:first').hide()
                } else if (this.value === 'product') {
                    $form.find('[name="product_id"]').parents('div.column:first').show()
                    $form.find('[name="category_id"]').val('').parents('div.column:first').hide()
                } else {
                    $form.find('[name="product_id"]').val('').parents('div.column:first').hide()
                    $form.find('[name="category_id"]').val('').parents('div.column:first').hide()
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
                }
            });
        }

    </script>
@endsection

