<div class="table-responsive">
    <table id="productsTable" class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                #
            </th>
            <th class="pr-0 text-center">
                Изображение
            </th>
            <th class="pr-0 text-center">
                Название
            </th>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody data-update-positions-url="{{ route('admin.promotion.products.update-positions', $promotion) }}">
        @foreach($products as $product)
            <tr data-id="{{ $product->id }}">
                <td class="handle text-center pl-0" style="cursor: pointer">
                    <i class="flaticon2-sort"></i>
                </td>
                <td class="text-center pl-0">
                    <img src="{{ asset('images/uploads/products/'.$product->main_image) }}" width="64px" style="object-fit: contain">
                </td>
                <td class="text-center pl-0">
                    {{ $product->title }}
                </td>
                <td class="text-center pr-0">
                    <button
                        data-url="{{ route('admin.promotion.products.destroy', ['promotion' => $promotion, 'product' => $product]) }}"
                        class="btn btn-sm btn-clean btn-icon delete-product"
                        title="Delete"><i class="las la-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@include('admin.promotions.modals.add_product')
