@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Коментарии</h5>
                <!--end::Page Title-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card gutter-b col-lg-12 ml-0">
                    @include('admin.comments.parts.filter')
                </div>
                @include('admin.layouts.includes.messages')
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Коментарии</h3>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <div class="table-responsive">
                            <table class="table table-head-custom table-vertical-center">
                                <thead>
                                <tr>
                                    <th class="pr-0 text-center">#</th>
                                    <th class="pr-0 text-center">Товар</th>
                                    <th class="pr-0 text-center">Коментарии</th>
                                    <th class="pr-10 text-center">Статус</th>
                                    <th class="pr-10 text-center">Действия</th>
                                </tr>
                                </thead>
                                <tbody id="table" class="banner-table">
                                @foreach($comment as $item)
                                    <tr id="comment_{{$item->id}}" data-id="{{ $item->id }}" data-label="{{ $item->position }}">
                                        <td class="text-center pr-0">{{ $item->id }}</td>
                                        <td class="text-center pr-0">
                                            <a href="{{ route('products.product', App\Models\Product::find($item->product_id)->alias) }}"
                                               target="_blank">
                                                {{ App\Models\Product::find($item->product_id)->title }}
                                            </a>
                                        </td>
                                        <td class="text-center pr-0">
                                            <a href="{{ route('admin.comment.edit', $item->id) }}">{{ Str::limit($item->description, 300) }}</a>
                                        </td>
                                        <td class="text-center pr-10">{{ $item->status }}</td>
                                        <td class="text-center pr-10">
                                            <a href="{{ route('admin.comment.edit', $item->id) }}" class="btn btn-sm btn-clean btn-icon">
                                                <i class="las la-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.comment.delete', $item->id) }}" class="btn btn-sm btn-clean btn-icon" onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="pagination">
                            {{ $comment->appends(request()->all())->links('vendor.pagination.product_pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/comment.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let tbody = document.querySelector('tbody')
            new Sortable(tbody, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    var list = [];
                    $.each($('tbody.banner-table tr'), function (idx, el) {
                        list.push({
                            id: $(el).data('id'),
                            cat_id: $(el).data('label'),
                            position: idx + 1
                        })
                    });

                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.banners.update_positions') }}',
                        data: {
                            positions: list,
                        },
                        success: function (response) {
                            $.each(response, function(i, item) {
                                let id = item['id'];
                                let position = item['position'];
                                $(`tr[data-id="${id}"]`).find('.position').text(position)
                            })
                        }
                    });

                }
            });
        });
    </script>
@endsection