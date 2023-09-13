@foreach($comments as $comment)
    <div class="review" data-comment-id="{{ $comment->id }}" id="comment-container">
        <div class="review">
            <div class="review__header">
                <div class="review__name">{{$comment->name}}</div>
                <div class="review__userstatus">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#shield')}}"></use>
                    </svg>
                    Проверенный покупатель
                </div>
            </div>
            <div class="review__body">
                <div class="review__content">{{ $comment->description }}</div>
            </div>
            <div class="review__footer">
                <div class="review__footerwrap">
                    <div class="stars">
                        @for($i = 1; $i < 6; $i++)
                            @if($i <= $comment->rating)
                                <span class="stars__item is-active"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                            @else
                                <span class="stars__item"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#star')}}"></use></svg></span>
                            @endif
                        @endfor
                    </div>
                    <div class="review__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg> {{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('D.MM.Y') }}</div>
                </div>
                <div class="review__mark markblock">
                    <div class="markblock__title">Был ли этот отзыв полезен?</div>
                    <button class="markblock__btn like_btn on_like_btn like_init @if($comment->is_like === 1) checked @endif" data-value="1" data-table="comments" data-id="{{$comment->id}}">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#like')}}"></use>
                        </svg>
                        <span>{{$comment->like}}</span>
                    </button>
                    <button class="markblock__btn like_btn dislike_btn like_init @if($comment->is_like === 0) checked @endif" data-value="0" data-table="comments" data-id="{{$comment->id}}">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#dislike')}}"></use>
                        </svg>
                        <span>{{$comment->dislike}}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
