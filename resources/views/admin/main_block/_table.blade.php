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
        <tbody class="faq-table">
        @foreach($blocks as $block)
            <tr data-id="{{ $block->id }}">
                <td class="handle text-center pl-0" style="cursor: pointer">
                    <i class="flaticon2-sort"></i>
                </td>
                <td class="text-center pl-0">
                    {{ $block->id }}
                </td>
                <td class="text-center position">
                                        <img width="80px" height="80px" src="{{ $block->getImageSrcAttribute() }}">
                </td>
                <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $block->title }}
                                        </span>
                </td>
                <td class="text-center pr-0">
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateBlock"
                       data-toggle="modal" data-target="#updateBlockModal"
                       data-id="{{ $block->id }}">
                        <i class="las la-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->
{{--{{ $faqs->links('vendor.pagination.super_admin_pagination') }}--}}
