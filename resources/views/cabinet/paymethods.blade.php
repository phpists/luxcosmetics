@extends('cabinet.layouts.cabinet')

@section('title', 'Способы оплаты')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group">
            <div style="margin-bottom: 10px;">
                @include('layouts.includes.messages')
            </div>
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
                        <a href="#deletePayment" class="btn btn-edit popup-with-form del-btn" data-value="{{$payment_card->id}}">
                            <svg class="icon">
                                <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>
                            </svg>
                            Удалить
                        </a>
{{--                        <button class="btn-edit">--}}
{{--                            <svg class="icon">--}}
{{--                                <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>--}}
{{--                            </svg>--}}
{{--                            Удалить карту--}}
{{--                        </button>--}}
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
    <div class="hidden">
        @include('cabinet.parts.payment_delete_modal')
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
        $(document).ready(function () {
            $('.btn_edit_address').on('click', function(ev) {
                $.ajax({
                    url: '{{route('profile.addresses.show')}}',
                    data: {
                        id: ev.target.getAttribute('data-value')
                    },
                    success: function (response) {
                        $('#updAddress').val(response.address);
                        $('#updId').val(response.id);
                        $('#updName').val(response.name);
                        $('#updEmail').val(response.email);
                        $('#updSurName').val(response.surname);
                        $('#updPhone').val(response.phone);
                        $('#updCity').val(response.city);
                        $('#updRegion').val(response.region);
                    },
                    error: function (resp) {
                        console.log(resp)
                    }
                })
            })
            $('.del-btn').on('click', function (ev) {
                let value = ev.currentTarget.getAttribute('data-value');
                $('#deleteId').val(value);
            })
        })
    </script>
@endsection
