<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalTitle">Редагувати соц.медіа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.settings.social.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input id="updateId" type="hidden" name="id">

                <div class="modal-body">

                    <div class="row">
                        <div class="col-auto ml-2">
                            <div class="image-input  image-input-outline" id="updateImagePlugin" style="max-height: 150px;">
                                <div class="image-input-wrapper" id="updateImageBackground"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="icon" accept="image/*"/>
                                    <input type="hidden" name="image_remove"/>
                                </label>
                            </div>
                        </div>

                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="updateLink" class="col-auto col-form-label font-weight-bold">Посилання</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateLink" name="link" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <div class="form-group row mb-0">
                                <label class="col-auto col-form-label" for="updateIsActiveInContacts">Сторінка "Контакти"</label>
                                <div class="col-3">
                                    <span class="switch">
                                        <label>
                                            <input id="updateIsActiveInContacts" checked type="checkbox" name="is_active_in_contacts"/>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row mb-0">
                                <label class="col-auto col-form-label" for="updateIsActiveInFooter">Активна в футері</label>
                                <div class="col-3">
                                    <span class="switch">
                                        <label>
                                            <input id="updateIsActiveInFooter" checked type="checkbox" name="is_active_in_footer"/>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрити
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Зберегти</button>
                </div>

            </form>

        </div>
    </div>
</div>
