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
                Причина обращения
            </th>
            <th class="pr-0 text-center">
                Пользователь
            </th>
            <td class="text-center pr-0">
                Обновлено
            </td>
            <td class="text-center pr-0">
                Статус
            </td>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody id="table">
        @foreach($chats as $chat)
            <tr id="category_{{$chat->id}}" data-id="{{ $chat->id }}">
                <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $chat->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
                </td>
                <td class="text-center pl-0">
                    {{ $chat->id }}
                </td>
                <td class="text-center pr-0">
                    {{ $themes->find($chat->feedbacks_reason_id)?->reason }}
                </td>
                <td class="text-center pr-0">
                    {{ $chat->user? $chat->user->name: '<Пользователь удален>' }}
                </td>
                <td class="text-center pr-0">
                    {{ $chat->updated_at->format('m Y, H:i:s') }}
                </td>
                <td class="text-center pr-0 status">
                    {{ \App\Services\SiteService::getChatStatus($chat->status) }}
                </td>
                <td class="text-center pr-0">
                    {{--                                            <i class="handle flaticon2-sort" style="cursor:pointer;"></i>--}}
                    <a href="{{ route('admin.chats.edit', $chat->id) }}"
                       class="btn btn-sm btn-clean btn-icon">
                        <i class="las la-edit"></i>
                    </a>
                    {{--                                            <a href="{{ route('admin.category.delete', $category->id) }}"--}}
                    {{--                                               class="btn btn-sm btn-clean btn-icon"--}}
                    {{--                                               onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">--}}
                    {{--                                                <i class="las la-trash"></i>--}}
                    {{--                                            </a>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
