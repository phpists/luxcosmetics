@php
$status_list = [
    \App\Models\ProductQuestion::NEW => \App\Services\SiteService::getProductQuestionStatus(\App\Models\ProductQuestion::NEW),
    \App\Models\ProductQuestion::PUBLISHED => \App\Services\SiteService::getProductQuestionStatus(\App\Models\ProductQuestion::PUBLISHED),
    \App\Models\ProductQuestion::CLOSED => \App\Services\SiteService::getProductQuestionStatus(\App\Models\ProductQuestion::CLOSED),
]
@endphp
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
                <td class="text-center pr-0"> <!-- TODO: вивести статуси -->
                    <div class="form-group row">
                        <div class="col-12">
                            <select class="form-control selectpicker status_select" data-id="{{$question->id}}">
                                @foreach($status_list as $value=>$name)
                                    <option @if($value === $question->status) selected @endif value="{{$value}}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

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
