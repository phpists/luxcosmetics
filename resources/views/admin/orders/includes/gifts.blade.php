<input type="hidden" id="giftsUrl" value="{{ route('admin.order-gifts.table') }}">
<div class="table-responsive">
    <table id="giftProductsTable" class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                #
            </th>
            <th class="pr-0 text-center">
                Изображение
            </th>
            <th class="pr-0 text-center">
                Артикул
            </th>
            <th class="pr-0 text-center">
                Бренд
            </th>
            <th class="pr-0 text-center">
                Название
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($gift_products as $gift_product)
            <tr>
                <td class="text-center pl-0">
                    {{ $gift_product->id }}
                </td>
                <td class="text-center pr-0">
                    <img src="{{ $gift_product->getImgSrc() }}" alt="img" class="img-fluid" style="max-height: 64px">
                </td>
                <td class="text-center pr-0">
                    {{ $gift_product->article }}
                </td>
                <td class="text-center pr-0">
                    {{ $gift_product->brand->name }}
                </td>
                <td class="text-center pr-0">
                    {{ $gift_product->title }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
