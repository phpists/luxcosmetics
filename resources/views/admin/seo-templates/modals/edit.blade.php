<!-- Modal -->
<div class="modal fade" id="editSeoTemplateModal" tabindex="-1" role="dialog" aria-labelledby="editSeoTemplateModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSeoTemplateModalTitle">Редактировать SEO шаблон</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="editSeoTemplateForm" action="{{ route('admin.seo-templates.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editSeoTemplateTitle" class="font-weight-bold">Title</label>
                                <input id="editSeoTemplateTitle" type="text" name="title" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editSeoTemplateDescription" class="font-weight-bold">Description</label>
                                <textarea id="editSeoTemplateDescription" name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <textarea id="editSeoTemplateHint" class="form-control" rows="5" disabled></textarea>
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
