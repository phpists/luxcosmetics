@foreach($orderProducts as $orderProduct)
    @php($product = \App\Services\CatalogService::getProduct($orderProduct['product_id']))
    @if(!$product) @dd($orderProducts) @endif
    @continue(!$product)
    <tr>
        <td class="text-center pl-0">
            @if(isset($orderProduct['id']))
                <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $orderProduct['id'] }}">
            @endif
            <input type="hidden" name="products[{{ $loop->index }}][product_id]"
                   value="{{ $orderProduct['product_id'] }}">
            {{ $orderProduct['product_id'] }}
        </td>
        <td class="text-center pr-0">
            {{ $product->code }}
        </td>
        <td class="text-center pr-0">
            {{ $product->brand->name }}
        </td>
        <td class="text-center pr-0">
            <a href="{{ route('products.product', ['alias' => $product->alias]) }}" target="_blank">{{ $product->title }}</a>
        </td>
        <td class="text-center pr-0 price">
            @if(isset($orderProduct['price']))
                <input type="hidden" name="products[{{ $loop->index }}][price]" value="{{ $orderProduct['price'] }}">
            @endif
            @if(isset($orderProduct['old_price']))
                <input type="hidden" name="products[{{ $loop->index }}][old_price]"
                       value="{{ $orderProduct['old_price'] }}">
            @endif
            {{ $orderProduct['price'] ?? $product->price }}
        </td>
        <td class="text-center pr-0">
            <input class="form-control text-center productsTableQuantity" type="number" min="1" name="products[{{ $loop->index }}][quantity]"
                   value="{{ $orderProduct['quantity'] }}">
        </td>
        <td class="text-center pr-0">
            {{ ($orderProduct['price'] ?? $product->price) * $orderProduct['quantity'] }}
        </td>
        <td class="text-center pr-0">
            <button type="button" data-url="{{ route('admin.order_products.destroy', $orderProduct['id'] ?? 0) }}"
                    class="btn btn-sm btn-clean btn-icon removeProduct" data-row="tr:first" @if(isset($orderProduct['id'])) data-exists @endif>
                <i class="las la-trash"></i>
            </button>
        </td>
    </tr>
@endforeach
@if(isset($bonuses) && $bonuses > 0)
<tr class="text-right">
    <td colspan="7">Использовано бонусов: <b>{{ $bonuses }}</b></td>
</tr>
@endif
<tr class="text-right">
    <td colspan="7">Всего: <b>{{ $total_sum }}</b></td>
</tr>

