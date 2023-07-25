<x-mail::message>
<h1 style="text-align: center">
    Привет, {{$userName}}
</h1>

<p style="text-align: center">
    Вы недавно сделали запрос на востановленние вашего пароля. Ваш новый пароль:
</p>
<p style="color: black;  font-weight: bold; font-size: 24px; padding: 10px">{{$password}}</p>

<x-mail::button :url="url()->route('login')">
    Посетить сайт
</x-mail::button>

<p style="text-align: center">
    Всего хорошего,<br>
    {{ config('app.name') }}
</p>
</x-mail::message>



