@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Редактирование группы</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}" class="text-muted">Главная</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.faq-groups') }}" class="text-muted">Группы вопросов</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.faq-groups.edit', $group->id) }}"
                           class="text-muted">{{ $group->name }}</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                    <span class="nav-text">Основное</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
                                    <span class="nav-text">FAQ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_1_4">
                            <form action="{{ route('admin.faq-groups.update', $group->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="position" value="{{$group->position}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Название</label>
                                                        <input type="text" value="{{$group->name}}" name="name" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox">
                                                                <input type="checkbox" @if($group->is_active) checked @endif name="is_active" id="updateActive">
                                                                <span></span>
                                                                Показать на сайте
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_2_4">
{{--                            <form action="{{ route('admin.category.update.seo') }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="category_id" value="{{ $category->id }}">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>H1</label>--}}
{{--                                            <input type="text" name="h1" class="form-control"--}}
{{--                                                   value="{{ $seo->h1 ?? '' }}"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta title</label>--}}
{{--                                            <input type="text" name="meta_title" class="form-control"--}}
{{--                                                   value="{{ $seo->meta_title ?? '' }}"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta robots</label>--}}
{{--                                            <input type="text" name="meta_robots" class="form-control"--}}
{{--                                                   value="{{ $seo->meta_robots ?? '' }}"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta description</label>--}}
{{--                                            <textarea class="form-control" id="meta_description"--}}
{{--                                                      name="meta_description">{{ $seo->meta_description ?? '' }}</textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Meta keywords</label>--}}
{{--                                            <textarea class="form-control" id="meta_keywords"--}}
{{--                                                      name="meta_keywords">{{ $seo->meta_keywords ?? '' }}</textarea>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="card-footer">--}}
{{--                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
                        </div>
                        <div class="tab-pane fade show" id="kt_tab_pane_3_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_3_4">
                            <div class="d-flex flex-column-fluid">

                                <!--begin::Container-->
                                <div class="container-fluid">
                                    <!--begin::Card-->
                                    <div class="card card-custom">
                                        <!--begin::Body-->
                                        <div class="card-body pb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-7">
                                                        <form method="GET">
                                                            <div class="input-icon">
                                                                <input id="search_input" type="text" name="search"
                                                                       data-type="{{ request()->get('type') }}"
                                                                       class="form-control form-control-solid"
                                                                       placeholder="Поиск" value="{{ request()->input('search') }}"/>
                                                                <span><i class="flaticon2-search-1 text-muted"></i></span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button data-toggle="modal" data-target="#createFaqModal" class="btn btn-primary font-weight-bold">
                                                        <i class="fas fa-plus mr-2"></i>Додати
                                                    </button>
                                                </div>
                                            </div>

                                            <div id="table_data">
                                                @include('admin.faqs._table')
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::Container-->
                            </div>

                            <!--end::Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->
{{--    @include('admin.categories.modals.create')--}}
{{--    @include('admin.categories.modals.update')--}}
    @include('admin.faqs.modals.create', ['group' => $group])
    @include('admin.faqs.modals.update')

@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/file-upload/image-input.js') }} "></script>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('super_admin/js/category.js') }}"></script>

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var createImagePlugin = new KTImageInput('createImagePlugin');
            var createPageImagePlugin = new KTImageInput('createPageImagePlugin');
        });
        var KTSummernoteDemo = function () {
            // Private functions
            var demos = function () {
                $('.summernote').summernote($.extend(summernoteDefaultOptions, {
                    height: 450
                }));
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            KTSummernoteDemo.init();

            let tbody = document.querySelector('tbody')
            new Sortable(tbody, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    console.log('drop');
                    var list = [];
                    $.each($('tbody tr'), function (idx, el) {
                        list.push({
                            id: $(el).data('id'),
                            position: idx + 1
                        })
                    });

                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.faqs.update_positions') }}',
                        data: {
                            positions: list,
                        },
                        success: function (response) {
                            console.log(response)
                            $.each(response, function(i, item) {
                                $(`tr[data-id="${i}"]`).find('.position').text(item)
                            })
                        }
                    });

                }
            });
        });


        $(document).on('click', '.updateFaq', loadFaq);

        function loadFaq() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.faq.show') }}',
                data: {
                    'id': id
                },
                success: function (response) {
                    $('#updateFaqId').val(id);

                    $('#updateFaqQuestion').val(response.question);
                    $('#updateFaqUrl').val(response.url);
                    $('#updateFaqPos').val(response.position);

                    document.getElementById('updateFaqIsActive').checked = (response.is_active == 1)

                    $('#updateFaqAnswer').summernote('code', response.answer)
                }, error: function (response) {
                    console.log(response)
                }
            });
        }

        $(document).on('change', '.active_switch', function(e) {
            let switch_input = this,
                status = switch_input.checked;

            let data = {
                id: switch_input.dataset.id,
            }

            if (status) {
                data.is_active = true
            }

            $.ajax({
                url: '{{ route('admin.faq.update') }}',
                method: "POST",
                data: data,
                success: function (data) {
                    switch_input.checked = status
                },
                error: function () {
                    switch_input.checked = !status
                }
            })

        })

        $(document).on('keyup', '#search_input', function (e) {
            let q = $(this).val()

            $.ajax({
                url: '{{ route('admin.faqs.search') }}',
                data: {
                    'search': q
                },
                success: function (response) {
                    $('#table_data').html(response)
                }, error: function (response) {
                    console.log(response)
                }
            });
        })
    </script>
@endsection




