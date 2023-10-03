<div class="tab-content mt-5" id="myTabContent">
    <input type="hidden" id="filterUrl" data-url="{{ route('admin.products') }}">
    <form id="categories_form">
        <table class="table table-hover rounded ">

            <div class="row mb-2">
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Название</label>
                    <div class="input-group">
                        <input type="text" id="name" name="name" @if(request()->name) value="{{request()->name}}" @endif class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Артикул</label>
                    <div class="input-group">
                        <input type="text" id="code" name="code" @if(request()->code) value="{{request()->code}}" @endif class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Артикул 1c</label>
                    <div class="input-group">
                        <input type="text" id="code_1c" name="code_1c" @if(request()->code_1c) value="{{request()->code_1c}}" @endif class="form-control">
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-3">
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Категория</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control status" id="cat_select" name="category_id">
                            @if(request()->category_id)
                                <option value="{{request()->category_id}}">{{\App\Models\Category::query()->find(request()->category_id)?->name}}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Бренд</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control status" id="brand_select" name="brand_id">
                            @if(request()->brand_id)
                                <option value="{{request()->brand_id}}">{{\App\Models\Brand::query()->find(request()->brand_id)?->name}}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 mb-lg-0 d-flex flex-column">
                    <label>Статус</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control status" name="status">
                            <option value>Все</option>
                            <option @if(request()->status === '1') selected @endif value="1">{{\App\Services\SiteService::getProductStatus(1)}}</option>
                            <option @if(request()->status === '2') selected @endif value="2">{{\App\Services\SiteService::getProductStatus(2)}}</option>
                            <option @if(request()->status === '3') selected @endif value="3">{{\App\Services\SiteService::getProductStatus(3)}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </table>
    </form>
</div>


