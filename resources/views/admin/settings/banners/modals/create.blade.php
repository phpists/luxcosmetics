<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Додати банер</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.settings.banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="createName"
                                       class="col-auto col-form-label font-weight-bold">Назва</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createName" name="name" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="createTitle"
                                       class="col-auto col-form-label font-weight-bold">Заголовок</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createTitle" name="title" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="updateTitle"
                                       class="col-auto col-form-label font-weight-bold">Підзаголовок</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createSubTitle" name="sub_title">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label for="createLink"
                                       class="col-auto col-form-label font-weight-bold">Посилання</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="createLink" name="link" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col px-0">
                            <div class="form-group w-100">
                                <label class="col-auto col-form-label font-weight-bold">Категорії</label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" id="kt_select2_3"
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
                                <label class="col-auto col-form-label" for="createIsActiveInFooter">Статус</label>
                                <div class="col-3">
                                    <span class="switch">
                                        <label>
                                            <input id="createIsActiveInFooter" checked type="checkbox" name="status"/>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row mb-0">
                                <label for="example-color-input" class="col-2 col-form-label">Колір</label>
                                <div class="col-10">
                                    <input class="form-control" type="color" name="color" value="#563d7c"
                                           id="example-color-input"/>
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
