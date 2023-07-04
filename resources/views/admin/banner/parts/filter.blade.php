<div class="tab-content mt-5" id="myTabContent">
    <input type="hidden" id="filterUrl" data-url="{{ route('admin.banner') }}">
    <form id="banner_form">
        <table class="table table-hover rounded ">
            <div class="row mb-2">
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Позиции</label>
                    <div class="input-group">
                        <select class="form-control status" id="position" name="position">
                            <option></option>
                            <option value="first">Первая</option>
                            <option value="second">Вторая</option>
                            <option value="third">Третяя</option>
                            <option value="fourth">Четвертая</option>
                            <option value="fifth">Пятая</option>
                        </select>
                    </div>
                </div>
            </div>
        </table>
    </form>
</div>


