<!-- Modal -->
<div class="modal fade" id="editProductPriceModal" tabindex="-1" role="dialog" aria-labelledby="editProductPriceModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductPriceModalTitle">Редактировать условие ценника</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="editProductPriceForm" action="{{ route('admin.product-prices.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    @include('admin.product-prices.__form', ['method' => 'edit'])

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
