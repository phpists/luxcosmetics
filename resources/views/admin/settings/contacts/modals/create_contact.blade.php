<!-- Modal -->
<div class="modal fade" id="createContact" tabindex="-1" role="dialog" aria-labelledby="createContactTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createContactTitle">Додати новий запис</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.settings.contact.store') }}" method="POST">
                @csrf

                <input type="hidden" name="group_id" id="createContactGroupId">
                <div class="modal-body">

                    <div class="row row-cols-1 row-cols-md-2 d-flex justify-content-around">
                        <div class="col px-0 d-none">
                            <div class="form-group w-100">
                                <label for="createContactDepartmentId" class="col-auto col-form-label font-weight-bold">Відділ</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="createContactDepartmentId" name="department_id">
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="createContactTypeId" class="col-auto col-form-label font-weight-bold">Тип</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="createContactTypeId" name="type_id">
                                        @foreach(\App\Models\Contact::ALL_TYPES as $type_id => $type_title)
                                            <option value="{{ $type_id }}">{{ $type_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col px-0 d-none">
                            <div class="form-group w-100">
                                <label for="createContactTypeTitle" class="col-auto col-form-label font-weight-bold">Назва</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createContactTypeTitle" name="type_title">
                                </div>
                            </div>
                        </div>
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="createContactValue" class="col-auto col-form-label font-weight-bold">Значення</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createContactValue" name="value" required>
                                </div>
                            </div>
                        </div>
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="departureCreateInfo" class="col-auto col-form-label font-weight-bold">Дод.інформація</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="departureCreateInfo" name="info">
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                        Закрити
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary mr-2">Зберегти</button>
                </div>

            </form>

        </div>
    </div>
</div>
