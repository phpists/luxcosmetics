<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Редактировать статус заказа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="editForm" action="{{ route('admin.order_statuses.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <div class="form-group w-100">
                                        <label for="editColor" class="col-auto col-form-label font-weight-bold">Цвет</label>
                                        <input class="form-control" type="color" id="editColor" name="color" required>
                                    </div>
                                </div>

                                <div class="col-md-10 col-12">
                                    <div class="form-group w-100">
                                        <label for="editTitle" class="col-auto col-form-label font-weight-bold">Название</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="editTitle" name="title" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Редактировать</button>
                </div>

            </form>

        </div>
    </div>
</div>
