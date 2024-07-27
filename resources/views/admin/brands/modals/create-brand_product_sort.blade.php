<div class="modal fade" id="createBrandProductSortModal" tabindex="-1" role="dialog" aria-labelledby="createBrandProductSortModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBrandProductSortModalTitle">Добавить товар в сортировку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.category-product-sorts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="model_type" value="{{ $brand::class }}">
                <input type="hidden" name="model_id" value="{{ $brand->id }}">
                <div class="modal-body">

                    <div class="form-group w-100">
                        <label for="createBrandProductSortProductId" class="font-weight-bold">Товар</label>
                        <select id="createBrandProductSortProductId" class="form-control select2" name="product_id">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ "[{$product->code}] {$product->brand?->name} > {$product->title}" }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                </div>
            </form>

        </div>
    </div>
</div>
