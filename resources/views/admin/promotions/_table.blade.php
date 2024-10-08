<!--begin::Table-->
<div class="table-responsive">
    <table id="catalogItemsTable" class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
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
        <tbody id="table">
        @foreach($promotions as $promotion)
            <tr data-id="{{ $promotion->id }}">
                <td class="text-center pl-0">
                    <img src="{{ $promotion->preview_img_src }}" width="64px" style="object-fit: contain">
                </td>
                <td class="text-center pl-0">
                    {{ $promotion->title }}
                </td>
                <td class="text-center pl-0">
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROMOTIONS_EDIT))
                    <div class="d-flex justify-content-center">
                        <span class="switch">
                            <label>
                                <input class="active_switch" type="checkbox" data-url="{{ route('admin.promotions.update-status', $promotion) }}" @checked($promotion->is_active) data-id="{{ $promotion->id }}">
                                <span></span>
                            </label>
                        </span>
                    </div>
                    @else
                        {{ $promotion->is_active ? 'Да' : 'Нет' }}
                    @endif
                </td>
                <td class="text-center pr-0">
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROMOTIONS_EDIT))
                        <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-sm btn-clean btn-icon">
                            <i class="las la-edit"></i>
                        </a>
                    @endif
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROMOTIONS_DELETE))
                        <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" style="display: inline">
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
{!! $promotions->links('vendor.pagination.super_admin_pagination') !!}
<!--end::Table-->
