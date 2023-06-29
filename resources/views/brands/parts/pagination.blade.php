@if(sizeof($products) > 0)
    {{ $products->links('vendor.pagination.products_pagination') }}
@endif
