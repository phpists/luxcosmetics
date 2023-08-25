@foreach($comment as $item)
    <tr id="comment_{{$item->id}}">
        <td class="text-center pr-0">{{ $item->id }}</td>
        <td class="text-center pr-0">{{ $item->email }}</td>
        <td class="pr-0">
            <a href="{{ route('admin.comment.edit', $item->id) }}">{{ Str::limit($item->description, 300) }}</a>
        </td>
        <td>
            <div class="form-group row">
                <div class="col-12">
                    <select class="form-control selectpicker statusSelect" data-item-id="{{ $item->id }}">
                        @foreach ($statusOptions as $optionValue => $optionLabel)
                            <option value="{{ $optionValue }}" @if($item->status == $optionValue) selected @endif>{{ $optionLabel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </td>
        <td class="text-center pr-0">
            <a href="{{ route('products.product', App\Models\Product::find($item->product_id)->alias) }}"
               target="_blank">
                {{ App\Models\Product::find($item->product_id)->title }}
            </a>
        </td>
        <td class="text-center pr-10">
            <a href="{{ route('admin.comment.edit', $item->id) }}" class="btn btn-sm btn-clean btn-icon">
                <i class="las la-eye"></i>
            </a>
            <a href="{{ route('admin.comment.delete', $item->id) }}" class="btn btn-sm btn-clean btn-icon" onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                <i class="las la-trash"></i>
            </a>
        </td>
    </tr>
@endforeach
