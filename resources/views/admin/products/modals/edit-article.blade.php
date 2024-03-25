<style>
    .select2-container {
        width: 100% !important;
    }
    .art-image .image-input-wrapper {
        width: 170px!important;
        height: 170px!important;
        background-size: auto!important;
        background-position: center!important;
    }
</style>
<div class="modal fade" id="editArticleModal" tabindex="-1" role="dialog" aria-labelledby="editTagModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTagTitle">Редактировать статью</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="image-input art-image image-input-outline" id="editArticleImage">
                                <div class="image-input-wrapper" id="editArticleImageBackground"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="image" accept="image/*"/>
                                    <input type="hidden" name="image_remove"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-12 px-0">
                                    <div class="form-group w-100">
                                        <label for="editArticleTitle" class="col-auto col-form-label font-weight-bold">Заголовок</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="editArticleTitle" name="title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 px-0">
                                    <div class="form-group w-100">
                                        <label for="editArticleLink" class="col-auto col-form-label font-weight-bold">Ссылка</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="editArticleLink" name="link" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-7 px-0">
                                    <div class="form-group w-100">
                                        <label for="editArticlePosition" class="col-auto col-form-label font-weight-bold">Позиция</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="editArticlePosition" name="position" min="1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group w-100">
                                        <label for="editArticleIsActive" class="col-auto col-form-label font-weight-bold">Показывать на сайте</label>
                                        <div class="col-sm-12">
                                   <span class="switch">
                                        <label>
                                            <input id="editArticleIsActive" checked type="checkbox" name="is_active"/>
                                            <span></span>
                                        </label>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-0">
                            <label class="col-auto col-form-label" for="editArticleDescription">Описание</label>
                        </div>
                        <div class="col-12">
                            <textarea name="description" class="summernote" id="editArticleDescription"></textarea>
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
