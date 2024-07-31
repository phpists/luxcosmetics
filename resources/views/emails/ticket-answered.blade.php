<x-mail::message>
<h1 style="text-align: center">Привет, {{ $feedbackChat->user->full_name }}</h1>
<p>{{ $feedbackChat->lastMessage->message }}</p>
</x-mail::message>
