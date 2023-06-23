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
            <form action="{{route('profile.add-payment-method')}}" class="form form--box" method="POST">
                @csrf
                <div class="form__row">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Номер карты</legend>
                            <input type="text" name="card_number" maxlength="16" id="card_inp" minlength="16" class="form__input" required>
                        </div>
                        <div class="form__fieldset">
                            <legend class="form__label">Срок действия</legend>
                            <div class="form__row">
                                <div class="form__col form__col--33">
                                    <input type="number" class="form__input" min="1" max="12" name="month" required>
                                </div>
                                <div class="form__col form__col--33">
                                    <input type="number" class="form__input" min="{{substr(date("Y"), 2, 2)}}" max="99" name="year" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Фамилия и имя</legend>
                            <input type="text" class="form__input" name="full_name" required>
                        </div>
                        <div class="form__fieldset">
                            <legend class="form__label">CVV</legend>
                            <div class="form__row">
                                <div class="form__col form__col--33">
                                    <input type="text" class="form__input" id="cvv_inp" name="cvv" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__fieldset">
                    <label class="checkbox checkbox--mailer">
                        <input type="checkbox" name="is_default"/>
                        <div class="checkbox__text">Сделать способом оплаты по умолчанию</div>
                    </label>
                    <button class="btn btn--accent">Добавить</button>
                </div>
            </form>
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
