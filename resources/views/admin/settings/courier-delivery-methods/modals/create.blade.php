<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Создать курьерскую доставку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.courier-delivery-methods.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="createTitle" class=font-weight-bold">Название</label>
                                        <input type="text" class="form-control" id="createTitle" name="title" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="createDeliveryMethodId" class=font-weight-bold">Служба</label>
                                        <select name="delivery_method_id" id="createDeliveryMethodId" class="form-control selectpicker delivery-method" required>
                                            @foreach($deliveryMethods as $deliveryMethod)
                                                <option value="{{ $deliveryMethod->id }}" data-prefix="{{ $deliveryMethod->name }}">{{ $deliveryMethod->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="createCountries" class=font-weight-bold">Страны</label>
                                        <select name="countries[]" id="createCountries" class="form-control select2-tags" multiple required>
                                            <option selected>Россия</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="createStates" class=font-weight-bold">Области</label>
                                        <select name="states[]" id="createStates" class="form-control select2-states" multiple>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="createCities" class=font-weight-bold">Города</label>
                                        <select name="cities[]" id="createCities" class="form-control select2-cities" multiple>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="createPrefix" class=font-weight-bold">Значение при передаче в 1С</label>
                                        <input id="createPrefix" type="text" class="form-control" placeholder="cdek_courier" name="prefix"/>
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
