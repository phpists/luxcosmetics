<!--begin::Table-->
<div class="table-responsive">
    <table id="catalogItemsTable" class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_ITEMS_EDIT))
            <th class="pl-0 text-center">
                #
            </th>
            @endif
            <th class="pr-0 text-center">
                Изображение
            </th>
            <th class="pr-0 text-center">
                Название
            </th>
            <th class="pr-0 text-center">
                Активный
            </th>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody id="table" data-update-positions-url="{{ route('admin.catalog-items.update-positions') }}">
        @foreach($catalogItems as $catalogItem)
            <tr data-id="{{ $catalogItem->id }}">
                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_ITEMS_EDIT))
                <td class="handle text-center pl-0" style="cursor: pointer">
                    <i class="flaticon2-sort"></i>
                </td>
                @endif
                <td class="text-center pl-0">
                    <img src="{{ $catalogItem->img_src }}" width="64px" style="object-fit: contain">
                </td>
                <td class="text-center pl-0">
                    {{ $catalogItem->title }}
                </td>
                <td class="text-center pl-0">
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_ITEMS_EDIT))
                    <div class="d-flex justify-content-center">
                        <span class="switch">
                            <label>
                                <input class="active_switch" type="checkbox" @checked($catalogItem->is_active) data-id="{{ $catalogItem->id }}">
                                <span></span>
                            </label>
                        </span>
                    </div>
                    @else
                        {{ $catalogItem->is_active ? 'Да' : 'Нет' }}
                    @endif
                </td>
                <td class="text-center pr-0">
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_ITEMS_EDIT))
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit"
                           data-toggle="modal" data-target="#editCatalogItemModal"
                           data-show-url="{{ route('admin.catalog-items.show', $catalogItem) }}"
                            data-update-url="{{ route('admin.catalog-items.update', $catalogItem) }}">
                            <i class="las la-edit"></i>
                        </a>
                    @endif
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_ITEMS_DELETE))
                        <form action="{{ route('admin.catalog-items.destroy', $catalogItem) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                    onclick="return confirm('Вы уверены?')"
                                    title="Delete"><i class="las la-trash"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->
