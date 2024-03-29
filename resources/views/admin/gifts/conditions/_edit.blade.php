<!-- Modal -->
<div class="modal fade" id="editGiftConditionModal" tabindex="-1" role="dialog" aria-labelledby="editGiftConditionModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGiftConditionModalTitle">Редактировать условие подарка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="editGiftConditionForm" action="{{ route('admin.gift_conditions.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editGiftConditionTitle" class="font-weight-bold">Название</label>
                                <input id="editGiftConditionTitle" type="text" name="title" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="editGiftConditionType" class="font-weight-bold">Тип</label>
                                <select id="editGiftConditionType" class="form-control selectpicker" name="type" required>
                                    @foreach(\App\Models\GiftCondition::ALL_TYPES as $type_id => $type_title)
                                        <option value="{{ $type_id }}">{{ $type_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="editGiftConditionMinSum" class="font-weight-bold">Сумма</label>
                                <div class="row row-cols-1 row-cols-md-2">
                                    <div class="col pr-0">
                                        <input id="editGiftConditionMinSum" type="number" name="min_sum" min="0" placeholder="от" class="form-control rounded-right-0">
                                    </div>
                                    <div class="col pl-0">
                                        <input id="editGiftConditionMaxSum" type="number" name="max_sum" min="0" class="form-control rounded-left-0" placeholder="до">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 hidable" style="display: none;">
                            <div class="form-group w-100">
                                <label for="editGiftConditionBrand" class="font-weight-bold">Бренд</label>
                                <select id="editGiftConditionBrand" class="form-control select2 hidable-brand" name="cases[]" multiple data-live-search="true">
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 hidable" style="display: none;">
                            <div class="form-group w-100">
                                <label for="editGiftConditionCategory" class="font-weight-bold">Категория</label>
                                <select id="editGiftConditionCategory" class="form-control select2 hidable-category" name="cases[]" multiple data-live-search="true">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 hidable" style="display: none;">
                            <div class="form-group w-100">
                                <label for="editGiftConditionProduct" class="font-weight-bold">Товар</label>
                                <select id="editGiftConditionProduct" class="form-control select2 hidable-product" name="cases[]" multiple data-live-search="true">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ "[{$product->code}] {$product->brand?->name} > {$product->title}" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editGiftConditionProducts" class="font-weight-bold">Подарочные товары</label>
                                <select id="editGiftConditionProducts" class="form-control select2" name="products[]" multiple data-live-search="true" required>
                                    @foreach($all_gift_products as $gift_product)
                                        <option value="{{ $gift_product->id }}">[{{ $gift_product->article }}]{{ $gift_product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="sum-exceptions">
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group w-100">
                                    <label for="editGiftConditionSumExceptCategory" class="font-weight-bold">Исключить категорию</label>
                                    <select id="editGiftConditionSumExceptCategory" class="form-control select2" name="except_categories[]" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group w-100">
                                    <label for="editGiftConditionSumExceptBrand" class="font-weight-bold">Исключить бренд</label>
                                    <select id="editGiftConditionSumExceptBrand" class="form-control select2" name="except_brands[]" multiple>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="brand-exceptions" style="display: none;">
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group w-100">
                                    <label for="editGiftConditionBrandExceptCategory" class="font-weight-bold">Исключить категорию</label>
                                    <select id="editGiftConditionBrandExceptCategory" class="form-control select2" name="except_categories[]" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group w-100">
                                    <label for="editGiftConditionBrandExceptProduct" class="font-weight-bold">Исключить товар</label>
                                    <select id="editGiftConditionBrandExceptProduct" class="form-control select2" name="except_products[]" multiple>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ "[{$product->code}] {$product->brand?->name} > {$product->title}" }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="category-exceptions" style="display: none;">
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group w-100">
                                    <label for="editGiftConditionCategoryExceptCategory" class="font-weight-bold">Исключить категорию</label>
                                    <select id="editGiftConditionCategoryExceptCategory" class="form-control select2" name="except_categories[]" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group w-100">
                                    <label for="editGiftConditionCategoryExceptBrand" class="font-weight-bold">Исключить бренд</label>
                                    <select id="editGiftConditionCategoryExceptBrand" class="form-control select2" name="except_brands[]" multiple>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
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
