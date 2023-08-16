@foreach($questions as $question)
    <div class="review">
        <div class="review__header">
            <div class="review__name">{{$question->messages->first()->username}}</div>
            <div class="review__userstatus">{{$question->messages->first()->user_id !== null?'Проверенный покупатель' : 'Непроверенный покупатель'}}</div>
        </div>
        <div class="review__body">
            <div class="review__content">{!! $question->messages->first()->message !!}
            </div>
            @if(sizeof($question->messages) > 1)
                @php
                    $reply = $question->messages->get(1);
                @endphp
                <div class="review__answers">
                    {{--                                                <div class="review__answerstotal">Ответ (1)</div>--}}
                    <div class="review__answer answer">
                        <div class="answer__hdr">
                            <div class="answer__author">Техподдержка</div>
                            <div class="answer__date">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use>
                                </svg>
                                {{$reply->created_at->format('d.m.Y')}}
                            </div>
                        </div>
                        <div class="answer__content">{!! $reply->message !!}
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <div class="review__footer">
            <div class="review__date">
                <svg class="icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use>
                </svg>
                {{$question->created_at->format('d.m.Y')}}
            </div>
            <div class="review__mark markblock">
                <div class="markblock__title">Был ли этот отзыв полезен?</div>
                <button class="markblock__btn like_btn on_like_btn @if($question->is_like === 1) checked @endif" data-value="1" data-table="product_questions" data-id="{{$question->id}}">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#like')}}"></use>
                    </svg>
                    <span>{{$question->like}}</span>
                </button>
                <button class="markblock__btn like_btn dislike_btn @if($question->is_like === 0) checked @endif" data-value="0" data-table="product_questions" data-id="{{$question->id}}">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#dislike')}}"></use>
                    </svg>
                    <span>{{$question->dislike}}</span>
                </button>
            </div>
        </div>

    </div>
@endforeach
