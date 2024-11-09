<div class="modal fade" id="createPromotionProductModal" tabindex="-1" role="dialog" aria-labelledby="createPromotionProductModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPromotionProductModalTitle">Добавить товар</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="createPromotionProductForm" action="{{ route('admin.promotion.products.store', $promotion) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group w-100">
                        <label for="createPromotionProductId" class="font-weight-bold">Товар</label>
                        <select id="createPromotionProductId" class="form-control select2" name="product_id">
                            @foreach($allProducts as $product)
                                <option value="{{ $product->id }}">{{ "[{$product->code}] {$product->brand?->name} > {$product->title}" }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn btn-light-primary font-weight-bold" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn btn-primary mr-2">Добавить</button>
                </div>
            </form>

        </div>
    </div>
</div>
