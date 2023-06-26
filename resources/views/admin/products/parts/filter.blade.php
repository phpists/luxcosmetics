<div class="tab-content mt-5" id="myTabContent">
    <input type="hidden" id="filterUrl" data-url="{{ route('admin.categories') }}">
    <form id="categories_form">
        <table class="table table-hover rounded ">

            <div class="row mb-2">
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Название</label>
                    <div class="input-group">
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Alias</label>
                    <div class="input-group">
                        <input type="text" id="alias" name="alias" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Обновлено</label>
                    <div class="input-group">
                        <input type="text" id="date" name="date" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Статус</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control status" name="status">
                            <option></option>
                            <option value="1">Активный</option>
                            <option value="0">Неактивный</option>
                        </select>
                    </div>
                </div>
            </div>
        </table>
    </form>
</div>


