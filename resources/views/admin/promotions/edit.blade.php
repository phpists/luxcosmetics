@extends('admin.layouts.app')

@section('styles')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
@endsection

@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Редакрирование акции "{{ $promotion->title }}"</h5>
                <!--end::Page Title-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#generalTab">
                                    <span class="nav-text">Основная информация</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#propertiesTab">
                                    <span class="nav-text">Характеристики</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#productsTab">
                                    <span class="nav-text">Товары</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#seoTab">
                                    <span class="nav-text">SEO</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-toolbar">
                        <a href="{{ route('promotions.show', $promotion) }}" class="btn btn-secondary mx-2" target="_blank">
                            <i class="las la-eye"></i>
                            Просмотр
                        </a>
                        <button type="submit" form="editPromotionForm" class="btn btn-primary tab-submit-btn"
                                data-tab="generalTab">Сохранить
                        </button>
                        <button type="submit" form="editSeoDataForm" class="btn btn-primary tab-submit-btn"
                                data-tab="seoTab" style="display: none">Сохранить SEO
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="generalTab" role="tabpanel"
                             aria-labelledby="generalTab">
                            <form id="editPromotionForm" action="{{ route('admin.promotions.update', $promotion) }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @include('admin.promotions._form', ['promotion' => $promotion])
                            </form>
                        </div>
                        <div class="tab-pane fade" id="propertiesTab" role="tabpanel" aria-labelledby="propertiesTab">
                            <button type="button" data-toggle="modal" data-target="#createPropertyModal"
                                    class="btn btn-outline-primary mb-5">
                                <i class="la la-plus"></i>Добавить характеристику
                            </button>
                            <div id="propertiesContainer">
                                @include('admin.promotions._properties', ['properties' => $promotion->properties])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="productsTab" role="tabpanel" aria-labelledby="productsTab">
                            <button data-toggle="modal" data-target="#createPromotionProductModal"
                                    class="btn btn-outline-primary mb-5">
                                <i class="la la-plus"></i>Добавить товар
                            </button>
                            <div id="productsContainer">
                            @include('admin.promotions._products', ['products' => $promotion->products])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="seoTab" role="tabpanel" aria-labelledby="seoTab">
                            @include('admin.seo-data.edit', ['seoData' => $promotion->seo])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>

    @include('admin.promotions.modals.add_property_value')
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/filepond/filepond-plugin-image-preview.js') }}"></script>
    <script src="{{ asset('super_admin/js/filepond/filepond.js') }}"></script>
    <script src="{{ asset('super_admin/ckeditor/ckeditor.js') }} "></script>
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/Sortable.js') }}"></script>
    <script>
        let arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }

        FilePond.registerPlugin(FilePondPluginImagePreview);

        let filePonds = {},
            select2Options = {
                tags: true,
                placeholder: 'Выберите'
            }

        CKEDITOR.stylesSet.add('promotions', [
            {
                name: 'Зеленый',
                element: 'p',
                attributes: {
                    class: 'green'
                }
            },
            {
                name: 'Синий',
                element: 'p',
                attributes: {
                    class: 'blue'
                }
            },
            {
                name: 'Красный',
                element: 'p',
                attributes: {
                    class: 'red'
                }
            },
        ])
        CKEDITOR.config.stylesSet = 'promotions'

        $(function () {
            CKEDITOR.replace('promotionShortContent');

            $('.filepond-container:not(.initialized)').each(function (i, el) {
                let input = $(el).find('input:file')[0],
                    options = {
                        storeAsFile: true,
                        required: input.required,
                    };

                const imgSrc = input.dataset.value;

                if (imgSrc) {
                    options.files = [
                        {
                            source: imgSrc,
                            options: {
                                type: 'local'
                            },
                        }
                    ]
                    options.server = {
                        load: (uniqueFileId, load, error, progress, abort, headers) => {
                            fetch(imgSrc).then((res) => {
                                return res.blob();
                            }).then(load);
                        }
                    }
                }

                filePonds[input.id] = FilePond.create(input, options);
                el.classList.add('initialized')
            })

            $(document).on('hide.bs.tab', '[data-toggle="tab"]', function (e) {
                $('.tab-submit-btn').hide();
            })

            $(document).on('shown.bs.tab', '[data-toggle="tab"]', function (e) {
                const tab = e.target,
                    tabName = tab.href.split('#')[1];

                $(`.tab-submit-btn[data-tab="${tabName}"]`)?.show();
            })

            $(document).on('submit', '#editPromotionForm', function (e) {
                e.preventDefault();
                const $form = $(this),
                    formData = new FormData(this)

                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $form.find('[type="submit"]').prop('disabled', true)
                        $(`button:submit[form="${$form.attr('id')}"]`).prop('disabled', true)
                    },
                    success: function (response, status, jqXHR) {
                        toastr.success(response.message);
                    },
                    error: function (jqXHR, status, error) {
                        if (jqXHR.status === 422)
                            showErrors(jqXHR.responseJSON.errors);
                        toastr.error(jqXHR.responseJSON.message);
                    },
                    complete: function () {
                        $form.find('[type="submit"]').prop('disabled', false)
                        $(`button:submit[form="${$form.attr('id')}"]`).prop('disabled', false)
                    }
                })

                return false;
            })

            // properties
            $(document).on('shown.bs.modal', '#createPropertyModal', function (e) {
                $('#createPropertyForm .select2').select2(select2Options)
            })

            $(document).on('change', '#createPropertyTitle', function (e) {
                const title = this.value;

                $.ajax({
                    url: '{{ route('admin.promotion.properties.values') }}',
                    data: {
                        'title': title
                    },
                    dataType: 'json',
                    success: function (response) {
                        let options = select2Options;
                        options.data = response.data;

                        $('#createPropertyValue').select2(options)
                    }
                })
            })

            $(document).on('submit', '#createPropertyForm', function (e) {
                e.preventDefault();

                const $form = $(this),
                    formData = new FormData(this)

                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $form.find('[type="submit"]').prop('disabled', true)
                        $(`button:submit[form="${$form.attr('id')}"]`).prop('disabled', true)
                    },
                    success: function (response, status, jqXHR) {
                        toastr.success(response.message);
                        $('#propertiesContainer').load('{{ route('admin.promotion.properties.index', $promotion) }}')
                        $('#createPropertyModal').modal('hide')
                    },
                    error: function (jqXHR, status, error) {
                        if (jqXHR.status === 422)
                            showErrors(jqXHR.responseJSON.errors);
                        toastr.error(jqXHR.responseJSON.message);
                    },
                    complete: function () {
                        $form.find('[type="submit"]').prop('disabled', false)
                        $(`button:submit[form="${$form.attr('id')}"]`).prop('disabled', false)
                    }
                })

                return false;
            })

            $(document).on('click', '.delete-property', function (e) {
                if (confirm('Вы уверенны, что хотите удалить характеристику?')) {
                    $.ajax({
                        type: 'delete',
                        url: this.dataset.url,
                        success: function (response, status, jqXHR) {
                            toastr.success(response.message);
                            $('#propertiesContainer').load('{{ route('admin.promotion.properties.index', $promotion) }}')
                        },
                        error: function (jqXHR, status, error) {
                            if (jqXHR.status === 422)
                                showErrors(jqXHR.responseJSON.errors);
                            toastr.error(jqXHR.responseJSON.message);
                        },
                    })
                }
            })

            // add product modal
            $(document).on('shown.bs.modal', '#createPromotionProductModal', function (e) {
                let options = select2Options;
                options.tags = false;
                $('#createPromotionProductForm .select2').select2(options)
            })

            $(document).on('submit', '#createPromotionProductForm', function (e) {
                e.preventDefault();

                const $form = $(this),
                    formData = new FormData(this)

                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $form.find('[type="submit"]').prop('disabled', true)
                        $(`button:submit[form="${$form.attr('id')}"]`).prop('disabled', true)
                    },
                    success: function (response, status, jqXHR) {
                        toastr.success(response.message);
                        $('#productsContainer').load('{{ route('admin.promotion.products.index', $promotion) }}')
                        $('#createPromotionProductModal').modal('hide')
                    },
                    error: function (jqXHR, status, error) {
                        if (jqXHR.status === 422)
                            showErrors(jqXHR.responseJSON.errors);
                        toastr.error(jqXHR.responseJSON.message);
                    },
                    complete: function () {
                        $form.find('[type="submit"]').prop('disabled', false)
                        $(`button:submit[form="${$form.attr('id')}"]`).prop('disabled', false)
                    }
                })

                return false;
            })

            $(document).on('click', '.delete-product', function (e) {
                if (confirm('Вы уверенны, что хотите удалить товар?')) {
                    $.ajax({
                        type: 'delete',
                        url: this.dataset.url,
                        success: function (response, status, jqXHR) {
                            toastr.success(response.message);
                            $('#productsContainer').load('{{ route('admin.promotion.products.index', $promotion) }}')
                        },
                        error: function (jqXHR, status, error) {
                            if (jqXHR.status === 422)
                                showErrors(jqXHR.responseJSON.errors);
                            toastr.error(jqXHR.responseJSON.message);
                        },
                    })
                }
            })

            let productsTable = document.querySelector('#productsTable tbody')
            new Sortable(productsTable, {
                animation: 150,
                handle: '.handle',
                dragClass: 'table-sortable-drag',
                onEnd: function (/**Event*/ evt) {
                    let list = {};
                    $.each($(productsTable).find('tr'), function (idx, el) {
                        list[$(el).data('id')] = {
                            pos: idx + 1
                        };
                    });

                    $.ajax({
                        method: 'post',
                        url: $(productsTable).data('update-positions-url'),
                        data: {
                            positions: list,
                        },
                        success: function (response) {
                        }
                    });

                }
            });


            $(document).on('submit', '#editSeoDataForm', function (e) {
                e.preventDefault();
                const $form = $(this),
                    formData = new FormData(this)

                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $form.find('[type="submit"]').prop('disabled', true)
                        $(`button:submit[form="${$form.attr('id')}"]`).prop('disabled', true)
                    },
                    success: function (response, status, jqXHR) {
                        toastr.success(response.message);
                    },
                    error: function (jqXHR, status, error) {
                        if (jqXHR.status === 422)
                            showErrors(jqXHR.responseJSON.errors);
                        toastr.error(jqXHR.responseJSON.message);
                    },
                    complete: function () {
                        $form.find('[type="submit"]').prop('disabled', false)
                        $(`button:submit[form="${$form.attr('id')}"]`).prop('disabled', false)
                    }
                })

                return false;
            })

        })

        function showErrors(errors, feedbackClass = 'invalid-feedback') {
            for (let name in errors) {
                const $el = $(`[name=${name}]`).addClass('is-invalid');
                if ($el.next().hasClass(feedbackClass))
                    $el.next().text(errors[name].join(' | '))
                else
                    $el.after(`<span class="${feedbackClass}">${errors[name].join(' | ')}</span>`)
            }

            document.querySelector('.is-invalid').scrollIntoView({behavior: 'smooth'})
        }
    </script>
@endsection
