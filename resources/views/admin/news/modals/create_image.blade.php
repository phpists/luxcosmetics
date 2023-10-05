<div class="modal fade" id="createNewsImageModal" tabindex="-1" role="dialog" aria-labelledby="createNewsImageModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createNewsImageTitle">Новое Изображение</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.news.image.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="news_item_id" value="{{ $item->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="row d-flex justify-content-around">
                                <div class="mb-lg-0 d-flex flex-column" style="width:95%;">
                                    <label>Изображение</label>
                                    <div class="image-input image-input-outline" id="newsImageContainer">
                                        <div class="image-input-wrapper"
                                             style="width:100%; height: 200px"></div>
                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image_path"
                                                   accept=".png, .jpg, .jpeg"/>
                                            <input type="hidden" name="profile_avatar_remove"/>
                                        </label>
                                        <span
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="cancel" data-toggle="tooltip"
                                            title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
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
