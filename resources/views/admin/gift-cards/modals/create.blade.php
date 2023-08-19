<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Создать подарочную карту</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.gift_cards.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="createColor" class="col-auto col-form-label font-weight-bold">Цвет</label>
                                        <div class="col-sm-12">
                                            <select name="color" id="createColor" class="form-control selectpicker">
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->color_card }}" style="background-color: {{ $color->color_card }}">{{ $color->color_card }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="createSum" class="col-auto col-form-label font-weight-bold">Сумма</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="createSum" name="sum" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group w-100">
                                        <label for="createFrom" class="col-auto col-form-label font-weight-bold">От кого</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="createFrom" name="from_whom">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group w-100">
                                        <label for="createReceiver" class="col-auto col-form-label font-weight-bold">Имя получателя</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="createReceiver" name="receiver" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group w-100">
                                        <label for="createReceiverEmail" class="col-auto col-form-label font-weight-bold">Email получателя</label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" id="createReceiverEmail" name="receiver_email" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group w-100">
                                        <label for="createDescription" class="col-auto col-form-label font-weight-bold">Доп. текст</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="createDescription" name="description" rows="5"></textarea>
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
