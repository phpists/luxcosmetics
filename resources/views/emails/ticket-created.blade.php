<x-mail::message>
<h1 style="text-align: center">Привет, {{ $feedbackChat->user->full_name }}</h1>
<p>Ваше обращение на тему "{{ $feedbackChat->feedback_theme }}" зарегистрировано и ему присвоен номер "{{ $feedbackChat->id }}"</p>
</x-mail::message>
