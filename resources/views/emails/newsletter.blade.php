<x-mail::message>
<h1 style="text-align: center">
Привет, {{$userName}}
</h1>

<p style="text-align: center">
{!! $message !!}
</p>

<x-mail::button :url="url()->route('home')">
Посетить сайт
</x-mail::button>

<p style="text-align: center">
Всего хорошего,<br>
{{ config('app.name') }}
</p>
</x-mail::message>
