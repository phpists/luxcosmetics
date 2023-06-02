<!-- Modal -->
<div class="modal fade" id="createDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="createDepartmentModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDepartmentModalTitle">Додати новий відділ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.settings.department.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="departureCreateTitle" class="col-auto col-form-label font-weight-bold">Назва</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="departureCreateTitle" name="title" required>
                                    </div>
                                </div>
                            </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрити
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Зберегти</button>
                </div>

            </form>

        </div>
    </div>
</div>
