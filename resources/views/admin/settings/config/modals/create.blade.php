<div class="modal fade" id="createConfigModal" tabindex="-1" role="dialog" aria-labelledby="createConfigModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createConfigTitle">Новая настрйока</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.settings.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="cfg_name"
                                           class="col-sm-12 col-form-label font-weight-bold">Название</label>
                                    <div class="col-sm-12">
                                        <input required type="text" name="name" class="form-control" id="cfg_name">
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
                                        <select class="form-control" id="type" name="type">
                                            <option value="{{\App\Services\SiteConfigService::BOOL}}">Логическое</option>
                                            <option selected value="{{\App\Services\SiteConfigService::TEXT}}">Текстовое</option>
                                            <option value="{{\App\Services\SiteConfigService::NUMERIC}}">Числовое</option>
                                            <option value="{{\App\Services\SiteConfigService::WYSIWYG}}">Текстовый редактор</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="cfg_value"
                                           class="col-sm-12 col-form-label font-weight-bold">Значение</label>
                                    <div class="col-sm-12" id="inp_val">
                                        <input required type="text" name="value" class="form-control" id="cfg_value">
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
