<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Редактировать подарочную карту</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.brands.update', 0)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group w-100">
                                <label for="editColor" class="col-auto col-form-label font-weight-bold">Цвет</label>
                                <div class="col-sm-12">
                                    <select name="color" id="editColor" class="form-control" disabled>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->color_card }}">{{ $color->color_card }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group w-100">
                                <label for="editSum" class="col-auto col-form-label font-weight-bold">Сумма</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="editSum" name="sum" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group w-100">
                                <label for="editFrom" class="col-auto col-form-label font-weight-bold">От кого</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editFrom" name="from_whom" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="editReceiver" class="col-auto col-form-label font-weight-bold">Имя получателя</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editReceiver" name="receiver" required disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="editReceiverEmail" class="col-auto col-form-label font-weight-bold">Email получателя</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" id="editReceiverEmail" name="receiver_email" required disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label for="editDescription" class="col-auto col-form-label font-weight-bold">Доп. текст</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="editDescription" name="description" rows="5" disabled></textarea>
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
