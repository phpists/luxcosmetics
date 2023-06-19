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
            <th class="text-center pr-0">
                Ссылка
            </th>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr data-id="{{ $page->id }}">
                <td class="text-center pl-0">
                    {{ $page->id }}
                </td>
                <td class="text-center position">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $page->title }}
                                        </span>
                </td>
                <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            <a href="/pages/{{ $page->link }}">{{ $page->link }}</a>
                                        </span>
                </td>
                <td class="text-center pr-0">
                    <form action="{{ route('admin.pages.delete', $page->id) }}" method="POST">
                        <a href="{{route('admin.pages.edit', $page->id)}}" class="btn btn-sm btn-clean btn-icon">
                            <i class="las la-edit"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                onclick="return confirm('Ви впевнені, що хочете видалити питання \'{{ $page->name }}\'?')"
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
{{ $pages->links('vendor.pagination.super_admin_pagination') }}
