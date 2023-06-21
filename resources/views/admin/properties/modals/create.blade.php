<!-- Modal -->
<div class="modal fade" id="createFaqModal" tabindex="-1" role="dialog" aria-labelledby="createFaqTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFaqTitle">Добавить характеристику</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
            </div>

            <form action="{{ route('admin.properties.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <div class="row">
                        <div class="col col-md-6 px-0">
                            <div class="form-group w-100">
                                <label for="createFaqQuestion" class="col-auto col-form-label font-weight-bold">Название</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createProprtyName" name="name" required>
                                </div>
                            </div>
                        </div>

                        <div class="col col-md-2 px-0">
                            <div class="form-group w-100">
                                <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Ед. измерения</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createFaqPos" name="measure" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Категорії</label>
                                <select class="form-control select2" id="kt_select2_4"
                                        name="category_id[]" required multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="add_to_top_menu">Добавить к фильтру</label>
                                <div class="checkbox-list">
                                    <label class="checkbox">
                                        <input type="checkbox" name="show_in_filter" id="show_in_filter">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="add_to_top_menu">Добавить к каталогу</label>
                                <div class="checkbox-list">
                                    <label class="checkbox">
                                        <input type="checkbox" name="show_in_product" id="show_in_product">
                                        <span></span>
                                    </label>
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
