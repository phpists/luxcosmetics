<!-- Modal -->
<div class="modal fade" id="updateFaqModal" tabindex="-1" role="dialog" aria-labelledby="updateFaqTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateFaqTitle">Редактировать категорию подписок</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.subscription-category.update') }}" method="POST">
                @csrf
                @method('put')

                <input type="hidden" id="updateId" name="id">

                <div class="modal-body">

                    <div class="row">
                        <div class="col col-md-12 px-0">
                            <div class="form-group w-100">
                                <label for="updateFaqQuestion" class="col-auto col-form-label font-weight-bold">Название</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateName" name="name" required>
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
