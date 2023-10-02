<div class="table-responsive">
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
                Название
            </th>
            <td class="text-center pr-0">
                Ссылка
            </td>
            <td class="text-center pr-0">
                Активная
            </td>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody id="table">
        @foreach($items as $item)
            <tr id="category_{{$item->id}}" data-id="{{ $item->id }}">
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
                <td class="text-center pr-0 status">
                    <a href="{{ $item->link }}">{{ $item->link }}</a>
                </td>
                <td class="text-center pr-0 status">
                    {{ \App\Services\SiteService::getStatus($item->is_active) }}
                </td>
                <td class="text-center pr-0">
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::MENUS_EDIT))
                    <a href="{{ route('admin.menu.edit', $item->id) }}"
                       class="btn btn-sm btn-clean btn-icon">
                        <i class="las la-edit"></i>
                    </a>
                    @endif
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::MENUS_DELETE))
                    <a href="{{ route('admin.menu.delete', $item->id) }}"
                       class="btn btn-sm btn-clean btn-icon"
                       onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                        <i class="las la-trash"></i>
                    </a>
                        @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{--<div id="pagination">--}}
{{--    {{ $categories->appends(request()->all())->links('vendor.pagination.category_pagination') }}--}}
{{--</div>--}}
