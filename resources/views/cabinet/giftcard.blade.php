@extends('cabinet.layouts.cabinet')

@section('title', 'Подарочные карты')

@section('page_content')
    <main class="cabinet-page__main">
        <div class="cabinet-page__group typography">
            <h3 class="subheading">Добавить подарочную карту</h3>
            <p>Введите номер ваучера из полученного вами электронного письма<br> и/или код на
                обратной стороне физической карты</p>
            @if($user->hasGiftCardBalance())
            <div class="formsuccess formsuccess--big">У вас на аккаунте активирована подарочная карта на сумму <b>{{ $last_gift_card->sum }}</b> <br>ее можно использовать в корзине при покупке <br>Осталось <b>{{ $user->gift_card_balance }}</b></div>
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
        <div class="cabinet-page__group">
            <h3 class="subheading">Вопросы и ответы</h3>
            <div class="faq-accordeon">
                <dl>
                    <dt>Что такое подарочная карта?
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                        </svg>
                    </dt>
                    <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Aperiam ea, accusamus. Numquam non commodi ipsum debitis repudiandae amet
                        vero itaque, deserunt, ad neque libero quae officia. Facilis non, possimus
                        doloribus! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid
                        quis voluptatem repellat? Blanditiis iste, exercitationem porro, magni amet
                        cupiditate enim, labore tenetur, praesentium quam consequuntur nesciunt.
                        Culpa dicta adipisci voluptatem.
                    </dd>
                </dl>
                <dl>
                    <dt>Что такое электронная подарочная карта?
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                        </svg>
                    </dt>
                    <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro,
                        magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur
                        nesciunt. Culpa dicta adipisci voluptatem.
                    </dd>
                </dl>
                <dl>
                    <dt>Когда истечет срок действия моей подарочной карты?
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                        </svg>
                    </dt>
                    <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro,
                        magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur
                        nesciunt. Culpa dicta adipisci voluptatem.
                    </dd>
                </dl>
                <dl>
                    <dt>Как я могу проверить баланс моей подарочной карты?
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use>
                        </svg>
                    </dt>
                    <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro,
                        magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur
                        nesciunt. Culpa dicta adipisci voluptatem.
                    </dd>
                </dl>
            </div>
        </div>
    </main>
@endsection
