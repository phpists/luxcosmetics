@extends('cabinet.layouts.cabinet')

@section('title', 'Мой профиль')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Мой профиль</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="chars">
                    <div class="chars__item">
                        <div class="chars__name"><span>Имя и фамилия</span></div>
                        <div class="chars__value"><span>{{$user->name}} {{$user->surname}}</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>Номер телефона</span></div>
                        <div class="chars__value"><span>{{$user->phone}}</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>Дата рождения</span></div>
                        <div class="chars__value"><span>{{$user->birthday?$user->birthday: '-'}}</span></div>
                    </div>
                    <div class="chars__item">
                        <div class="chars__name"><span>E-mail</span></div>
                        <div class="chars__value"><span>{{$user->email}}</span></div>
                    </div>
                </div>
                <a href="{{route('profile.edit')}}" class="btn-edit">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use>
                    </svg>
                    Редактировать
                </a>
            </div>
        </div>
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Пароль</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="cabinet-page__data"><b>*********</b></div>
                <a href="{{route('profile.password')}}" class="btn-edit">
                    <svg class="icon">
                        <use xlink:href="{{asset('images/dist/sprite.svg#edit')}}"></use>
                    </svg>
                    Редактировать
                </a>
            </div>
        </div>
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Мои адреса</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="cabinet-page__data">
                @isset($user->first_address)
                        {{$user->first_address->city}} {{$user->first_address->address}}
                @endisset
                </div>
                <div class="cabinet-page__btns">
                    <a href="{{route('profile.addresses')}}" class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#book')}}"></use>
                        </svg>
                        Смотреть все адреса</a>
                    <button class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#add')}}"></use>
                        </svg>
                        Добавить новый адрес
                    </button>
                </div>
            </div>
        </div>
        <div class="cabinet-page__group">
            <h3 class="cabinet-page__subheading subheading">Мои карты</h3>
            <div class="cabinet-page__item cabinet-page__item--justify">
                <div class="cabinet-page__data">
                @isset($user->default_card)
                    <b>{{\App\Services\SiteService::displayCardNumber($user->default_card->card_number)}}</b>
                @endisset
                </div>
                <div class="cabinet-page__btns">
                    <button class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#trash')}}"></use>
                        </svg>
                        Удалить карту
                    </button>
                    <button class="btn-edit">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#add')}}"></use>
                        </svg>
                        Добавить новую карту
                    </button>
                </div>
            </div>
        </div>
        @if($user->role_id !== \App\Models\User::ADMIN)
            <div class="cabinet-page__group">
                <h3 class="cabinet-page__subheading subheading">Обратная связь</h3>
                @foreach($user->chats as $chat)
                    <div class="cabinet-page__item cabinet-page__item--justify">
                        <p>Тема обращения: {{$chat->feedback_theme}}</p>
                        <div class="cabinet-page__data">
                            @foreach($chat->messages()->whereNot('user_id', $user->id)->get() as $message)
                                <p><b>{{$message->message}}</b></p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
@endsection
