<div class="modal fade" id="updateProductQuestion" tabindex="-1" role="dialog" aria-labelledby="updateProductQuestion"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Редактировать вопрос</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.product_question.update') }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="question_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="createSeller"
                                           class="col-sm-12 col-form-label font-weight-bold">Вопрос</label>
                                    <div class="col-sm-12">
                                        <textarea style="height: 150px" id="updateQuestionMessage" class="form-control" name="message"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="createSeller" class="col-sm-12 col-form-label font-weight-bold">Статус</label>
                                    <div class="col-sm-12">
                                        <select name="status" id="updateStatus" class="form-control">
                                            <option value="{{\App\Models\ProductQuestion::NEW}}">{{\App\Services\SiteService::getProductQuestionStatus(\App\Models\ProductQuestion::NEW)}}</option>
                                            <option value="{{\App\Models\ProductQuestion::PUBLISHED}}">{{\App\Services\SiteService::getProductQuestionStatus(\App\Models\ProductQuestion::PUBLISHED)}}</option>
                                            <option value="{{\App\Models\ProductQuestion::CLOSED}}">{{\App\Services\SiteService::getProductQuestionStatus(\App\Models\ProductQuestion::CLOSED)}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-light-primary font-weight-bold"
                                data-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
