@foreach($bannerAjax as $item)
    <tr id="banner_{{$item->id}}" data-id="{{ $item->id }}" data-label="{{ $item->position }}">
        <td class="text-center pl-0">
            <span style="width: 20px;">
                <label class="checkbox checkbox-single">
                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                           value="{{ $item->id }}">&nbsp;<span></span>
                </label>
            </span>
        </td>
        <td class="handle text-center pl-0" style="cursor: pointer">
            <i class="flaticon2-sort"></i>
        </td>
        <td class="text-center pl-0">
            {{ $item->id }}
        </td>
        <td class="pr-0">
            <a href="{{ route('admin.banner.edit', $item->id) }}">{{ $item->title }}</a>
        </td>
        <td class="text-center pr-0">
            {{ $item->position }}
        </td>

        <td class="text-center pr-0 sort position">
            {{ $item->number_position }}
        </td>

        <td class="text-center pr-0">
            <div class="banner__image"><a href="{{ route('index.banner', $item->id) }}"><img src="{{asset('images/uploads/banner/' . $item->image)}}" alt="" style=" width: 100px;"></a></div>
        </td>
        <td class="text-center pr-0">
            <a href="{{ route('admin.banner.edit', $item->id) }}"
               class="btn btn-sm btn-clean btn-icon">
                <i class="las la-edit"></i>
            </a>
            <a href="{{ route('admin.banner.delete', $item->id) }}"
               class="btn btn-sm btn-clean btn-icon"
               onclick="return confirm('Вы уверенны, что хотите удалить данную запись?')">
                <i class="las la-trash"></i>
            </a>
        </td>
    </tr>
@endforeach
