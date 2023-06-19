<!-- Modal -->
<div class="modal fade" id="createFaqModal" tabindex="-1" role="dialog" aria-labelledby="createFaqTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Добавить распространенный вопрос</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
            </div>

            <form action="{{ route('admin.faq.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{$group->id}}" name="group_id">
                <div class="modal-body">

                    <div class="row">
                        <div class="col col-md-6 px-0">
                            <div class="form-group w-100">
                                <label for="createFaqQuestion" class="col-auto col-form-label font-weight-bold">Заголовок</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createFaqQuestion" name="title" required>
                                </div>
                            </div>
                        </div>

                        <div class="col col-md-1 px-0">
                            <div class="form-group w-100">
                                <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Позиция</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="createFaqPos" name="position" value="{{ $last_position }}" min="1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-3 px-0">
                            <div class="form-group w-100">
                                <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Показывать на сайте</label>
                                <div class="col-sm-12">
                                   <span class="switch">
                                        <label>
                                            <input id="createIsActiveInFooter" checked type="checkbox" name="is_active"/>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-0">
                        <label class="col-auto col-form-label" for="createFaqAnswer">Ответ</label>
                        </div>
                        <div class="col-12">
                            <textarea name="answer" class="summernote" id="createFaqAnswer"></textarea>
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
