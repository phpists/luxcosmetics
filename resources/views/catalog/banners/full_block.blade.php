<div class="category-page__product category-page__product--bigbanner">
    <div class="prodbaner">
        @isset($catalogBanner->data['img'])
        <div class="prodbaner__image">
            <img src="{{ $catalogBanner->getImgSrc($catalogBanner->data['img']) }}" alt="">
        </div>
        @endisset
        <div class="prodbaner__content">
            <div class="prodbaner__title">{{ $catalogBanner->data['subject'] }}</div>
            @isset($catalogBanner->data['body'])
            <div class="prodbaner__subtitle">{!! $catalogBanner->data['body'] !!}</div>
            @endisset
            @if(isset($catalogBanner->data['button_text']) && isset($catalogBanner->data['button_link']))
            <a href="{{ $catalogBanner->data['button_link'] }}" class="btn btn--accent">{{ $catalogBanner->data['button_text'] }} <svg class="icon"><use xlink:href="images/dist/sprite.svg#circle-arrow"></use></svg></a>
            @endif
        </div>
    </div>
</div>
