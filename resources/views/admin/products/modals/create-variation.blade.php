<div class="modal fade" id="createProductVariationModal" tabindex="-1" role="dialog" aria-labelledby="createProductVariationModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Модификация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.product.variation.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="variationDiscountPrice" class="col-sm-12 col-form-label font-weight-bold">Размер</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="size" id="variationSize" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="variationPrice" class="col-sm-12 col-form-label font-weight-bold">Цена</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="number" step="any" name="price" id="variationPrice" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="variationDiscountPrice" class="col-sm-12 col-form-label font-weight-bold">Скидка</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="number" step="any" name="discount_price" id="variationDiscountPrice">
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
