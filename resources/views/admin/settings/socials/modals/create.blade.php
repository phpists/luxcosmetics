<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Добавить соц.сеть</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.settings.social.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input id="createTypeId" type="hidden" name="type_id">
                <input id="createPos" type="hidden" name="pos">

                <div class="modal-body">

                    <div class="row">
                        <div class="col-auto ml-2">
                            <div class="image-input  image-input-outline" id="createImagePlugin" style="max-height: 150px;">
                                <div class="image-input-wrapper" id="createImageBackground"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input required type="file" name="icon" accept="image/*"/>
                                    <input type="hidden" name="image_remove"/>
                                </label>
                            </div>
                        </div>

                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="createLink" class="col-auto col-form-label font-weight-bold">Ссылка</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createLink" name="link" required>
                                </div>
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
