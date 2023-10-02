<!-- Modal -->
<div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog" aria-labelledby="createAdminModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAdminModalTitle">Создать Администратора</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="createAdminName"
                                       class="font-weight-bold">Имя</label>
                                    <input type="text" class="form-control" id="createAdminName" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="createAdminSurname"
                                       class="font-weight-bold">Фамилия</label>
                                    <input type="text" class="form-control" id="createAdminSurname" name="surname" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="createAdminEmail"
                                       class="font-weight-bold">Email</label>
                                    <input type="email" class="form-control" id="createAdminEmail" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100">
                                <label for="createAdminPassword"
                                       class="font-weight-bold">Пароль</label>
                                    <input type="password" class="form-control" id="createAdminPassword" name="password" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="createAdminRoles" class="font-weight-bold">Роли</label>
                                <select id="createAdminRoles" class="form-control select2" name="roles[]" multiple>
                                    @foreach($roles as $role)
                                        <option>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mt-lg-2 d-flex">
                            <div class="form-group row my-auto">
                                <div class="col-auto pr-0">
                                    <span class="switch switch-outline switch-icon switch-success">
                                        <label>
                                            <input id="createAdminIsActive" type="checkbox" checked name="is_active"/>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label for="createAdminIsActive" class="col col-form-label">Активен</label>
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
