<x-mail::message>
<h1 style="text-align: center">
Привет, {{$userName}}
</h1>

<p style="text-align: center">
<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
{!! $message !!}
</div>
</p>

<x-mail::button :url="url()->route('home')">
Посетить сайт
</x-mail::button>

<p style="text-align: center">
Всего хорошего,<br>
{{ config('app.name') }}
</p>
</x-mail::message>
