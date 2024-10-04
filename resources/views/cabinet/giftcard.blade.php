@extends('cabinet.layouts.cabinet')

@section('title', 'Подарочные карты')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group typography">
            <h3 class="subheading">Добавить подарочную карту</h3>
            <p>Введите номер ваучера из полученного вами электронного письма<br> и/или код на
                обратной стороне физической карты</p>
            @if($activeGiftCard)
            <div class="formsuccess formsuccess--big">У вас на аккаунте активирована подарочная карта на сумму <b>{{ $activeGiftCard->sum }}</b>
                <br>ее можно использовать в корзине при покупке
                <br>Осталось <b>{{ $activeGiftCard->balance }}</b>
                <br>Действительные до <b>{{ $activeGiftCard->created_at->addyear()->format('d.m.y') }}</b></div>
            @endif
            <form action="{{ route('profile.gift-cards.activate') }}" method="POST" class="form form--box">
                @csrf
                <div class="form__fieldset">
                    <legend class="form__label">16-ти значный номер штрих-кода</legend>
                    <input type="text" name="code" class="form__input" required>
                </div>
                <label class="checkbox checkbox--mailer">
                    <input type="checkbox"/>
                    <div class="checkbox__text"><small>Добавьте свой номер телефона, чтобы связать
                            свою учетную запись<br> для использования в магазине и интернете</small>
                    </div>
                </label>
                <button class="btn btn--accent">Активировать подарочную карту</button>
            </form>
        </div>
        <div class="cabinet-page__group giftcardban">
            <div class="giftcardban__title">Нет подарочной карты?</div>
            <a href="{{ route('gif-card.index') }}" class="btn btn--accent">Купить сейчас</a>
        </div>
        @if($faqGroup && $faqGroup->activeFaqs->isNotEmpty())
        <div class="cabinet-page__group">
            <h3 class="subheading">Вопросы и ответы</h3>
            <div class="faq-accordeon">
                @foreach($faqGroup->activeFaqs as $faq)
                <dl>
                    <dt>{{ $faq->title }}
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                        </svg>
                    </dt>
                    <dd class="typography">{!! $faq->answer !!}</dd>
                </dl>
                @endforeach
            </div>
        </div>
        @endif
    </main>
@endsection
