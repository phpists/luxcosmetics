@foreach($categories as $category)
    <tr id="category_{{$category->id}}">
        <td class="text-center pl-0">
            <span style="width: 20px;">
                <label class="checkbox checkbox-single">
                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                           value="{{ $category->id }}">&nbsp;<span></span>
                </label>
            </span>
        </td>
        <td class="text-center pl-0">
            {{ $category->id }}
        </td>
        <td class="text-center pr-0">
            {{ $category->title }}
        </td>
        <td class="text-center pr-0">
            {{ $category->alias }}
        </td>
        <td class="text-center pr-0">
            {{ $category->created_at->format('m Y, H:i:s') }}
        </td>
        <td class="text-center pr-0 status">
            {{ \App\Services\SiteService::getStatus($category->status) }}
        </td>
        <td class="text-center pr-0">
            <i class="handle flaticon2-sort" style="cursor:pointer;"></i>
            <a href="{{ route('admin.category.show', $category->id) }}"
               class="btn btn-sm btn-clean btn-icon">
                <i class="las la-eye"></i>
            </a>
            <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-clean btn-icon">
                <i class="las la-edit"></i>
            </a>
            <a href="{{ route('admin.category.delete', $category->id) }}"
               class="btn btn-sm btn-clean btn-icon"
               onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                <i class="las la-trash"></i>
            </a>
        </td>
    </tr>
@endforeach
