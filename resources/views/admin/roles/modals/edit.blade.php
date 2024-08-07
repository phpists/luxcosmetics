<!-- Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalTitle">Редактировать роль</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="editRoleForm" action="{{ route('admin.roles.update', 0)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group w-100">
                                <label for="editRoleName" class="col-auto col-form-label font-weight-bold">Название</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="editRoleName" name="name" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="form-group w-100">
                                <label class="col-auto col-form-label font-weight-bold">Доступ</label>
                                <div class="row">
                                    @foreach($permissions as $category_title => $category_permissions)
                                        @php($lloop = $loop)
                                        <div class="col-4 border">
                                            <p class="h4 mb-2 mt-3">{{ $category_title }}</p>
                                            @foreach($category_permissions as $permission_name => $permission_title)
                                                <div class="form-group row mb-0">
                                                    <div class="col-auto pt-1">
                                                        <span class="switch switch-outline switch-icon switch-success switch-sm">
                                                            <label>
                                                                <input id="permission{{ $lloop->index . $loop->index }}" type="checkbox" name="permissions[]" value="{{ $permission_name }}"/>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <label for="permission{{ $lloop->index . $loop->index }}" class="col col-form-label pl-0">{{ $permission_title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
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
