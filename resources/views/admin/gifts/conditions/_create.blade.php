<!-- Modal -->
<div class="modal fade" id="createGiftProductModal" tabindex="-1" role="dialog" aria-labelledby="createGiftProductModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGiftProductModalTitle">Добавить условие подарка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.gift_products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="row mb-4">
                        <div class="col text-center">
                            <div class="image-input  image-input-outline" id="createGiftProductImg">
                                <div class="image-input-wrapper" id="createImageBackground"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input required type="file" name="img" accept="image/*"/>
                                    <input type="hidden" name="image_remove"/>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group w-100">
                                <label for="createGiftProductTitle" class="font-weight-bold">Название</label>
                                    <input type="text" class="form-control" id="createGiftProductTitle" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group w-100">
                                <label for="createGiftProductIsAvailable" class="font-weight-bold">В наличии</label>
                                <span class="switch switch-success">
                                    <label>
                                        <input type="checkbox" checked="checked" id="createGiftProductIsAvailable" name="is_available">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="createGiftProductBrandId" class="font-weight-bold">Бренд</label>
                                <select id="createGiftProductBrandId" class="form-control selectpicker" name="brand_id" required>
                                    @foreach(\App\Models\Brand::all() as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="createGiftProductArticle" class="font-weight-bold">Артикул</label>
                                <input type="text" class="form-control" id="createGiftProductArticle" name="article">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Добавить</button>
                </div>

            </form>

        </div>
    </div>
</div>
