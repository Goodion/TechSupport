@component('mail::message')
# Создана новая заявка: {{ $appeal->title }}
Автор - {{ $appeal->author->name }}

{{ $appeal->body }}

@component('mail::button', ['url' => $urlToCreatedAppeal])
Перейти к заявке
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
