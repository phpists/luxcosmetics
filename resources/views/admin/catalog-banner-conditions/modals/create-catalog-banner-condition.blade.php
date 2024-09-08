<div class="modal fade" id="createCatalogBannerConditionModal" tabindex="-1" role="dialog"
     aria-labelledby="createCatalogBannerConditionModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCatalogBannerConditionModalTitle">Добавить условие баннера</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.catalog-banner-conditions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="model_type" value="{{ $model::class }}">
                <input type="hidden" name="model_id" value="{{ $model->id }}">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group w-100">
                                <label class=font-weight-bold">Ряд</label>
                                <input name="row" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Активній</label>
                                <div class="col-12">
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox" checked name="is_active"/>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Распостранить на дочерние</label>
                                <div class="col-12">
                                    <span class="switch">
                                        <label>
                                            <input type="checkbox" checked name="share_with_child"/>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group w-100">
                        <label for="createCatalogBannerConditionBannerId" class="font-weight-bold">Баннеры</label>
                        <select id="createCatalogBannerConditionBannerId" class="form-control selectpicker" name="banner_ids[]"
                                multiple required>
                            @foreach($catalogBanners as $catalogBanner)
                                <option value="{{ $catalogBanner->id }}">{{ $catalogBanner->title }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                </div>
            </form>

        </div>
    </div>
</div>
