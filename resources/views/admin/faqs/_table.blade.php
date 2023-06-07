<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                #
            </th>
            <th class="pl-0 text-center">
                ID
            </th>
            <th class="pr-0 text-center">
                Позиция
            </th>
            <th class="text-center pr-0">
                Вопрос
            </th>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($faqs as $faq)
            <tr data-id="{{ $faq->id }}">
                <td class="handle text-center pl-0" style="cursor: pointer">
                    <i class="flaticon2-sort"></i>
                </td>
                <td class="text-center pl-0">
                    {{ $faq->id }}
                </td>
                <td class="text-center position">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $faq->position }}
                                        </span>
                </td>
                <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $faq->title }}
                                        </span>
                </td>
                <td class="text-center pr-0">
                    <form action="{{ route('admin.faq.delete') }}" method="POST">
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateFaq"
                           data-toggle="modal" data-target="#updateFaqModal"
                           data-id="{{ $faq->id }}">
                            <i class="las la-edit"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $faq->id }}">
                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                onclick="return confirm('Ви впевнені, що хочете видалити питання \'{{ $faq->title }}\'?')"
                                title="Delete"><i class="las la-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->
{{ $faqs->links('vendor.pagination.super_admin_pagination') }}
