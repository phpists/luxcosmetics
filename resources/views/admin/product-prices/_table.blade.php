<!--begin::Table-->
<div class="table-responsive">
    <table id="productPricesTable" class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                #
            </th>
            <th class="pr-0 text-center">
                Название
            </th>
            <th class="pr-0 text-center">
                Тип
            </th>
            <th class="pr-0 text-center">
                Активный
            </th>
            <th class="pr-0 text-center">
                Дата
            </th>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody id="table" data-update-positions-url="{{ route('admin.product-price.update-positions') }}">
        @foreach($productPrices as $productPrice)
            <tr data-id="{{ $productPrice->id }}">
                <td class="handle text-center pl-0" style="cursor: pointer">
                    <i class="flaticon2-sort"></i>
                </td>
                <td class="text-center pl-0">
                    {{ $productPrice->title }}
                </td>
                <td class="text-center pl-0">
                    {{ $productPrice->getTypeTitle() }}
                </td>
                <td class="text-center pl-0">
                    <div class="d-flex justify-content-center">
                        <span class="switch">
                            <label>
                                <input class="active_switch" type="checkbox" @checked($productPrice->is_active) data-id="{{ $productPrice->id }}">
                                <span></span>
                            </label>
                        </span>
                    </div>
                </td>
                <td class="text-center pr-0">
                    {{ $productPrice->getDateString() }}
                </td>
                <td class="text-center pr-0">
                    @if(auth()->user()->isSuperAdmin())
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit"
                           data-toggle="modal" data-target="#editProductPriceModal"
                           data-show-url="{{ route('admin.product-prices.show', $productPrice) }}"
                            data-update-url="{{ route('admin.product-prices.update', $productPrice) }}">
                            <i class="las la-edit"></i>
                        </a>
                    @endif
                    @if(auth()->user()->isSuperAdmin())
                        <form action="{{ route('admin.product-prices.destroy', $productPrice) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                    onclick="return confirm('Вы уверены?')"
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
<div id="pagination">
    {{ $productPrices->withQueryString()->links('vendor.pagination.product_pagination') }}
</div>
<!--end::Table-->
