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
<div class="modal fade" id="createCategoryPostModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryPostModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCatBannerTitle">Новый рекламный баннер<strong>( 303x196px )</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="form1" action="{{ route('admin.category_post.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                        <div class="row justify-content-start">
                            <div class="form-group col">
                                <div class="col-auto ml-2">
                                    <div class="image-input image-input-outline" id="createCatPostImagePlugin">
                                        <div class="image-input-wrapper" id="updateImageBackground"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image_path" accept="image/*"/>
                                            <input type="hidden" name="image_remove"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleSelect2">Название</label>
                                    <input type="text" name="title" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleSelect2">Ссылка</label>
                                    <input type="text" name="link" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Статус</label>
                                    <select class="form-control status" name="is_active">
                                        <option value="1">Активный</option>
                                        <option value="0">Неактивный</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Текст</label>
                                <div style="max-height: 400px; overflow-y: auto;">
                                    <textarea id="categoryPostContent" name="content"></textarea>
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
