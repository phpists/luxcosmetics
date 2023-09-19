<!-- Modal -->
<div class="modal fade" id="editGiftProductModal" tabindex="-1" role="dialog" aria-labelledby="editGiftProductModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGiftProductModalTitle">Редактировать подарочный товар</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="editGiftProductForm" action="{{ route('admin.gift_products.edit', 0) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row mb-4">
                        <div class="col text-center">
                            <div class="image-input  image-input-outline" id="editGiftProductImg">
                                <div class="image-input-wrapper" id="editGiftProductImgBackground"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="img" accept="image/*"/>
                                    <input type="hidden" name="image_remove"/>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group w-100">
                                <label for="editGiftProductTitle" class="font-weight-bold">Название</label>
                                    <input type="text" class="form-control" id="editGiftProductTitle" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group w-100">
                                <label for="editGiftProductIsAvailable" class="font-weight-bold">В наличии</label>
                                <span class="switch switch-success">
                                    <label>
                                        <input type="checkbox" checked="checked" id="editGiftProductIsAvailable" name="is_available">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="editGiftProductBrandId" class="font-weight-bold">Бренд</label>
                                <select id="editGiftProductBrandId" class="form-control selectpicker" name="brand_id" required>
                                    @foreach(\App\Models\Brand::all() as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="editGiftProductArticle" class="font-weight-bold">Артикул</label>
                                <input type="text" class="form-control" id="editGiftProductArticle" name="article" required>
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
