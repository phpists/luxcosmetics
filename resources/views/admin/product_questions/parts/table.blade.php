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
                Пользователь
            </th>
            <th class="text-center pr-0">Название товара</th>
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
        @foreach($questions as $question)
            <tr id="category_{{$question->id}}" data-id="{{ $question->id }}">
                <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $question->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
                </td>
                <td class="text-center pl-0">
                    {{ $question->id }}
                </td>
                <td class="text-center pr-0">
                    {{ $question->messages->first()?->email }}
                </td>
                <td class="text-center pr-0">
                    <a href="{{route('products.product', $question->product?->alias )}}">{{ $question->product?->title }}</a>
                </td>
                <td class="text-center pr-0">
                    {{ $question->updated_at->format('m Y, H:i:s') }}
                </td>
                <td class="text-center pr-0 status">
                    {{ \App\Services\SiteService::getProductQuestionStatus($question->status) }}
                </td>
                <td class="text-center pr-0">
                    {{--                                            <i class="handle flaticon2-sort" style="cursor:pointer;"></i>--}}
                    <a href="{{ route('admin.product_question.view', $question->id) }}"
                       class="btn btn-sm btn-clean btn-icon">
                        <i class="las la-eye"></i>
                    </a>
                    <a href="#"
                       class="btn btn-sm btn-clean btn-icon edit_question" data-toggle="modal" data-target="#updateProductQuestion"
                       data-id="{{ $question->id }}">
                        <i class="las la-edit"></i>
                    </a>
                    <a href="{{ route('admin.product_question.delete', $question->id) }}"
                       class="btn btn-sm btn-clean btn-icon"
                       onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                        <i class="las la-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
