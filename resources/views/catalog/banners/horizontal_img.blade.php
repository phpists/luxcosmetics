<div class="category-page__banner">
    @isset($catalogBanner->data['link'])
        <a href="{{ $catalogBanner->data['link'] }}">
            @endif
            <img src="{{ $catalogBanner->getImgSrc($catalogBanner->data['img_960']) }}" alt="" class="for-desktop">
            <img src="{{ $catalogBanner->getImgSrc($catalogBanner->data['img_768']) }}" alt="" class="for-tablet">
            <img src="{{ $catalogBanner->getImgSrc($catalogBanner->data['img_375']) }}" alt="" class="for-mobile">
            @isset($catalogBanner->data['link'])
        </a>
    @endisset
</div>
