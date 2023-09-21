<div class="tab-content mt-5" id="myTabContent">
    <input type="hidden" id="filterUrl" data-url="{{ route('admin.products') }}">
    <form id="categories_form">
        <table class="table table-hover rounded ">

            <div class="row mb-2">
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Название</label>
                    <div class="input-group">
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Артикул</label>
                    <div class="input-group">
                        <input type="text" id="code" name="code" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Артикул 1c</label>
                    <div class="input-group">
                        <input type="text" id="code_1c" name="code_1c" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-3">
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Категория</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control status" id="cat_select" name="category_id">
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Бренд</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control status" id="brand_select" name="brand_id">
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Статус</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control status" name="status">
                            <option value>Все</option>
                            <option value="1">Есть в наличии</option>
                            <option value="0">Нету в наличии</option>
                        </select>
                    </div>
                </div>
            </div>
        </table>
    </form>
</div>


