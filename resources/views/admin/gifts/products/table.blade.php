<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                #
            </th>
            <th class="pr-0 text-center">
                Артикул
            </th>
            <th class="pr-0 text-center">
                Изображение
            </th>
            <th class="pr-0 text-center">
                Бренд
            </th>
            <th class="pr-0 text-center">
                Название
            </th>
            <td class="text-center pr-0">
                В наличии
            </td>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody id="table">
        @foreach($gift_products as $gift_product)
            <tr>
                <td class="text-center pl-0">
                    {{ $gift_product->id }}
                </td>
                <td class="text-center pl-0">
                    {{ $gift_product->article }}
                </td>
                <td class="text-center pr-0">
                    <img src="{{ $gift_product->getImgSrc() }}" alt="img" class="img-fluid" style="max-height: 64px">
                </td>
                <td class="text-center pr-0">
                    {{ $gift_product->brand->name ?? 'UNDEFINED' }}
                </td>
                <td class="text-center pr-0">
                    {{ $gift_product->title }}
                </td>
                <td class="text-center pr-0">
                    <div class="form-group row justify-content-center">
                            <span class="switch switch-success">
                                <label>
                                    <input class="is-available-edit" type="checkbox" name="is_available" @checked($gift_product->isAvailable()) data-url="{{ route('admin.gift_products.update', $gift_product) }}"/>
                                    <span></span>
                                </label>
                            </span>
                    </div>
                </td>
                <td class="text-center pr-0">
                    <form action="{{ route('admin.gift_products.destroy', $gift_product) }}" method="POST">
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn_edit"
                           data-toggle="modal" data-target="#editGiftProductModal"
                           data-url="{{ route('admin.gift_products.show', $gift_product) }}">
                            <i class="las la-edit"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                onclick="return confirm('Вы уверены?')"
                                title="Delete"><i class="las la-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div id="pagination">
    {{ $gift_products->withQueryString()->links('vendor.pagination.product_pagination') }}
</div>
<!--end::Table-->
