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
<div class="modal fade" id="createArticleModal" tabindex="-1" role="dialog" aria-labelledby="createTagModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTagTitle">Новая статья</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="record_id" value="{{ $record_id }}">
                <input type="hidden" name="table_name" value="{{ $table_name }}">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="image-input art-image image-input-outline" id="createArticleImage">
                                <div class="image-input-wrapper" id="createArticleImageBackground"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input required type="file" name="image" accept="image/*"/>
                                    <input type="hidden" name="image_remove"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-12 px-0">
                                    <div class="form-group w-100">
                                        <label for="createFaqQuestion" class="col-auto col-form-label font-weight-bold">Заголовок</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="createFaqQuestion" name="title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 px-0">
                                    <div class="form-group w-100">
                                        <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Ссылка</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="createLink" name="link" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-7 px-0">
                                    <div class="form-group w-100">
                                        <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Позиция</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="createFaqPos" name="position" value="{{ $last_position }}" min="1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-0">
                            <label class="col-auto col-form-label" for="createArticleDescription">Описание</label>
                        </div>
                        <div class="col-12">
                            <textarea name="description" class="textEditor" id="createArticleDescription"></textarea>
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
