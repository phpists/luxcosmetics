@foreach($products as $product)
    <tr id="category_{{$product->id}}" data-id="{{ $product->id }}">
        <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]" value="{{ $product->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
        </td>
        <td class="text-center pl-0">
            {{ $product->id }}
        </td>
        <td class="pr-0">
            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}">{{ $product->title }}</a>
        </td>
        <td class="text-center pr-0">
            {{ $product->category?->name}}
        </td>
        <td class="text-center pr-0">
            {{ $product->brand?->name }}
        </td>
        <td class="text-center pr-0">
            {{ $product->code }}
        </td>
        <td class="text-center pr-0 status">
            {{ \App\Services\SiteService::getProductStatus($product->availability) }}
        </td>
        <td class="text-center pr-0">
            <a href="{{ route('products.product', ['alias' => $product->alias]) }}"
               class="btn btn-sm btn-clean btn-icon"
               target="_blank">
                <i class="las la-eye"></i>
            </a>

            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_EDIT))
                <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                   class="btn btn-sm btn-clean btn-icon">
                    <i class="las la-edit"></i>
                </a>
            @endif

            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PRODUCTS_DELETE))
                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                            onclick="return confirm('Вы уверенны?')"
                            title="Delete"><i class="las la-trash"></i>
                    </button>
                </form>
            @endif
        </td>
    </tr>
@endforeach
