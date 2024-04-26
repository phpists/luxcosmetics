<div class="modal fade" id="editDeliveryMethodModal" tabindex="-1" role="dialog" aria-labelledby="editDeliveryMethodModal" data-focus="false"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Редактировать способ доставки</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row d-flex justify-content-around">
                                <div class="form-group w-100">
                                    <label for="editDeliveryMethodShippingMethod"
                                           class="col-sm-12 col-form-label font-weight-bold">shipping_method</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="shipping_method" class="form-control" id="editDeliveryMethodShippingMethod">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-light-primary font-weight-bold"
                                data-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="submit" class="btn btn-lg btn-primary mr-2">Сохранить</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
