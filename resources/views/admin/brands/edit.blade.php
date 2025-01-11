@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1"><!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Редактирование бренда</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}" class="text-muted">Главная</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.brands.index') }}" class="text-muted">Бренды</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#"
                           class="text-muted">{{ $brand->name }}</a>
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
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>

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
                                <a class="nav-link active" data-toggle="tab" href="#general">
                                    <span class="nav-text">Основное</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tags">
                                    <span class="nav-text">Теги</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#sorting">
                                    <span class="nav-text">Сортировка товаров</span>
                                </a>
                            </li>
                            @if(auth()->user()->isSuperAdmin()
               || auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_VIEW))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#catalogBanners">
                                        <span class="nav-text">Баннеры в каталоге</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general">
                            <form action="{{ route('admin.brands.update', $brand) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Название</label>
                                                        <input type="text" name="name" class="form-control" required
                                                               value="{{ $brand->name }}"/>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Ссылка</label>
                                                        <input type="text" name="link" class="form-control" required
                                                               value="{{ $brand->link }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Изображение</label>
                                                <div class="col-auto ml-2">
                                                    <div class="image-input image-input-outline" id="createImagePlugin">
                                                        <div class="image-input-wrapper" id="updateImageBackground"
                                                             style="background-image: url('{{ asset('images/uploads/brands/' . $brand->image) }}')"></div>
                                                        <label
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="change" data-toggle="tooltip"
                                                            data-original-title="Change avatar">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="image" accept="image/*"/>
                                                            <input type="hidden" name="image_remove"/>
                                                        </label>
                                                        <span
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="cancel" data-toggle="tooltip"
                                                            title="Cancel avatar">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                        <span
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="remove" data-toggle="tooltip"
                                                            title="Remove avatar">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>H1 тег</label>
                                                <input type="text" name="seo_content[h1]" class="form-control"
                                                       value="{{ $brand->getSeo('h1') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Заголовок внизу</label>
                                                <input type="text" name="seo_content[bottom_title]" class="form-control"
                                                       value="{{ $brand->getSeo('bottom_title') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Текст внизу</label>
                                                <textarea name="seo_content[bottom_text]" id="brandSeoContentBottomText">{{ $brand->getSeo('bottom_text') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Скрытый текст внизу</label>
                                                <textarea name="seo_content[hidden_bottom_text]" id="brandSeoContentHiddenBottomText">{{ $brand->getSeo('hidden_bottom_text') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tags" role="tabpanel"
                             aria-labelledby="tags">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Теги</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createTagModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>
                                        Добавить
                                    </button>
                                </div>
                            </div>
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
                                            Изображение
                                        </th>
                                        <th class="text-center pr-0">
                                            Название
                                        </th>
                                        <th class="pr-0 text-center">
                                            Ссылка
                                        </th>
                                        <th class="pr-0 text-center">
                                            Позиция
                                        </th>
                                        <th class="pr-0 text-center">
                                            Активный
                                        </th>
                                        <th class="pr-0 text-center">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="top_menu" class="tag-table" data-value="1">
                                    <tr>
                                        <th colspan="5">Верхние теги</th>
                                    </tr>
                                    @foreach($brand->topTags as $tag)
                                        <tr class="s-item" id="tag_{{ $tag->id }}" data-id="{{ $tag->id }}">
                                            <td class="handle text-center pl-0" style="cursor: pointer">
                                                <i class="flaticon2-sort"></i>
                                            </td>
                                            <td class="text-center pl-0">
                                                {{ $tag->id }}
                                            </td>
                                            <td class="text-center position">
                                                <div class="mx-auto rounded-circle overflow-hidden"
                                                     style="width: fit-content">
                                                    <img src="{{ $tag->getImageSrcAttribute() }}" width="50" height="50"
                                                         alt="">
                                                </div>
                                            </td>
                                            <td class="text-center position">
                                                <span class="text-dark-75 d-block font-size-lg sort_col">
                                                    {{ $tag->name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg">
                                                    {{ $tag->link }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg pos_tag">
                                                    {{ $tag->position }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                   <span class="switch d-flex justify-content-center tag-updatable"
                                         data-url="{{ route('admin.tag.update-is-active', $tag) }}">
                                        <label>
                                            <input type="checkbox" @checked($tag->is_active)/>
                                            <span></span>
                                        </label>
                                    </span>
                                            </td>
                                            <td class="text-center pr-0">
                                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateTag"
                                                   data-toggle="modal" data-target="#updateFaqModal"
                                                   data-id="{{ $tag->id }}">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <button type="button"
                                                        class="btn btn-sm btn-clean btn-icon btn_delete tag_delete"
                                                        data-label="{{ $tag->name }}"
                                                        data-value="{{$tag->id}}"
                                                        title="Delete"><i class="las la-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody id="bt_menu" class="tag-table" data-value="0">
                                    <tr>
                                        <th colspan="5">Нижние теги</th>
                                    </tr>
                                    @foreach($brand->bottomTags as $tag)
                                        <tr class="s-item" id="tag_{{ $tag->id }}" data-id="{{ $tag->id }}">
                                            <td class="handle text-center pl-0" style="cursor: pointer">
                                                <i class="flaticon2-sort"></i>
                                            </td>
                                            <td class="text-center pl-0">
                                                {{ $tag->id }}
                                            </td>
                                            <td class="text-center position">
                                                <div class="mx-auto rounded-circle overflow-hidden"
                                                     style="width: fit-content">
                                                    <img src="{{ $tag->getImageSrcAttribute() }}" width="50" height="50"
                                                         alt="">
                                                </div>
                                            </td>
                                            <td class="text-center position">
                                                <span class="text-dark-75 d-block font-size-lg sort_col">
                                                    {{ $tag->name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg">
                                                    {{ $tag->link }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg pos_tag">
                                                    {{ $tag->position }}
                                                </span>
                                            </td>
                                            <td class="text-center pr-0">
                                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateTag"
                                                   data-toggle="modal" data-target="#updateFaqModal"
                                                   data-id="{{ $tag->id }}">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <button type="button"
                                                        class="btn btn-sm btn-clean btn-icon tag_delete btn_delete"
                                                        data-label="{{ $tag->name }}"
                                                        data-value="{{$tag->id}}"
                                                        title="Delete"><i class="las la-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <div class="tab-pane fade" id="sorting" role="tabpanel"
                             aria-labelledby="properties_tab">
                            <div class="row mb-5">
                                <div class="col">
                                    <div class="mb-7">
                                        <h3>Сортировка "По умолчанию"</h3>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button data-toggle="modal" data-target="#createBrandProductSortModal"
                                            class="btn btn-primary font-weight-bold">
                                        <i class="fas fa-plus mr-2"></i>
                                        Добавить
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 text-center">
                                            #
                                        </th>
                                        <th class="text-center pr-0">
                                            Название
                                        </th>
                                        <th class="pr-0 text-center">
                                            Ссылка
                                        </th>
                                        <th class="pr-0 text-center">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="product_sorting-table">
                                    @foreach($brand->productSorts as $productSort)
                                        <tr data-id="{{ $productSort->id }}">
                                            <td class="handle text-center pl-0" style="cursor: pointer">
                                                <i class="flaticon2-sort"></i>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg">
                                                    {{ $productSort->product->title }}
                                                </span>
                                            </td>
                                            <td class="text-center position">
                                                <span class="text-dark-75 d-block font-size-lg sort_col">
                                                    <a href="{{ route('products.product', ['alias' => $productSort->product->alias]) }}"
                                                       target="_blank">{{ $productSort->product->alias }}</a>
                                                </span>
                                            </td>
                                            <td class="text-center pr-0">
                                                <form
                                                    action="{{ route('admin.category-product-sorts.destroy', $productSort) }}"
                                                    method="POST" style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-clean btn-icon btn_delete"
                                                            onclick="return confirm('Вы уверены, что хотите удалить сортировку товара?')"
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
                        </div>
                        @include('admin.catalog-banner-conditions.table', ['model' => $brand])
                    </div>
                </div>
            </div>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--end::Container-->
    </div>
    <!--end::Container-->
    <!--end::Entry-->
    @include('admin.categories.modals.create-tag', ['morphable_type' => \App\Models\Brand::class, 'morphable_id' => $brand->id])
    @include('admin.categories.modals.update-tag', ['morphable_type' => \App\Models\Brand::class, 'morphable_id' => $brand->id])
    @include('admin.brands.modals.create-brand_product_sort', ['products' => $brand->products->whereNotIn('id', $brand->productSorts->pluck('product_id'))])
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/file-upload/image-input.js') }} "></script>
    <script src="{{ asset('super_admin/js/Sortable.js') }}"></script>

    <script>
        $(function () {

            CKEDITOR.replace( 'brandSeoContentBottomText' );
            CKEDITOR.replace( 'brandSeoContentHiddenBottomText' );

            $(document).on('change', '.switch.tag-updatable input:checkbox', function (e) {
                $.ajax({
                    type: 'POST',
                    url: $(this).parents('.switch:first').data('url'),
                    data: {
                        is_active: this.checked
                    },
                })
            })


            $('#createBrandProductSortProductId').select2({
                placeholder: "Выберите товар",
            });


            const categoryProductSorts = document.getElementById('product_sorting-table')
            new Sortable(categoryProductSorts, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    console.log('drop');
                    var list = [];
                    $.each($(categoryProductSorts).find('tr'), function (idx, el) {
                        list.push({
                            id: $(el).data('id'),
                            position: idx + 1
                        })
                    });

                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.category-product-sorts.update-positions') }}',
                        data: {
                            positions: list,
                        },
                    });

                }
            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var createImagePlugin = new KTImageInput('createImagePlugin');
            var createPageImagePlugin = new KTImageInput('createPageImagePlugin');
            var updateCatPostImagePlugin = new KTImageInput('updateCategoryPostModal');
            var updateTagImage = new KTImageInput('updateImageTag');
            var createCatPostImagePlugin = new KTImageInput('createCatPostImagePlugin');
            var createArticleImage = new KTImageInput('createArticleImage');
            var editArticleImage = new KTImageInput('editArticleImage');

            KTSummernoteDemo.init();

            KTSummernoteLg.init();

            $(document).on('click', '.updateTag', loadTag);

            function loadTag() {
                let id = $(this).data('id');

                $.ajax({
                    url: '{{ route('admin.tag.show') }}',
                    data: {
                        'id': id
                    },
                    success: function (response) {
                        $('#updateTagId').val(id);

                        $(`#addToTop option[value="${response.add_to_top}"]`).attr('selected', 'selected');
                        $('#updateName').val(response.name);
                        $('#updateLink').val(response.link);
                        $('#imageWindow').css({
                            'background-image': 'url({{asset('/')}}images/uploads/tags/' + response.image_path + ')'
                        });

                        // document.getElementById('updateFaqIsActive').checked = (response.is_active == 1)

                        // $('#updateFaqAnswer').summernote('code', response.answer)
                    }, error: function (response) {
                        console.log(response)
                    }
                });
            }

            document.querySelectorAll('.editCategoryPost').forEach(function (el) {
                el.addEventListener('click', loadCategoryPost)
            })

            function loadCategoryPost(ev) {
                console.log('test')
                let id = ev.currentTarget.dataset.id;

                $.ajax({
                    url: '/admin/category_posts/' + id,
                    success: function (result) {
                        $('#updateCatPostContent').summernote('code', result.content)
                        $('#updateCatPostTitle').val(result.title);
                        $('#updateCatPostLink').val(result.link);
                        let status = result.is_active;
                        $(`#updateCatPostStatus option[value=${status}]`).attr('selected', true);
                        $('#updateCatPostImageBackground').css('background-image', 'url(/images/uploads/category_posts/' + result.image_path + ')')
                        $('#updateCatPostId').val(result.id)
                    },
                    error: (result) => {
                        console.log(result)
                    }
                })
            }


            $('#category_banner_create_select').select2();

            function updateTagsPos(/**Event*/ evt) {
                var list = [];
                var idxs = {};
                $.each($('.tag-table').find('tr.s-item'), function (idx, el) {
                    let label = $(el).parent().data('value');
                    if (!idxs.hasOwnProperty(label)) {
                        idxs[label] = 0;
                    }
                    idxs[label] = idxs[label] + 1;
                    list.push({
                        id: $(el).data('id'),
                        position: idxs[label],
                        add_to_top: $(el).parent().data('value')
                    })
                });

                $.ajax({
                    method: 'post',
                    url: '{{ route('admin.tag.update_position') }}',
                    data: {
                        positions: list,
                    },
                    success: function (res) {
                        list.forEach(function (el) {
                            $('#tag_' + el['id']).find('.pos_tag')[0].innerText = el['position'];
                        })
                    }
                });

            }

            function updatePostsPos(/**Event*/ evt) {
                var idxs = {};
                $.each($('.category_posts_table').find('tr.category_post_draggable'), function (idx, el) {
                    idxs[el.dataset.id] = idx + 1
                });

                $.ajax({
                    method: 'post',
                    url: '{{ route('admin.category_posts.update_positions') }}',
                    data: {
                        positions: idxs,
                    },
                    success: function (res) {
                        for (const idx in res) {
                            $('#category_post_' + idx).find('.cat_post_position')[0].innerText = res[idx];
                        }
                    },
                    error: (result) => {
                        console.log(result);
                    }
                });

            }

            let top_menu = document.getElementById('top_menu');
            let bt_menu = document.getElementById('bt_menu');

            new Sortable(top_menu, {
                group: 'shared', // set both lists to same group
                animation: 150,
                draggable: '.s-item',
                onEnd: updateTagsPos
            });
            new Sortable(bt_menu, {
                group: 'shared', // set both lists to same group
                animation: 150,
                draggable: '.s-item',
                onEnd: updateTagsPos
            });
        });


        function ajaxDelete(url, id, el_delete) {
            if (!confirm('Вы уверенны, что хотите удалить запись?')) {
                return;
            }
            $.ajax({
                url: url,
                method: 'delete',
                data: {
                    id: id
                },
                success: function () {
                    document.querySelector(el_delete)?.remove();
                },
                error: function (res) {
                    console.log(res)
                }
            })
        }

        document.querySelectorAll('.tag_delete').forEach((el, id) => {
            el.addEventListener('click', () => {
                ajaxDelete('/admin/tag', el.dataset.value, '#tag_' + el.dataset.value)
            })
        })
        document.querySelectorAll('.post_delete').forEach((el, id) => {
            el.addEventListener('click', () => {
                ajaxDelete('/admin/category_post/delete', el.dataset.value, '#category_post_' + el.dataset.value)
            })
        })
        var KTSummernoteDemo = function () {
            // Private functions
            var demos = function () {
                $('.summernote').summernote($.extend(summernoteDefaultOptions, {
                    height: 250
                }));
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();
        var KTSummernoteLg = function () {
            // Private functions
            var demos = function () {
                $('.summernote-lg').summernote($.extend(summernoteDefaultOptions, {
                    height: 450
                }));
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();


        function loadModelArticle() {
            let id = $(this).data('id'),
                showUrl = this.dataset.showUrl,
                updateUrl = this.dataset.updateUrl;

            $.ajax({
                url: showUrl,
                data: {
                    id: id
                },
                success: function (response) {
                    $('#editArticleModal form').attr('action', updateUrl);

                    let img_url = `url("${response.image_src}")`;
                    $('#editArticleImageBackground').css('background-image', img_url);
                    $('#editArticleTitle').val(response.title);
                    $('#editArticleLink').val(response.link);
                    $('#editArticlePosition').val(response.position);
                    $('#editArticleDescription').summernote('code', response.description)
                    $('#editArticleIsActive').prop('checked', response.is_active == 1);
                },
                error: function (response) {
                    console.log(response)
                }
            })
        }

    </script>
@endsection




