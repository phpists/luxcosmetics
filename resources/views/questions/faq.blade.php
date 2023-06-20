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
                    @foreach($faq_groups as $group)
                        <div class="faq-page__item">
                            <h3 class="subheading">{{$group->name}}</h3>
                            <div class="faq-accordeon">
                                @foreach($group->faqs as $faq)
                                    <dl>
                                        <dt>{{$faq->title}} <svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrow')}}"></use></svg></dt>
                                        <dd class="typography">{!! $faq->answer !!}</dd>
                                    </dl>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
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
