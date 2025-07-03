<!-- Modal -->
<div class="modal fade" id="createMainSliderModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Добавить</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.main-slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="tab-content" id="createTabContent">
                        <div class="tab-pane fade show active" id="general_tab" role="tabpanel">
                            <div class="row">
                                <div class="col-auto ml-2">
                                    <div class="image-input  image-input-outline" id="createMainSliderImagePlugin"
                                         style="max-height: 150px;">
                                        <div class="image-input-wrapper" id="createImageBackground"></div>

                                        <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image" accept="image/*" required/>
                                            <input type="hidden" name="image_remove"/>
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group w-100">
                                        <label for="createTitle" class="col-auto col-form-label font-weight-bold">Название</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="createTitle" name="title" required>
                                        </div>
                                        <label for="createTitle" class="col-auto col-form-label font-weight-bold">Краткое описание</label>
                                        <div class="col-sm-12">
                                            <textarea name="description" class="form-control" rows="10"></textarea>
                                        </div>
                                        <label for="createTitle" class="col-auto col-form-label font-weight-bold">Надпись кнопки</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="createTitle" name="btn_title">
                                        </div>
                                        <label for="createTitle" class="col-auto col-form-label font-weight-bold">Ссылка</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="createTitle" name="link">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-lg btn-success mr-2">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
