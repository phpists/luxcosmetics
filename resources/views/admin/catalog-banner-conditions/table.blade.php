@if(auth()->user()->isSuperAdmin()
|| auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_VIEW))
    <div class="tab-pane fade" id="catalogBanners" role="tabpanel"
         aria-labelledby="properties_tab">
        <div class="row mb-5">
            <div class="col">
                <div class="mb-7">
                    <h3>Баннеры в каталоге</h3>
                </div>
            </div>
            <div class="col-auto">
                @if(auth()->user()->isSuperAdmin()
|| auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_CREATE))
                <button data-toggle="modal" data-target="#createCatalogBannerConditionModal"
                        class="btn btn-primary font-weight-bold">
                    <i class="fas fa-plus mr-2"></i>
                    Добавить
                </button>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center">
                <thead>
                <tr>
                    <th class="text-center pr-0">
                        Ряд
                    </th>
                    <th class="text-center pr-0">
                        Активный
                    </th>
                    <th class="pr-0 text-center">
                        Баннеры
                    </th>
                    <th class="pr-0 text-center">
                        Распостранить на дочерние
                    </th>
                    <th class="pr-0 text-center">
                        Действия
                    </th>
                </tr>
                </thead>
                <tbody id="product_sorting-table">
                @foreach($model->bannerConditions as $bannerCondition)
                    <tr data-id="{{ $bannerCondition->id }}">
                        <td class="text-center pl-0">
                            {{ $bannerCondition->row }}
                        </td>
                        <td class="text-center">
                            @if(auth()->user()->isSuperAdmin()
|| auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_EDIT))
                                <span class="switch d-flex justify-content-center catalog-banner-conditions"
                                      data-url="{{ route('admin.catalog-banner-conditions.update-switch', $bannerCondition) }}">
                                        <label>
                                            <input name="is_active" type="checkbox" @checked($bannerCondition->is_active)/>
                                            <span></span>
                                        </label>
                                    </span>
                            @else
                                {{ $bannerCondition->is_active ? 'Да' : 'Нет' }}
                            @endif
                        </td>
                        <td class="text-center">
                                                <span class="text-dark-75 d-block font-size-lg">
                                                    {{ $bannerCondition->banners()->pluck('title')->join(', ') }}
                                                </span>
                        </td>
                        <td class="text-center position">
                            @if(auth()->user()->isSuperAdmin()
|| auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_EDIT))
                                <span class="switch d-flex justify-content-center catalog-banner-conditions"
                                      data-url="{{ route('admin.catalog-banner-conditions.update-switch', $bannerCondition) }}"
                                      disabled>
                                                    <label>
                                                        <input name="share_with_child" type="checkbox" @checked($bannerCondition->share_with_child)/>
                                                        <span></span>
                                                    </label>
                                                </span>
                            @else
                                {{ $bannerCondition->share_with_child ? 'Да' : 'Нет' }}
                            @endif
                        </td>
                        <td class="text-center pr-0">
                            @if(auth()->user()->isSuperAdmin()
|| auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_EDIT))
                                <a href="javascript:"
                                   class="btn btn-sm btn-clean btn-icon edit-catalog-banner-condition"
                                   data-toggle="modal" data-target="#editCatalogBannerConditionModal"
                                   data-show-url="{{ route('admin.catalog-banner-conditions.show', $bannerCondition) }}"
                                   data-update-url="{{ route('admin.catalog-banner-conditions.update', $bannerCondition) }}"
                                >
                                    <i class="las la-edit"></i>
                                </a>
                            @endif
                            @if(auth()->user()->isSuperAdmin()
|| auth()->user()->can(\App\Services\Admin\PermissionService::CATALOG_BANNERS_DELETE))
                                <form action="{{ route('admin.catalog-banner-conditions.destroy', $bannerCondition) }}"
                                      method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                            onclick="return confirm('Вы уверены, что хотите удалить условие банеров?')"
                                            title="Delete"><i class="las la-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>


    @include('admin.catalog-banner-conditions.modals.create-catalog-banner-condition')
    @include('admin.catalog-banner-conditions.modals.edit-catalog-banner-condition')

    <script>
        let catalogBannerConditionsInited = false;

        setInterval(() => {
            if (!catalogBannerConditionsInited) {
                $(document).on('change', '.switch.catalog-banner-conditions input:checkbox', function (e) {
                    let data = {};
                    data[this.name] = this.checked;

                    $.ajax({
                        type: 'POST',
                        url: $(this).parents('.switch:first').data('url'),
                        data: data,
                    })
                })
                $(document).on('click', '.edit-catalog-banner-condition', loadCatalogBannerCondition);

                catalogBannerConditionsInited = true;
            }
        }, 500)

        function loadCatalogBannerCondition() {
            let showUrl = this.dataset.showUrl,
                updateUrl = this.dataset.updateUrl,
                $modal = $('#editCatalogBannerConditionModal'),
                $form = $modal.find('form');

            $.ajax({
                url: showUrl,
                success: function (response) {
                    $form.attr('action', updateUrl);

                    $form.find('input[name="row"]').val(response.row)
                    $form.find('input[name="is_active"]').prop('checked', response.is_active === true)
                    $form.find('input[name="share_with_child"]').prop('checked', response.share_with_child === true)
                    $form.find('[name="banner_ids[]"]').val(response.bannerIds).trigger('change')
                }, error: function (response) {
                    console.log(response)
                }
            });
        }
    </script>
@endif
