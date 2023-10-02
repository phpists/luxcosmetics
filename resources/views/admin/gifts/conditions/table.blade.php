<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                #
            </th>
            <th class="pr-0 text-center">
                Тип
            </th>
            <th class="pr-0 text-center">
                Сумма
            </th>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody id="table">
        @foreach($gift_conditions as $gift_condition)
            <tr>
                <td class="text-center pl-0">
                    {{ $gift_condition->id }}
                </td>
                <td class="text-center pl-0">
                    {{ $gift_condition->getTypeTitle() }}
                </td>
                <td class="text-center pr-0">
                    {{ $gift_condition->getSumString() }}
                </td>
                <td class="text-center pr-0">
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::GIFTS_EDIT))
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit_condition"
                           data-toggle="modal" data-target="#editGiftConditionModal"
                           data-url="{{ route('admin.gift_conditions.show', $gift_condition) }}">
                            <i class="las la-edit"></i>
                        </a>
                    @endif
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::GIFTS_DELETE))
                        <form action="{{ route('admin.gift_conditions.destroy', $gift_condition) }}" method="POST" style="display: inline">
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
<div id="pagination">
    {{ $gift_conditions->withQueryString()->links('vendor.pagination.product_pagination') }}
</div>
<!--end::Table-->
