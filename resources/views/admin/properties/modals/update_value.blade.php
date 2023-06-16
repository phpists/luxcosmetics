<!-- Modal -->
<div class="modal fade" id="createPropertyValueModal" tabindex="-1" role="dialog" aria-labelledby="createPropertyValueTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPropertyValueTitle">Добавить новое значение</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.property-values.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="createPropertyValue" class="col-auto col-form-label font-weight-bold">Значение</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createPropertyValue" name="value" required>
                                </div>
                            </div>
                        </div>
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
