<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Создать промо код</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.promo_codes.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="form-group w-100">
                                        <label for="createCode" class=font-weight-bold">Код</label>
                                        <input type="text" class="form-control" id="createCode" name="code">
                                        <span class="form-text text-muted">Будет сгенерирован автоматически, если оставить пустым</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="createType" class=font-weight-bold">Тип</label>
                                        <select name="type" id="createType" class="form-control selectpicker">
                                            @foreach(\App\Models\PromoCode::ALL_TYPES as $type_id => $type_title)
                                                <option value="{{ $type_id }}">{{ $type_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12 column">
                                    <div class="form-group w-100">
                                        <label for="createMinSum" class=font-weight-bold">Мин. сумма</label>
                                        <input type="number" class="form-control" id="createMinSum" name="min_sum" min="0">
                                        <span class="form-text text-muted">Неограничено, если оставить пустым</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 column" style="display:none;">
                                    <div class="form-group w-100">
                                        <label for="createCategory" class=font-weight-bold">Категория</label>
                                        <select name="category_ids[]" id="createCategory" class="form-control selectpicker" data-live-search="true" title="Выберите..." multiple>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 column" style="display:none;">
                                    <div class="form-group w-100">
                                        <label for="createProduct" class=font-weight-bold">Товар</label>
                                        <select name="product_ids[]" id="createProduct" class="form-control selectpicker" data-live-search="true" title="Выберите..." multiple>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 column" style="display:none;">
                                    <div class="form-group w-100">
                                        <label for="createBrand" class=font-weight-bold">Бренд</label>
                                        <select name="brand_ids[]" id="createBrand" class="form-control selectpicker" data-live-search="true" title="Выберите..." multiple>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group w-100">
                                        <label for="createAmount" class=font-weight-bold">Сумма скидки</label>
                                        <input type="number" class="form-control" id="createAmount" name="amount" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group w-100">
                                        <label for="createPercent" class=font-weight-bold">Процент скидки</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="createPercent" name="percent" min="0" required>
                                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group w-100">
                                        <label for="createQuantity" class=font-weight-bold">Кол-во</label>
                                        <input type="number" class="form-control" id="createQuantity" min="0" name="quantity">
                                        <span class="form-text text-muted">Неограниченое, если оставить пустым</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="createStarts" class=font-weight-bold">Начало</label>
                                        <input class="form-control" type="date" name="starts_at" id="createStarts" required/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="createEnds" class=font-weight-bold">Конец</label>
                                        <input class="form-control" type="date" name="ends_at" id="createEnds" required/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                    <label for="createCalcOnBase" class=font-weight-bold">Считать от РРЦ</label>
                                    <div>
                                        <span class="switch">
                                            <label>
                                                <input id="createCalcOnBase" type="checkbox" name="calc_on_base">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group w-100">
                                        <label for="createUsesPerUser" class=font-weight-bold">Кол-во использований на 1 пользователя</label>
                                        <input type="number" class="form-control" id="createUsesPerUser" min="1" name="uses_per_user" value="1">
                                        <span class="form-text text-muted">Неограниченое, если оставить пустым</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Создать</button>
                </div>

            </form>

        </div>
    </div>
</div>
