<!-- Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="createFaqTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Добавить товар</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="orderAddProductForm" action="{{ route('admin.order_products.add') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col col-md-9 px-0">
                            <div class="form-group w-100">
                                <label for="createFaqQuestion" class="col-auto col-form-label font-weight-bold">Товар</label>
                                <select class="form-control select2" name="id">
                                    @foreach(\App\Models\Product::all() as $product)
                                        <option value="{{ $product->id }}">{{ $product->brand->name . ' > ' . $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col col-md-3 px-0">
                            <div class="form-group w-100">
                                <label for="createFaqQuestion" class="col-auto col-form-label font-weight-bold">Кол-во</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" min="1" name="quantity" required>
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
