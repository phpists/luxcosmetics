@foreach($promotions as $promotion)
    <div class="article">
        <div class="article__wrap">
            <div class="article__image">
                <picture>
                    <img src="{{ $promotion->preview_img_src }}">
                </picture>
            </div>
            <div class="article__date article__date--action" @style(['background-color: #9f9f9f;' => $promotion->period_title === 'Закончилась'])>{{ $promotion->period_title }}</div>
            <div class="article__title"><a href="{{ route('promotions.show', $promotion) }}">{{ $promotion->title }}</a></div>
            <div class="article__intro">{{ $promotion->short_description }}</div>
        </div>
        <a href="{{ route('promotions.show', $promotion) }}" class="article__more">Подробнее</a>
    </div>
@endforeach
