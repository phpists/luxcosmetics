<div class="modal fade" id="updateFaqModal" tabindex="-1" role="dialog" aria-labelledby="updateFaqModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Обновить тег</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.tag.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" id="updateTagId" name="id">
                <input type="hidden" name="morphable_type" value="{{ $morphable_type }}">
                <input type="hidden" name="morphable_id" value="{{ $morphable_id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="row d-flex justify-content-around">
                                <div class="mb-lg-0 d-flex flex-column" style="width:95%;">
                                    <label>ИЗОБРАЖЕНИЕ</label>
                                    <div class="image-input image-input-outline" id="updateImageTag">
                                        <div class="image-input-wrapper" id="imageWindow"
                                             style="width: 100px; height: 100px;  background-image: url()"></div>
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

                    <div class="row">
                        <div class="col">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="createSeller" class="col-sm-12 col-form-label font-weight-bold">Область отображения</label>
                                    <div class="col-sm-12">
                                        <select class="form-control status" name="add_to_top" id="addToTop">
                                            <option value="1">Вверху</option>
                                            <option value="0">Снизу</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="createSeller" class="col-sm-12 col-form-label font-weight-bold">Название</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="name" id="updateName" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="createSeller"
                                           class="col-sm-12 col-form-label font-weight-bold">Ссылка</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="link" id="updateLink" required>
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
