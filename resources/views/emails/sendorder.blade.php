    <h1 style="text-align: center">
        Привет, {{$userName}}
    </h1>
    <h2 style="text-align: center">
        Вы зделали заказ на сайте {{ config('app.name') }}
    </h2>
    <h2 style="text-align: center">
        Ваш статус, ОПЛАЧЕН!!!
    </h2>
    <p style="text-align: center">
            Спасибо за покупку
    </p>
    <x-mail::button :url="url()->route('home')">
        Посетить сайт
    </x-mail::button>

    <p style="text-align: center">
        Всего хорошего,<br>
        {{ config('app.name') }}
    </p>
