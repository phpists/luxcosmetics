<!-- Modal -->
<div class="modal fade" id="updateFaqModal" tabindex="-1" role="dialog" aria-labelledby="updateFaqTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateFaqTitle">Редактировать распространенный вопрос</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.faq.update') }}" method="POST">
                @csrf

                <input type="hidden" id="updateFaqId" name="id">

                <div class="modal-body">

                    <div class="row">
                        <div class="col col-md-6 px-0">
                            <div class="form-group w-100">
                                <label for="updateFaqQuestion" class="col-auto col-form-label font-weight-bold">Вопрос</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateFaqQuestion" name="title" required>
                                </div>
                            </div>
                        </div>

                        <div class="col col-md-1 px-0">
                            <div class="form-group w-100">
                                <label for="updateFaqPos" class="col-auto col-form-label font-weight-bold">Позиция</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="updateFaqPos" name="position" value="{{ $last_position }}" min="1" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group mb-0">
                            <label class="col-auto col-form-label" for="updateFaqAnswer">Ответ</label>
                        </div>
                        <div class="col-12">
                            <textarea name="answer" class="summernote" id="updateFaqAnswer"></textarea>
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
