<div class="row">
    <div class="col-10">
        <div class="form-group w-100">
            <label for="{{ $method }}ProductPriceTitle" class="font-weight-bold">Название</label>
            <input id="{{ $method }}ProductPriceTitle" type="text" name="title" class="form-control" required>
        </div>
    </div>
    <div class="col-2">
        <label for="{{ $method }}ProductPriceIsActive">Активный</label>
        <div>
            <span class="switch">
                <label>
                    <input id="{{ $method }}ProductPriceIsActive" type="checkbox" name="is_active" checked>
                    <span></span>
                </label>
            </span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-12">
        <div class="form-group w-100">
            <label for="{{ $method }}ProductPriceType" class="font-weight-bold">Тип</label>
            <select id="{{ $method }}ProductPriceType" class="form-control selectpicker" name="type" required>
                @foreach(\App\Enums\ProductPriceTypeEnum::cases() as $type)
                    <option value="{{ $type->value }}">{{ $type->getTitle() }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group w-100">
            <label for="{{ $method }}ProductPriceAmount" class="font-weight-bold">Процент/Множитель</label>
            <input id="{{ $method }}ProductPriceAmount" type="text" name="amount" class="form-control" required>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group w-100">
            <label for="{{ $method }}ProductPriceRounding" class="font-weight-bold">Округление</label>
            <input id="{{ $method }}ProductPriceRounding" type="text" name="rounding" class="form-control" value="0">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Дата от/до</label>
            <div class="input-daterange input-group" id="{{ $method }}DateRange">
                <input id="{{ $method }}ProductPriceStartDate" type="text" class="form-control" name="start_date"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                </div>
                <input id="{{ $method }}ProductPriceEndDate" type="text" class="form-control" name="end_date"/>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group w-100">
            <label for="{{ $method }}ProductPriceBrand" class="font-weight-bold">Бренд</label>
            <select id="{{ $method }}ProductPriceBrand" class="form-control select2" name="cases[{{ \App\Models\Brand::class }}][]" multiple
                    data-live-search="true">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group w-100">
            <label for="{{ $method }}ProductPriceCategory" class="font-weight-bold">Категория</label>
            <select id="{{ $method }}ProductPriceCategory" class="form-control select2" name="cases[{{ \App\Models\Category::class }}][]" multiple
                    data-live-search="true">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group w-100">
            <label for="{{ $method }}ProductPriceProduct" class="font-weight-bold">Товар</label>
            <select id="{{ $method }}ProductPriceProduct" class="form-control select2" name="cases[{{ \App\Models\Product::class }}][]" multiple
                    data-live-search="true">
                @foreach($products as $product)
                    <option
                        value="{{ $product->id }}">{{ "[{$product->code}] {$product->brand?->name} > {$product->title}" }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="form-group w-100">
                <label for="{{ $method }}ProductPriceExceptBrand" class="font-weight-bold">Исключить бренд</label>
                <select id="{{ $method }}ProductPriceExceptBrand" class="form-control select2" name="excepts[{{ \App\Models\Brand::class }}][]"
                        multiple>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group w-100">
                <label for="{{ $method }}ProductPriceExceptCategory" class="font-weight-bold">Исключить
                    категорию</label>
                <select id="{{ $method }}ProductPriceExceptCategory" class="form-control select2"
                        name="excepts[{{ \App\Models\Category::class }}][]" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group w-100">
                <label for="{{ $method }}ProductPriceExceptProduct" class="font-weight-bold">Исключить товар</label>
                <select id="{{ $method }}ProductPriceExceptProduct" class="form-control select2" name="excepts[{{ \App\Models\Product::class }}][]"
                        multiple>
                    @foreach($products as $product)
                        <option
                            value="{{ $product->id }}">{{ "[{$product->code}] {$product->brand?->name} > {$product->title}" }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
