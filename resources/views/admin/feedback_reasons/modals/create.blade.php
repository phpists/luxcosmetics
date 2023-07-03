<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Добавить причину обращения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.feedback-reason.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="tab-content mt-5" id="createTabContent">
                        <div class="tab-pane fade show active" id="general_tab" role="tabpanel">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group w-100">
                                        <label for="createTitle" class="col-auto col-form-label font-weight-bold">Причина</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="createTitle" name="reason" required>
                                        </div>
                                    </div>
                                </div>
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
