<div class="row">
    <div class="col-5">
        <div class="form-group w-100 filepond-container">
            <label for="{{ $method }}CatalogItemImg" class=font-weight-bold">Изображение</label>
            <input id="{{ $method }}CatalogItemImg" name="img" type="file" required>
        </div>
    </div>
    <div class="col-7">
        <div class="form-group w-100">
            <label for="{{ $method }}CatalogItemTitle" class="font-weight-bold">Название</label>
            <input id="{{ $method }}CatalogItemTitle" type="text" name="title" class="form-control" required>
        </div>
        <label for="{{ $method }}CatalogItemIsActive">Активный</label>
        <div>
            <span class="switch">
                <label>
                    <input id="{{ $method }}CatalogItemIsActive" type="checkbox" name="is_active" checked>
                    <span></span>
                </label>
            </span>
        </div>
    </div>
</div>

<div id="{{ $method }}CatalogItemLinks" class="catalogItemLinks">
    <label>Ссілки:</label>
    <div class="form-group">
        <div data-repeater-list="links">
            <div data-repeater-item class="form-group row mb-2">
                <div class="col-5">
                    <div class="w-100">
                        <label class="font-weight-bold">Название</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                </div>
                <div class="col-5">
                    <div class="w-100">
                        <label class="font-weight-bold">Ссылка</label>
                        <input type="text" name="link" class="form-control" required>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-end">
                    <a href="javascript:;" data-repeater-delete=""
                       class="btn btn-sm font-weight-bolder btn-light-danger"><i class="la la-trash-o pr-0"></i></a>
                </div>
            </div>
        </div>
        <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
            <i class="la la-plus"></i>Добавить
        </a>
    </div>
</div>
