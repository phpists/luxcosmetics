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
            Email
        </th>
        <th class="pr-0 text-center">
            Категории
        </th>
        <th class="pr-0 text-center">
            Действие
        </th>
    </tr>
    </thead>
    <tbody id="table">
    @foreach($subscribers as $subscriber)
        <tr id="subscriber_{{$subscriber->id}}" data-id="{{ $subscriber->id }}">
            <td class="text-center pl-0">
                                                    <span style="width: 20px;">
                                                        <label class="checkbox checkbox-single">
                                                            <input class="checkbox-item" type="checkbox" name="checkbox[]" value="{{ $subscriber->id }}">&nbsp;<span></span>
                                                        </label>
                                                    </span>
            </td>
            <td class="text-center pl-0">
                {{ $subscriber->id }}
            </td>
            <td class="text-center pr-0">
                {{ $subscriber->email }}
            </td>
            <td class="text-center pr-0">
                {{ $subscriber->subscription_category_id? $subscription_categories->find($subscriber->subscription_category_id)->name: '-' }}
            </td>
            <td class="text-center pr-0">
                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::SUBSCRIPTIONS_DELETE))
                <a href="{{ route('admin.subscriber.delete', ['id' => $subscriber->id]) }}"
                   class="btn btn-sm btn-clean btn-icon"
                   onclick="return confirm('Вы уверены, что хотите удалить подписчика?')"
                >
                    <i class="flaticon-delete"></i>
                </a>
                @endif
                {{--                                            <a href="{{ route('admin.product.delete', $product->id) }}"--}}
                {{--                                               class="btn btn-sm btn-clean btn-icon"--}}
                {{--                                               onclick="return confirm('Вы уверены, что хотите удалить запись?')">--}}
                {{--                                                <i class="las la-trash"></i>--}}
                {{--                                            </a>--}}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
