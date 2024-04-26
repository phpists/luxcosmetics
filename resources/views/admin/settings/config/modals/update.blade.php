<div class="modal fade" id="updateConfigModal" tabindex="-1" role="dialog" aria-labelledby="updateConfigModal" data-focus="false"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Редактировать Настройку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="cfg_name"
                                           class="col-sm-12 col-form-label font-weight-bold">Название</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="name"  readonly class="form-control" id="cfg_upd_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="cfg_value"
                                           class="col-sm-12 col-form-label font-weight-bold">Тип данных</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" disabled id="type_upd">
                                            <option value="{{\App\Services\SiteConfigService::BOOL}}">Логическое</option>
                                            <option value="{{\App\Services\SiteConfigService::TEXT}}">Текстовое</option>
                                            <option value="{{\App\Services\SiteConfigService::NUMERIC}}">Числовое</option>
                                            <option value="{{\App\Services\SiteConfigService::WYSIWYG}}">Текстовый редактор</option>
                                        </select>
                                        <input type="hidden" name="type" id="type_upd_val">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="cfg_value"
                                           class="col-sm-12 col-form-label font-weight-bold">Значение</label>
                                    <div class="col-sm-12" id="inp_upd_val">
                                        <input type="text" required name="value" class="form-control" id="cfg_upd_value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-light-primary font-weight-bold"
                                data-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
