@extends('cabinet.layouts.cabinet')

@section('title', 'Адреса')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__myadd">
            @foreach($user->addresses as $address)
                <div class="address">
                    <div class="address__name subheading">{{$address->name}} {{$address->surname}}</div>
                    <div class="address__contacts">
                        <p>{{$address->phone}}</p>
                        <p>{{$address->city}} {{$address->address}}</p>
                    </div>
                    <label class="radio">
                        <input type="radio" value="{{$address->id}}" name="myadd" @if($address->is_default) checked @endif/>
                        <div class="radio__text">Использовать как адрес по умолчанию</div>
                    </label>
                    <div class="address__nav">
                        <a class="btn-edit btn_edit_address popup-with-form" data-value="{{$address->id}}" href="#updateAddressModal">
                            <svg class="icon">
                                <use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use>
                            </svg>
                            Редактировать
                        </a>
                        <form action="{{route('profile.addresses.delete')}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value="{{$address->id}}">
                            <button class="btn-edit">
                                <svg class="icon">
                                    <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>
                                </svg>
                                Удалить
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
{{--            <div class="address">--}}
{{--                <div class="address__name subheading">Иван Петров</div>--}}
{{--                <div class="address__contacts">--}}
{{--                    <p>+7 495 456 78 96</p>--}}
{{--                    <p>г.Москва ул. Пролетарская 24 / 5</p>--}}
{{--                </div>--}}
{{--                <label class="radio">--}}
{{--                    <input type="radio" name="myadd"/>--}}
{{--                    <div class="radio__text">Использовать как адрес по умолчанию</div>--}}
{{--                </label>--}}
{{--                <div class="address__nav">--}}
{{--                    <button class="btn-edit">--}}
{{--                        <svg class="icon">--}}
{{--                            <use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use>--}}
{{--                        </svg>--}}
{{--                        Редактировать--}}
{{--                    </button>--}}
{{--                    <button class="btn-edit">--}}
{{--                        <svg class="icon">--}}
{{--                            <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>--}}
{{--                        </svg>--}}
{{--                        Удалить--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="address">--}}
{{--                <div class="address__name subheading">Иван Петров</div>--}}
{{--                <div class="address__contacts">--}}
{{--                    <p>+7 495 456 78 96</p>--}}
{{--                    <p>г.Москва ул. Звездная 10 / 1</p>--}}
{{--                </div>--}}
{{--                <label class="radio">--}}
{{--                    <input type="radio" name="myadd"/>--}}
{{--                    <div class="radio__text">Использовать как адрес по умолчанию</div>--}}
{{--                </label>--}}
{{--                <div class="address__nav">--}}
{{--                    <button class="btn-edit">--}}
{{--                        <svg class="icon">--}}
{{--                            <use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use>--}}
{{--                        </svg>--}}
{{--                        Редактировать--}}
{{--                    </button>--}}
{{--                    <button class="btn-edit">--}}
{{--                        <svg class="icon">--}}
{{--                            <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>--}}
{{--                        </svg>--}}
{{--                        Удалить--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="text-right">
            <a href="#new-add" class="btn btn--accent popup-with-form">Добавить новый адрес</a>
        </div>
    </main>
    <div class="hidden">
        <div class="popupform" id="new-add">
            <div class="subheading subheading--with-form">Добавить новый адрес</div>
            <form action="{{route('profile.add-address')}}" method="POST" class="form form--box">
                @csrf
                <div class="form__row">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Ваше имя *</legend>
                            <input type="text" name="name" value="{{$user->name}}" class="form__input" required>
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Фамилия *</legend>
                            <input type="text" value="{{$user->surname}}" name="surname" class="form__input" required>
                        </div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Номер телефона *</legend>
                            <input type="text" id="phone_inp" value="{{$user->phone}}" name="phone" class="form__input" required>
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Электронная почта *</legend>
                            <input type="email" value="{{$user->email}}" name="email" class="form__input" required>
                        </div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Город</legend>
                            <input type="text" name="city" class="form__input">
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Область</legend>
                            <input type="text" name="region" class="form__input">
                        </div>
                    </div>
                </div>
                <div class="form__fieldset">
                    <legend class="form__label">Адрес *</legend>
                    <input type="text" name="address" class="form__input" required>
                </div>
                <button class="btn btn--accent">Добавить</button>
            </form>
        </div>
    </div>
    <div class="hidden">
        <div class="popupform" id="updateAddressModal">
            <div class="subheading subheading--with-form">Обновить адрес</div>
            <form action="{{route('profile.addresses.update')}}" method="POST" class="form form--box">
                @csrf
                @method('put')
                <div class="form__row">
                    <input type="hidden" name="id" id="updId">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Ваше имя *</legend>
                            <input type="text" name="name" id="updName" class="form__input" required>
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Фамилия *</legend>
                            <input type="text" name="surname" id="updSurName" class="form__input" required>
                        </div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Номер телефона *</legend>
                            <input type="text" name="phone" id="updPhone" class="form__input" required>
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Электронная почта *</legend>
                            <input type="email" name="email" id="updEmail" class="form__input" required>
                        </div>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Город</legend>
                            <input type="text" name="city"  id="updCity" class="form__input">
                        </div>
                    </div>
                    <div class="form__col form__col--50">
                        <div class="form__fieldset">
                            <legend class="form__label">Область</legend>
                            <input type="text" name="region" id="updRegion" class="form__input">
                        </div>
                    </div>
                </div>
                <div class="form__fieldset">
                    <legend class="form__label">Адрес *</legend>
                    <input type="text" name="address" id="updAddress" class="form__input" required>
                </div>
                <button class="btn btn--accent">Добавить</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('input[name="myadd"]').forEach((el) => {
            el.addEventListener('change', async function() {
                const response = await fetch('{{route('profile.update-default-address')}}', {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: el.value
                    })
                });
                let result = await response.json();
            })
        });
    </script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/inputmask/inputmask.js') }}"></script>
    <script src="{{ asset('js/inputmask/jquery.inputmask.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            Inputmask("+7 (999) 999-99-99").mask('#phone_inp');
            Inputmask("+7 (999) 999-99-99").mask('#updPhone');
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
        })
    </script>
@endsection
