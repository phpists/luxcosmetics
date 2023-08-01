    <h1 style="text-align: center">
        Привет, {{$userName}}
    </h1>
    <h2 style="text-align: center">
        Вы добавили в корзину заказ на сайте {{ config('app.name') }}
    </h2>
    <h2 style="text-align: center">
        Ваш статус, Не ОПЛАЧЕН!!!
    </h2>
    <p style="text-align: center">
        Оплатите немедленно!!!!
    </p>
    <x-mail::button :url="url()->route('home')">
        Посетить сайт
    </x-mail::button>

    <p style="text-align: center">
        Всего хорошего,<br>
        {{ config('app.name') }}
    </p>
