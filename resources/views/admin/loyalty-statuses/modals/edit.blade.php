<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Редактировать статус для накопительной системы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.loyalty-statuses.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editTitle" class=font-weight-bold">Название</label>
                                <input type="text" class="form-control" id="editTitle" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="editAchieveSum" class=font-weight-bold">Сумма для получения</label>
                                <input type="number" class="form-control" id="editAchieveSum" name="achieve_sum" min="0">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="editDiscountPercent" class=font-weight-bold">Процент скидки</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="editDiscountPercent" name="discount_percent" min="0" required>
                                    <div class="input-group-append"><span class="input-group-text">%</span></div>
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
