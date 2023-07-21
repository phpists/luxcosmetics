@extends('cabinet.layouts.cabinet')

@section('title', 'Способы оплаты')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group">
            <h3 class="subheading subheading--with-form">Привязанные карты</h3>
            <div class="mycards">
                @foreach($payment_cards as $payment_card)
                    <div class="mycards__item mycard">
                        <div class="mycard__wrap">
                            <div class="mycard__ico">
                                <svg class="icon">
                                    <use xlink:href="{{asset('images/dist/sprite.svg#mastercard')}}"></use>
                                </svg>
                            </div>
                            <div class="mycard__card">{{\App\Services\SiteService::displayCardNumber($payment_card->card_number)}}
                                <div class="mycard__notice">{{\App\Services\SiteService::checkCardAvailability($payment_card->valid_date)}}</div>
                            </div>
                        </div>
                        <button class="btn-edit">
                            <svg class="icon">
                                <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>
                            </svg>
                            Удалить карту
                        </button>
                    </div>
                @endforeach
            </div>
            <div class="text-right">
                <a href="#new-card" class="btn btn--accent popup-with-form">Добавить новую карту</a>
            </div>
        </div>
    </main>
    <div class="hidden">
        <div class="popupform" id="new-card">
            <div class="subheading subheading--with-form">Добавить новую карту</div>
            @include('layouts.parts.create_payment')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/inputmask/inputmask.js') }}"></script>
    <script src="{{ asset('js/inputmask/jquery.inputmask.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            Inputmask("9999999999999999").mask('#card_inp');
            Inputmask("999").mask('#cvv_inp');
        });
    </script>
@endsection
