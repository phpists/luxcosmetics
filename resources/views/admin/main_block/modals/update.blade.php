<!-- Modal -->
<div class="modal fade" id="updateBlockModal" tabindex="-1" role="dialog" aria-labelledby="updateFaqTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Редактировать блок</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.main-block.update') }}" enctype="multipart/form-data" method="POST">
                @csrf

                <input type="hidden" id="updateBlockId" name="id">

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Изображение</label>
                                <div class="col-auto px-0">
                                    <div class="image-input  image-input-outline" id="updateImagePlugin"
                                         style="max-height: 700px;">
                                        <div class="image-input-wrapper" id="updateImageBackground"></div>
                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip"
                                            data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image_path" accept="image/*"/>
                                            <input type="hidden" name="image_remove"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="updateFaqQuestion" class="col-form-label font-weight-bold">Заголовок</label>
                                <input type="text" class="form-control" id="updateBlockTitle" name="title" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="updateBlockVideo" class="col-form-label font-weight-bold">Видео</label>
                                    <input type="file" name="video_path" class="form-control" id="updateBlockVideo"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-0">
                            <label class="col-auto col-form-label" for="updateBlockContent">Текст</label>
                        </div>
                        <div class="col-12">
                            <textarea name="content" class="summernote" id="updateBlockContent"></textarea>
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
