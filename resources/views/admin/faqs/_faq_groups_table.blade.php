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
                Название
            </th>
            <th class="text-center pr-0">
                Действия
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($faq_groups as $faq_group)
            <tr data-id="{{ $faq_group->id }}">
                <td class="handle text-center pl-0" style="cursor: pointer">
                    <i class="flaticon2-sort"></i>
                </td>
                <td class="text-center pl-0">
                    {{ $faq_group->id }}
                </td>
                <td class="text-center position">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $faq_group->position }}
                                        </span>
                </td>
                <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $faq_group->name }}
                                        </span>
                </td>
                <td class="text-center pr-0">
                    <form action="{{ route('admin.faq-groups.delete') }}" method="POST">
                        <a href="{{ route('admin.faq-groups.edit', $faq_group->id) }}" class="btn btn-sm btn-clean btn-icon updateFaq">
                            <i class="las la-edit"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $faq_group->id }}">
                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                onclick="return confirm('Вы уверенны что хотите удалить группу  \'{{ $faq_group->title }}\'? Все вопросы надлежащие группе будут также удаленны?')"
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
{{ $faq_groups->links('vendor.pagination.super_admin_pagination') }}
