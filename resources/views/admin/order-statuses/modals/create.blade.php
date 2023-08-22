<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Добавить статус заказа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.order_statuses.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <div class="form-group w-100">
                                        <label for="createColor" class="col-auto col-form-label font-weight-bold">Цвет</label>
                                        <input class="form-control" type="color" id="createColor" name="color" required>
                                    </div>
                                </div>

                                <div class="col-md-10 col-12">
                                    <div class="form-group w-100">
                                        <label for="createTitle" class="col-auto col-form-label font-weight-bold">Название</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="createTitle" name="title" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Добавить</button>
                </div>

            </form>

        </div>
    </div>
</div>
