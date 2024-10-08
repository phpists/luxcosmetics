<div class="modal fade" id="createPropertyModal" tabindex="-1" role="dialog" aria-labelledby="createPropertyModal"
     aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPropertyModalTitle">Добавить характеристику</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="createPropertyForm" action="{{ route('admin.promotion.properties.store', $promotion) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group w-100">
                        <label for="createPropertyTitle" class="font-weight-bold">Название</label>
                        <select id="createPropertyTitle" class="form-control select2" name="title" required>
                            <option selected disabled></option>
                            @foreach($propertyTitles as $title)
                                <option value="{{ $title }}">{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group w-100">
                        <label for="createPropertyValue" class="font-weight-bold">Значение</label>
                        <select id="createPropertyValue" class="form-control select2" name="value" required>
                            <option selected disabled></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn btn-light-primary font-weight-bold" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn btn-primary mr-2">Добавить</button>
                </div>
            </form>

        </div>
    </div>
</div>
