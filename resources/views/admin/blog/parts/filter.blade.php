<div class="tab-content mt-5" id="myTabContent">
    <input type="hidden" id="filterUrl" data-url="{{ route('admin.blog') }}">
    <form id="blog_form">
        <table class="table table-hover rounded ">
            <div class="row mb-2">
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Название</label>
                    <div class="input-group">
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Создано</label>
                    <div class="input-group">
                        <input type="text" id="created_at" name="created_at" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Статус</label>
                    <div class="input-group">
                        <select class="form-control status" name="status">
                            <option></option>
                            <option value="1">Активный</option>
                            <option value="0">Неактивный</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Дата публикации</label>
                    <div class="input-group">
                        <input type="text" id="published_at" name="published_at" class="form-control">
                    </div>
                </div>
            </div>
        </table>
    </form>
</div>


