@foreach($productAjax as $product)
    <tr id="category_{{$product->id}}">
        <td class="text-center pl-0">
            <span style="width: 20px;">
                <label class="checkbox checkbox-single">
                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                           value="{{ $product->id }}">&nbsp;<span></span>
                </label>
            </span>
        </td>
        <td class="text-center pl-0">
            {{ $product->id }}
        </td>
        <td class="text-center pr-0">
            {{ $product->title }}
        </td>
        <td class="text-center pr-0">
            {{ $product->alias }}
        </td>
        <td class="text-center pr-0">
            {{ $product->code }}
        </td>
        <td class="text-center pr-0 status">
            {{ \App\Services\SiteService::getProductStatus($product->status) }}
        </td>
       
    </tr>
@endforeach
