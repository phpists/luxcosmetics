<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Создать курьерскую доставку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.courier-delivery-methods.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editTitle" class=font-weight-bold">Название</label>
                                <input type="text" class="form-control" id="editTitle" name="title" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editDeliveryMethodId" class=font-weight-bold">Служба</label>
                                <select name="delivery_method_id" id="editDeliveryMethodId" class="form-control selectpicker delivery-method" required>
                                    @foreach($deliveryMethods as $deliveryMethod)
                                        <option value="{{ $deliveryMethod->id }}" data-prefix="{{ $deliveryMethod->name }}">{{ $deliveryMethod->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editCountries" class=font-weight-bold">Страны</label>
                                <select name="countries[]" id="editCountries" class="form-control select2-tags" multiple required>
                                    <option selected>Россия</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editStates" class=font-weight-bold">Области</label>
                                <select name="states[]" id="editStates" class="form-control select2-states" multiple>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editCities" class=font-weight-bold">Города</label>
                                <select name="cities[]" id="editCities" class="form-control select2-cities" multiple>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editPrefix" class=font-weight-bold">Значение при передаче в 1С</label>
                                <div class="input-group">
                                    <input id="editPrefix" type="text" class="form-control" placeholder="cdek_courier" name="prefix"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Создать</button>
                </div>

            </form>

        </div>
    </div>
</div>
