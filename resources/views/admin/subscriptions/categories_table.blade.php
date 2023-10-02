<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                ID
            </th>
            <th class="pr-0 text-center">
                Название
            </th>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody class="faq-table">
        @foreach($subscription_categories as $subscription_category)
            <tr data-id="{{ $subscription_category->id }}">
                <td class="text-center pl-0">
                    {{ $subscription_category->id }}
                </td>
                <td class="text-center position">
                    <span class="text-dark-75 d-block font-size-lg">
                        {{ $subscription_category->name }}
                    </span>
                </td>
                <td class="text-center pr-0">
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::SUBSCRIPTIONS_EDIT))
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon update"
                           data-toggle="modal" data-target="#updateFaqModal"
                           data-id="{{ $subscription_category->id }}">
                            <i class="las la-edit"></i>
                        </a>
                    @endif
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::SUBSCRIPTIONS_DELETE))
                        <form action="{{ route('admin.subscription-category.delete') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $subscription_category->id }}">
                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                onclick="return confirm('Ви впевнені, що хочете видалити питання \'{{ $subscription_category->name }}\'?')"
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
{{--{{ $faqs->links('vendor.pagination.super_admin_pagination') }}--}}
