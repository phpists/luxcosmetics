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
            {{ $product->category->name }}
        </td>
        <td class="text-center pr-0">
            {{ $product->brand->name }}
        </td>
        <td class="text-center pr-0">
            {{ $product->code }}
        </td>
        <td class="text-center pr-0 status">
            {{ \App\Services\SiteService::getProductStatus($product->status) }}
        </td>
        <td class="text-center pr-0">
            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-clean btn-icon">
                <i class="las la-edit"></i>
            </a>
            <a href="{{ route('admin.product.delete', $product->id) }}"
                class="btn btn-sm btn-clean btn-icon"
                onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                 <i class="las la-trash"></i>
            </a>
        </td>
    </tr>
@endforeach
