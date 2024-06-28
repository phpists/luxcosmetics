<!-- Modal -->
<div class="modal fade" id="createProductPriceModal" tabindex="-1" role="dialog" aria-labelledby="createProductPriceModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductPriceModalTitle">Создать условие ценника</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <form id="createProductPriceForm" action="{{ route('admin.product-prices.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    @include('admin.product-prices.__form', ['method' => 'create'])

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
