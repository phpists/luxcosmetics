<!-- Modal -->
<div class="modal fade" id="telephonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalTitle">Оновить ваш номер телефона</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <form action="{{ route('admin.settings.phone.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input id="updateId" type="hidden" name="id">
                            <div class="form-group">
                                <label for="updateLink" class="col-form-label font-weight-bold">Номер телефона</label>
                                <input placeholder="Ваш номер" type="text" class="form-control" name="phone" id="phone" required>
                            </div>
                            <div class="modal-fade">
                                <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                                <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                                    Закрыть
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

