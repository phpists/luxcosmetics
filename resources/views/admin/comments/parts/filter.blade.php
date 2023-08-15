<div class="tab-content mt-5" id="myTabContent">
    <input type="hidden" id="filterUrl" data-url="{{ route('admin.comment') }}">
    <form id="comment_form">
        <table class="table table-hover rounded ">
            <div class="row mb-2">
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Статус</label>
                    <div class="input-group">
                        <select class="form-control status" id="position" name="status">
                            <option></option>
                            <option value="Новый">Новый</option>
                            <option value="Опубликовать">Опубликован</option>
                            <option value="Отменить">Отменён</option>
                        </select>
                    </div>
                </div>
            </div>
        </table>
    </form>
</div>


