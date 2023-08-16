@foreach($commentAjax as $item)
    <tr id="comment_{{$item->id}}" data-id="{{ $item->id }}" data-label="{{ $item->status }}">
        <td class="text-center pl-0">
            {{ $item->id }}
        </td>
        <td class="text-center pr-0">
            <a href="{{ route('products.product', App\Models\Product::find($item->product_id)->alias) }}"
               target="_blank">
                {{ App\Models\Product::find($item->product_id)->title }}
            </a>
        </td>
        <td class="pr-0">
            <a href="{{ route('admin.comment.edit', $item->id) }}">{{ $item->description }}</a>
        </td>
        <td class="text-center pr-0">
            {{ $item->status }}
        </td>
        <td class="text-center pr-0">
            <a href="{{ route('admin.comment.edit', $item->id) }}"
               class="btn btn-sm btn-clean btn-icon">
                <i class="las la-edit"></i>
            </a>
            <a href="{{ route('admin.comment.delete', $item->id) }}"
               class="btn btn-sm btn-clean btn-icon"
               onclick="return confirm('Ви впевнені, що хочете видалити цей коментар?')">
                <i class="las la-trash"></i>
            </a>
        </td>
    </tr>
@endforeach
