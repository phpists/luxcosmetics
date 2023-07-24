<x-mail::message>
<h1 style="text-align: center">
    Привет, {{$userName}}
</h1>

<p style="text-align: center">
    Спасибо за регистрацию на нашем сайте
</p>
@isset($password)
<p style="text-align: center">
Ваш пароль:
</p>
<p style="background: black; color: white; padding: 10px">{{$password}}</p>
@endisset
<p style="text-align: center">
Ваш email:
</p>
<p style="background: black; color: white; padding: 10px">{{$email}}</p>

<x-mail::button :url="url()->route('home')">
    Посетить сайт
</x-mail::button>

<p style="text-align: center">
    Всего хорошего,<br>
    {{ config('app.name') }}
</p>
</x-mail::message>



