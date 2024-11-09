<div id="promotionsItems" class="articles-page__articles">
    @include('promotion.__items')
</div>

<div id="promotionsPagination">
{{ $promotions->links('vendor.pagination.products_pagination', ['moreItemName' => '']) }}
</div>
