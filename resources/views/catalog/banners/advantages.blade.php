<div class="category-page__product category-page__product--advantages">
    <ul class="advantbanners @if(isset($catalogBanner->data['color']) && $catalogBanner->data['color'] == \App\Models\CatalogBanner::COLOR_GREEN) advantbanners--green @endif">
        @foreach($catalogBanner->data['items'] as $item)
            <li class="advantbanners__item">{{ $item['text'] ?? '' }}</li>
        @endforeach
    </ul>
</div>
