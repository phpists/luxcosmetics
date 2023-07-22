<button type="button" data-toggle="modal" data-target="#addProduct" class="btn btn-primary font-weight-bold">
    <i class="fas fa-plus mr-2"></i>Добавить
</button>

<input type="hidden" id="refreshOrderProductsTableUrl" value="{{ route('admin.order_products.refresh') }}">
<div class="table-responsive">
    <table id="orderProductsTable" class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                #
            </th>
            <th class="pr-0 text-center">
                Бренд
            </th>
            <th class="pr-0 text-center">
                Название
            </th>
            <th class="pr-0 text-center">
                Цена
            </th>
            <th class="pr-0 text-center">
                Кол-во
            </th>
            <th class="pr-0 text-center">
                Сумма
            </th>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody>
            @include('admin.orders.includes.products', [
    				'orderProducts' => old('products', ($order->orderProducts->toArray() ?? [])),
    				'total_sum' => ($order->total_sum ?? 0)
    			])
        </tbody>
    </table>
</div>
