<!-- Modal -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalTitle">Подарочная карта</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

                <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="showColor" class="col-auto col-form-label font-weight-bold">Цвет</label>
                                        <div class="col-sm-12">
                                            <select id="showColor" class="form-control selectpicker" disabled>
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->color_card }}" style="background-color: {{ $color->color_card }}; color: white">{{ $color->color_card }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="showSum" class="col-auto col-form-label font-weight-bold">Сумма</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="showSum" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="showBalance" class="col-auto col-form-label font-weight-bold">Баланс</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="showBalance" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="showFrom" class="col-auto col-form-label font-weight-bold">От кого</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="showFrom" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="showReceiver" class="col-auto col-form-label font-weight-bold">Имя получателя</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="showReceiver" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="showReceiverEmail" class="col-auto col-form-label font-weight-bold">Email получателя</label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" id="showReceiverEmail" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="showDescription" class="col-auto col-form-label font-weight-bold">Доп. текст</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="showDescription" rows="5" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="showCode" class="col-auto col-form-label font-weight-bold">Код активации</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="showCode" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group w-100">
                                        <label for="showActivated" class="col-auto col-form-label font-weight-bold">Активирована</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="showActivated" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group w-100">
                                        <label for="showActivatedBy" class="col-auto col-form-label font-weight-bold">Пользователем</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="showActivatedBy" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрыть
                    </button>
                </div>

        </div>
    </div>
</div>
