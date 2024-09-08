<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalTitle">Создать баннер для каталога</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form action="{{ route('admin.catalog-banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group w-100">
                                <label for="createType" class=font-weight-bold">Тип</label>
                                <select name="type" id="createType" class="form-control selectpicker" required>
                                    <option value=""></option>
                                    @foreach(\App\Enums\CatalogBannerTypeEnum::cases() as $case)
                                        <option value="{{ $case->value }}" data-load-url="{{ route('admin.catalog-banners.load-type', ['type' => $case->value]) }}">{{ $case->getTitle() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="form-group w-100">
                                <label for="createTitle" class=font-weight-bold">Название</label>
                                <input type="text" class="form-control" id="createTitle" name="title" required>
                                <span class="form-text text-muted">Используется только в админке</span>
                            </div>
                        </div>
                    </div>

                    <div class="row type-container"></div>

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
