<x-mail::message>
    <h1 style="text-align: center">
        Привет, {{ $giftCard->receiver }}
    </h1>
    Для вас куплена подарочная карта на сумму - {{ $giftCard->sum }}, цвет - {{ $giftCard->color }}
    <x-mail::panel color="{{ $giftCard->color }}">{{ $giftCard->code }}</x-mail::panel><x-mail::button :url="route('home')">Посетить сайт</x-mail::button>
</x-mail::message>
