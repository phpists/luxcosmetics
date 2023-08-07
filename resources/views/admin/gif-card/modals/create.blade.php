<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Добавить число</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form action="{{route('admin.fixPrice')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="createLink" class="col-auto col-form-label font-weight-bold">Число</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="fix_price" required>
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
