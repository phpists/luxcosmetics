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
                                20.03.2022
                            </div>
                        </div>
                        <div class="answer__content">{!! $question->messages->get(1)->message !!}
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
                15.03.2022
            </div>
            <div class="review__mark markblock">
                <div class="markblock__title">Был ли этот отзыв полезен?</div>
                <button class="markblock__btn">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#like')}}"></use>
                    </svg>
                    2
                </button>
                <button class="markblock__btn">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#dislike')}}"></use>
                    </svg>
                    0
                </button>
            </div>
        </div>

    </div>
@endforeach
