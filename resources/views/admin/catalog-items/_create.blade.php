<!-- Modal -->
<div class="modal fade" id="createCatalogItemModal" tabindex="-1" role="dialog" aria-labelledby="createCatalogItemModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCatalogItemModalTitle">Добавить элемент</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="createCatalogItemForm" action="{{ route('admin.catalog-items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    @include('admin.catalog-items.__form', ['method' => 'create'])

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
