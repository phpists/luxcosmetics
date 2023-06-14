@foreach($blog as $item)
    <tr id="post_{{$item->id}}" data-id="{{ $item->id }}">
        <td class="text-center pl-0">
            <span style="width: 20px;">
                <label class="checkbox checkbox-single">
                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                           value="{{ $item->id }}">&nbsp;<span></span>
                </label>
            </span>
        </td>
        <td class="text-center pl-0">
            {{ $item->id }}
        </td>
        <td class="text-center pr-0">
            {{ $item->title }}
        </td>
        <td class="text-center pr-0">
            {{ date('m Y, H:i:s', strtotime($item->created_at)) }}
        </td>
        <td class="text-center pr-0 status">
            {{ \App\Services\SiteService::getStatus($item->status) }}
        </td>
        <td class="text-center pr-0">
            {{ date('m Y, H:i:s', strtotime($item->published_at)) }}
        </td>
        <td class="text-center pr-0">
            <img src="{{ $item->mainImage() }}" width="100" height="100">
        </td>
        <td class="text-center pr-0">
            <a href="{{ route('admin.blog.edit', $item->id) }}"
               class="btn btn-sm btn-clean btn-icon">
                <i class="las la-edit"></i>
            </a>
            <a href="{{ route('admin.blog.delete', $item->id) }}"
               class="btn btn-sm btn-clean btn-icon"
               onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                <i class="las la-trash"></i>
            </a>
        </td>
    </tr>
@endforeach
