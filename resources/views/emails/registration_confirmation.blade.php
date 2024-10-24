<x-mail::message>
<h1 style="text-align: center">
    Привет, {{$userName}}
</h1>

<p style="text-align: center">
    Спасибо за регистрацию на нашем сайте
</p>
<p style="text-align: center">
Ваш номер телефона:
</p>
<p style="color: black;  font-weight: bold; font-size: 24px; padding: 10px">{{ $phone }}</p>
<p style="text-align: center">
Ваш email:
</p>
<p style="color: black;  font-weight: bold; font-size: 24px; padding: 10px; text-decoration: none">{{ $email }}</p>

<x-mail::button :url="url()->route('home')">
    Посетить сайт
</x-mail::button>

<p style="text-align: center">
    Всего хорошего,<br>
    {{ config('app.name') }}
</p>
</x-mail::message>



