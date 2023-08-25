<x-mail::message>
    <h1 style="text-align: center">
        Спасибо за регистрацию!
    </h1>
    Ваши данные для входа:<br>
    Email: <b>{{ $email }}</b><br>
    Пароль: <b>{{ $password }}</b><br>
    <x-mail::button :url="route('home')">Посетить сайт</x-mail::button>
</x-mail::message>
