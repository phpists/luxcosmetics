@extends('layouts.app')
@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="">Главная</a></li>
                        <li class="crumbs__item">Часто задаваемые вопросы</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="faq-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title-h1">FAQ</h1>
                </div>
                <div class="col-lg-9 order-lg-4 typography">
                    <div class="faq-page__item">
                        <h3 class="subheading">Аккаунт</h3>
                        <div class="faq-accordeon">
                            <dl>
                                <dt>Как создать аккаунт? <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam ea, accusamus. Numquam non commodi ipsum debitis repudiandae amet vero itaque, deserunt, ad neque libero quae officia. Facilis non, possimus doloribus! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro, magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur nesciunt. Culpa dicta adipisci voluptatem.</dd>
                            </dl>
                            <dl>
                                <dt>Как я могу изменить свою информацию? <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro, magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur nesciunt. Culpa dicta adipisci voluptatem.</dd>
                            </dl>
                            <dl>
                                <dt>Что делать если я забыл пароль? <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro, magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur nesciunt. Culpa dicta adipisci voluptatem.</dd>
                            </dl>
                            <dl>
                                <dt>Как я могу проверить баланс моей подарочной карты? <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro, magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur nesciunt. Culpa dicta adipisci voluptatem.</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="faq-page__item">
                        <h3 class="subheading">Платежи</h3>
                        <div class="faq-accordeon">
                            <dl>
                                <dt>Какой способ оплаты я могу использовать? <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam ea, accusamus. Numquam non commodi ipsum debitis repudiandae amet vero itaque, deserunt, ad neque libero quae officia. Facilis non, possimus doloribus! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro, magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur nesciunt. Culpa dicta adipisci voluptatem.</dd>
                            </dl>
                            <dl>
                                <dt>Безопасно ли заказывать онлайн? <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro, magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur nesciunt. Culpa dicta adipisci voluptatem.</dd>
                            </dl>
                            <dl>
                                <dt>Сколько стоит возврат товара? <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro, magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur nesciunt. Culpa dicta adipisci voluptatem.</dd>
                            </dl>
                            <dl>
                                <dt>Как я могу проверить баланс моей подарочной карты? <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                <dd class="typography">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quis voluptatem repellat? Blanditiis iste, exercitationem porro, magni amet cupiditate enim, labore tenetur, praesentium quam consequuntur nesciunt. Culpa dicta adipisci voluptatem.</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-1">
                    <ul class="cabmenu">
                        <li class="@if(request()->routeIs('questions.faq')) is-active @endif"><a href="{{route('questions.faq')}}">FAQ</a></li>
                        <li class="@if(request()->routeIs('questions.delivery')) is-active @endif"><a href="{{route('questions.delivery')}}">Доставка</a></li>
                        <li class="@if(request()->routeIs('questions.returns')) is-active @endif"><a href="{{route('questions.returns')}}">Возврат</a></li>
                        <li class="@if(request()->routeIs('questions.policy')) is-active @endif"><a href="{{route('questions.policy')}}">Политика конфиденциальности</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
