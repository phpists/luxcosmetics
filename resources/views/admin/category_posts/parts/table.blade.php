<table class="table table-head-custom table-vertical-center">
    <thead>
    <tr>
        <th class="pl-0 text-center">
                                    <span style="width: 20px;">
                                        <label class="checkbox checkbox-single checkbox-all">
                                            <input id="checkbox-all" type="checkbox"
                                                   name="checkbox[]">&nbsp;<span></span>
                                        </label>
                                    </span>
        </th>
        <th class="pl-0 text-center">
            #
        </th>
        <th class="pr-0 text-center">
            ID
        </th>
        <th class="pr-0 text-center">
            Название
        </th>
        <th class="pr-0 text-center">
            Позиция
        </th>
        <th class="pr-0 text-center">
            Изображения
        </th>
        <th class="pr-0 text-center">
            Действия
        </th>
    </tr>
    </thead>
    <tbody id="table" class="banner-table">
        @foreach($posts as $item)
        <tr id="category_post_{{$item->id}}" data-id="{{ $item->id }}" data-label="{{ $item->position }}">
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
                <a href="{{ route('admin.category_post.edit', $item->id) }}">{{ $item->title }}</a>
            </td>
            <td class="text-center pr-0">
                {{ $item->position }}
            </td>
            <td class="text-center pr-0">
                <div class="category_post__image"><img src="{{asset('images/uploads/category_posts/' . $item->image_path)}}" alt="" style=" width: 100px;"></div>
            </td>
            <td class="text-center pr-0">
                <a href="{{ route('admin.category_post.edit', $item->id) }}"
                   class="btn btn-sm btn-clean btn-icon">
                    <i class="las la-edit"></i>
                </a>
                <a href="{{ route('admin.category_post.delete', $item->id) }}"
                   class="btn btn-sm btn-clean btn-icon"
                   onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                    <i class="las la-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
