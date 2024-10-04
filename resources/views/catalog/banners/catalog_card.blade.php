<div class="category-page__product category-page__product--banner">
    <div class="category-page__bannerproduct">
        @isset($catalogBanner->data['link'])
        <a href="{{ $catalogBanner->data['link'] }}">
            @endif

            <img src="{{ $catalogBanner->getImgSrc($catalogBanner->data['img']) }}" alt="">

            @isset($catalogBanner->data['link'])
        </a>
        @endisset
    </div>
</div>
