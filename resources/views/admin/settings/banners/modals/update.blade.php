<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalTitle">Редактировать банер</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.settings.banner.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" id="updateId" name="id">
                <div class="modal-body">

                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="updateName"
                                       class="col-auto col-form-label font-weight-bold">Название</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateName" name="name" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="updateTitle"
                                       class="col-auto col-form-label font-weight-bold">Заголовок</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateTitle" name="title" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="updateTitle"
                                       class="col-auto col-form-label font-weight-bold">Подзаголовок</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateSubTitle" name="sub_title">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="updateLink"
                                       class="col-auto col-form-label font-weight-bold">Ссылка</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="updateLink" name="link" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label class="col-auto col-form-label font-weight-bold">Категории</label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" id="updateBannerCategories"
                                            name="categories[]" multiple="multiple" style="width: 100%">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <div class="form-group row mb-0">
                                <label class="col-auto col-form-label" for="updateStatus">Статус</label>
                                <div class="col-3">
                                    <span class="switch">
                                        <label>
                                            <input id="updateStatus" checked type="checkbox" name="status"/>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row mb-0">
                                <label for="updateColor" class="col-2 col-form-label">Цвет</label>
                                <div class="col-10">
                                    <input class="form-control" type="color" name="color" value="#563d7c"
                                           id="updateColor"/>
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
