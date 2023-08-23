<!-- Modal -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalTitle">Подарочная карта</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group w-100">
                                <label for="showCode" class=font-weight-bold">Код</label>
                                <input type="text" class="form-control" id="showCode" name="code" disabled>
                                <span class="form-text text-muted">Будет сгенерирован автоматически, если оставить пустым</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group w-100">
                                <label for="showType" class=font-weight-bold">Тип</label>
                                <select name="type" id="showType" class="form-control" disabled>
                                    @foreach(\App\Models\PromoCode::ALL_TYPES as $type_id => $type_title)
                                        <option value="{{ $type_id }}">{{ $type_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 column" style="display:none;">
                            <div class="form-group w-100">
                                <label for="showCategory" class=font-weight-bold">Категория</label>
                                <select name="category_id" id="showCategory" class="form-control" data-live-search="true" title="Выберите..." disabled>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 column" style="display:none;">
                            <div class="form-group w-100">
                                <label for="showProduct" class=font-weight-bold">Товар</label>
                                <select name="product_id" id="showProduct" class="form-control" data-live-search="true" title="Выберите..." disabled>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group w-100">
                                <label for="showAmount" class=font-weight-bold">Сумма</label>
                                <input type="number" class="form-control" id="showAmount" name="amount" min="0" disabled>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group w-100">
                                <label for="showPercent" class=font-weight-bold">Процент</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="showPercent" name="percent" min="0" disabled>
                                    <div class="input-group-append"><span class="input-group-text">%</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group w-100">
                                <label for="showQuantity" class=font-weight-bold">Кол-во</label>
                                <input type="number" class="form-control" id="showQuantity" min="0" name="quantity" disabled>
                                <span class="form-text text-muted">Неограниченое, если оставить пустым</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group w-100">
                                <label for="showStarts" class=font-weight-bold">Начало</label>
                                <input class="form-control" type="date" name="starts_at" id="showStarts" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group w-100">
                                <label for="showEnds" class=font-weight-bold">Конец</label>
                                <input class="form-control" type="date" name="ends_at" id="showEnds" disabled>
                            </div>
                        </div>
                    </div>

                        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                </div>

        </div>
    </div>
</div>
